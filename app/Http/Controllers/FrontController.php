<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Game;
use App\Models\Slider;
use App\Models\Page;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    { 
        $new_games = Game::where('is_new', 1)->latest()->active()->take(20)->get();
        $papular_games = Game::where('is_popular', 1)->latest()->active()->take(20)->get();
        // $foryou_games = Game::active()->take(15)->get();
        $sliders = Slider::where('status', 1)->get();
        $cat_games = Category::active()->orderBy('index', 'asc')->orderBy('title', 'asc')->with(['games' => function($q){
                return $q->latest()->active();
            }])
            ->whereHas('games')->take(7)->get();

        return view('front.index', ['sliders' => $sliders, 'new_games' => $new_games, 'papular_games' => $papular_games, 'cat_games' => $cat_games]);
    }
    
    /**
     * Show category specific resource.
     */
    public function category($id)
    {
        $cat = Category::findOrFail($id);
        // $cat_name = $category->title ?? 'Game';
        $cat_games = Game::whereCategoryId($cat->id)->latest()->active()->get();
        return view('front.category',['cat' => $cat, 'cat_games' => $cat_games]);
    }

    /**
     * Game play page
     */
    public function play($id)
    {
        $game = Game::findOrFail($id);
        return view('front.game', ['game' => $game]);
    }

    /**
     * Change Language
     */
    public function language($language)
    {
        if($language == 'ar'){
            session()->put('lang', 'ar');
        }else{
            session()->put('lang', 'en');    
        }

        return back();

    }

    /**
     * Change Theme
     */
    public function theme($theme)
    {
        if($theme == 'light'){
            session()->put('theme', 'light');
        }else{
            session()->put('theme', 'dark');    
        }

        return back();

    }

    /**
     * get new games
     */
    public function latest()
    {
        $cat = ['title' => 'New Games'];
        $cat_games = Game::where('is_new', 1)->latest()->active()->get();
        return view('front.category',['cat' => $cat, 'cat_games' => $cat_games]);
    }
    
    /**
     * get new games
     */
    public function popular()
    {
        $cat = ['title' => 'Popular Games'];
        $cat_games = Game::where('is_popular', 1)->latest()->active()->get();
        return view('front.category',['cat' => $cat, 'cat_games' => $cat_games]);
    }

    /**
     * ٍShow custom page
     */
    public function page($id)
    {
        $page = Page::whereId($id)->active()->first();
        return view('front.page',['page' => $page]);
    }

}
