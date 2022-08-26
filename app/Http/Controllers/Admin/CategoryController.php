<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories  = Category::paginate(10);
        return view('admin.category.index', ['categories'=> $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->validate([
            'title' => 'required|string|max:254',
            'description' => '',
            'thumbnail' => 'required|image'
        ]);

        $imageName = time().'.'.$request->thumbnail->extension();  
        $request->thumbnail->move(public_path('storage/category'), $imageName);

        $category = new Category();
        $category->fill($inputs);
        $category->thumbnail = $imageName;
        $category->ar_title = $request->ar_title ?? '';
        $category->ar_description = $request->ar_description ?? '';
        if ($request->has('index'))
            $category->index = $request->index;
        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'Category added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category, Request $request)
    {
        $inputs = $request->validate([
            'status' => 'required'
        ]);

        $category->status = $inputs['status'] ?? 0;
        $category->save();

        return back()->with('success', 'Status updated Successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        return view('admin.category.create', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $inputs = $request->validate([
            'title' => 'required|string|max:254',
            'description' => '',
            'thumbnail' => ''
        ]);

        $category->fill($inputs);

        if($request->has('thumbnail')){
            $old_image = public_path('storage/category/') . $category->thumbnail;
            if(file_exists($old_image)){
                unlink($old_image);
            }

            $imageName = time().'.'.$request->thumbnail->extension();  
            $request->thumbnail->move(public_path('storage/category'), $imageName);
            $category->thumbnail = $imageName;
        }
        if(isset($request->ar_title)){
            $category->ar_title = $request->ar_title ?? '';
            
        }
        if(isset($request->ar_description)){
            $category->ar_description = $request->ar_description ?? '';

        }

        if ($request->has('index'))
            $category->index = $request->index;
        
        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'Category updated Successfully.');
        
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $thumbnail = public_path('/storage/category/' . $category->thumbnail);
        if(file_exists($thumbnail)){
            unlink($thumbnail);
        }
        
        Category::destroy($category->id);
        return back()->with('success', 'Category deleted Successfully.');
    }
    
    /**
     * update position index of resource
     */
    public function position(Request $request)
    {

        $allData = $request->allData;
     
        foreach($allData as $key => $val ){
            $category = Category::find($val);
            $category->index = $key+1;
            $category->update();
        }
       
        return response()->json('Position Change Successfully');
    }
    
}
