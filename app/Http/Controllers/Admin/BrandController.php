<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;

class BrandController extends Controller
{

    /**
     * [dataTableBrand description]
     * @return [type] [description]
     */
    public function dataTableBrand()
    {
        return Laratables::recordsOf(Brand::class, function($query)
        {
            return $query->latest('id');
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
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
            'tagline' => 'nullable|string|max:190',
        ]);

        $data = [];
        $data['name'] = $request->name;
        $data['tagline'] = $request->tagline;
        $data['slug'] = str_slug($request->name);
        $data['image'] = $request->image;
        $data['status'] = (bool) $request->status;

        $create = Brand::create($data);

        if($create){
            return response()->json(['success' => 'Brand Create Successful']);
        }else{
            return response()->json(['error' => 'Ops! please try again!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
         $this->validate($request,[
            'name' => 'required|string|max:190',
            'tagline' => 'nullable|string|max:190',
        ]);

        $data = [];
        $data['name'] = $request->name;
        $data['tagline'] = $request->tagline;
        $data['slug'] = str_slug($request->name);
        $data['image'] = $request->image ?? $brand->image;
        $data['status'] = (bool) $request->status;
        $create = $brand->update($data);
        if($create){
             return response()->json(['success' => 'Brand successfully updated!']);
        }else{
            return response()->json(['error' => 'Ops! please try again!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = Brand::destroy($request->id);

        if ($delete) {
            return response()->json(['success' => 'Brand successfully deleted!']);
        }else{
            return response()->json(['error' => 'Deleting failed! Please try again!']);
        }
    }

    public function updateStatus(Brand $brand)
    {
        $data = [];
        if($brand->status){
            $data['status'] = false;
        }else{
            $data['status'] = true;
        }

        $statusUpdate = $brand->update($data);

        if ($statusUpdate) {
            if ($brand->status) {
                return response()->json(['success' => 'Product successfullly published!']);
            }else{
                return response()->json(['success' => 'Product successfullly unpublished!']);
            }
        }else{
            return response()->json(['error' => 'Ops! please try again!']);
        }

    }
}
