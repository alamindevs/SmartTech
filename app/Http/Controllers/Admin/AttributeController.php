<?php

namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\AttributeSet;
use App\Http\Controllers\Controller;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;

class AttributeController extends Controller
{

    /**
     * [dataTableAttribute description]
     * @return [type] [description]
     */
    public function dataTableAttribute()
    {
        return Laratables::recordsOf(Attribute::class, function($query)
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
        return view('admin.attribute.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributesets = AttributeSet::active()->get();
        return view('admin.attribute.create',compact('attributesets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'attribute_set_id' => 'required|integer',
            'name' => 'required|string|max:190',
        ],[
            'attribute_set_id.required' => 'Attribute Set field is required'
        ]);

        $slug = str_slug($request->name);
        $findSlug = Attribute::where('slug',$slug)->first();

        $data = [];
        $data['attribute_set_id'] = $request->attribute_set_id;
        $data['name'] = $request->name;
        $data['slug'] = $findSlug ? $slug.'-'.str_random(10) : $slug;
        $data['status'] = (boolean) $request->status;

        $attribute = Attribute::create($data);

        $create = $attribute->values()->createMany($request->values);

        if($create){
            return response()->json(['success' => 'Attribute successfully created!']);
        }else{
            return response()->json(['error' => 'Ops! please try again!']); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        $attributesets = AttributeSet::active()->get();
        return view('admin.attribute.edit', compact('attribute', 'attributesets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        $request->validate([
            'attribute_set_id' => 'required|integer',
            'name' => 'required|string|max:190',
        ],[
            'attribute_set_id.required' => 'Attribute Set field is required'
        ]);

        $slug = str_slug($request->name);
        $findSlug = Attribute::where('slug',$slug)->first();

        $data = [];
        $data['attribute_set_id'] = $request->attribute_set_id;
        $data['name'] = $request->name;
        $data['slug'] = $findSlug ? $slug.'-'.str_random(10) : $slug;
        $data['status'] = (boolean) $request->status;

        $attribute->values()->delete();
        $attribute->values()->createMany($request->values);

        $update = $attribute->update($data);

        if($update){
            return response()->json(['success' => 'Attribute successfully updated!']);
        }else{
            return response()->json(['error' => 'Ops! please try again!']); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = Attribute::destroy($request->id);

        if($delete){
            return response()->json(['success' => 'Attribute successfully deleted!']);
        }else{
            return response()->json(['error' => 'Deleting failed! Please try again!']);
        }
    }


    public function updateStatus(Attribute $attribute)
    {
        $data = [];
        if($attribute->status){
            $data['status'] = false;
        }else{
            $data['status'] = true;
        }

        $statusUpdate = $attribute->update($data);

        if ($statusUpdate) {
            if ($attribute->status) {
                return response()->json(['success' => 'Product successfullly published!']);
            }else{
                return response()->json(['success' => 'Product successfullly unpublished!']);
            }
        }else{
            return response()->json(['error' => 'Ops! please try again!']);
        }
    }
}
