<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Responses\CategoryTreesResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * [categories description]
     * @return [type] [description]
     */
    public function categoriesTrees()
    {
        $categories = Category::orderBy('parent_id')->get();
        return new CategoryTreesResponse($categories);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::nestedCategory();
        return view('admin.category.index',compact('categories'));
    }

    public function getCategoryAjax()
    {
        $categories = Category::nestedCategory();
        return view('admin.category.option',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:190',
        ]);

        $slug = str_slug($request->name);
        $findSlug = Category::where('slug',$slug)->first();

        $data = [];
        $data['name'] = $request->name;
        $data['parent_id'] = $request->parent_id;
        $data ['slug'] = $findSlug ? $slug.'-'.str_random(10) : $slug;
        $data ['status'] = (bool) $request->status;

        $create = Category::create($data);
        if($create){
            return response()->json(['success' => 'Category Create Successful.']);
        }else{
            return response()->json(['error' => 'Ops! please try again!']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::where('id', '<>', $category->id)
        ->get()->nest()->setIndent('|-- ')->listsFlattened('name');
        return view('admin.category.edit', compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request,[
            'name' => 'required|string|max:190',
            'url' => 'required|string|max:255|unique:categories,slug,'.$category->id,
        ]);

        $data = [];
        $data['name'] = $request->name;
        $data['slug'] = $request->url;
        $data['parent_id'] = $request->parent_id;
        $data['status'] =(bool) $request->status; 

        $update = $category->update($data);
        if($update){
            return response()->json(['success' => 'Category Update Successful']);
        }else{
            return response()->json(['error' => 'Ops! please try again!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = Category::destroy($request->id);
        
        if($delete){
            return response()->json(['success' => 'Category successfully deleted!']);
        }else{
            return response()->json(['error' => 'Deleting failed! Please try again!']);
        }
    }
}
