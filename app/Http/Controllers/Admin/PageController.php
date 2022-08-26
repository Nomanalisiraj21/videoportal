<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $pages = Page::all();
        return view('admin.page.index', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'Required|max:254|unique:pages',
            'content' => 'Required',
            'ar_title' => '',
            'ar_content' => '',
            'pos' => 'integer'
        ]);

        $page = new Page();
        $page->fill($data);
        $page->save();
        return back()->with('success', 'Page added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page, Request $request)
    {
        $request->validate([
            'status' => 'required|integer'
        ]);

        if($page->id){
            $page->status = $request->status;
            $page->update();
            return back()->with('success', 'Status changed');
        }else{
            return back()->with('error', 'Some error, status not changed');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        if(isset($page->id)){
            return view('admin.page.edit', ['page' => $page]);

        }else{
            return back()->with('error', 'Something Wrong!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $data = $request->validate([
            'title' => 'Required|max:254',
            'content' => 'Required',
            'ar_title' => '',
            'ar_content' => '',
            'pos' => 'integer'
        ]);

        $page->fill($data);
        $page->update();
        return redirect()->route('admin.page.index')->with('success', 'Page updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        if($page->id){
            Page::destroy($page->id);
            return back()->with('success', 'Page deleted successfully.');
        }
        
        return back()->with('error', 'Error: Something wrong.');
    }
    
}
