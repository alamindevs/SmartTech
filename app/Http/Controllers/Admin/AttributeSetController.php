<?php

namespace App\Http\Controllers\Admin;

use App\AttributeSet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;

class AttributeSetController extends Controller
{


    public function dataTableAttributeset()
    {
        return Laratables::recordsOf(AttributeSet::class, function($query){
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
        return view('admin.attributeset.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attributeSet.create');
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
            'name' => 'required|string|max:255'
        ]);
        $slug = str_slug($request->name);
        $findSlug = AttributeSet::where('slug',$slug)->first();

        $data = [];
        $data['name'] = $request->name;
        $data['slug'] = $findSlug ? str_slug($request->name).'-'.str_random(10) : $slug;
        $data ['status'] = (bool) $request->status;

        $update = AttributeSet::create($data);

        if($update){
            return response()->json(['success' => 'Attribute Set successfully updated!']);
        }else{
            return response()->json(['error' => 'Ops! please try again!']); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AttributeSet  $attributeSet
     * @return \Illuminate\Http\Response
     */
    public function show(AttributeSet $attributeSet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AttributeSet  $attributeSet
     * @return \Illuminate\Http\Response
     */
    public function edit(AttributeSet $attributeSet)
    {
        return view('admin.attributeset.edit',compact('attributeSet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AttributeSet  $attributeSet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttributeSet $attributeSet)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $slug = str_slug($request->name);
        $findSlug = AttributeSet::where('slug',$slug)->first();

        $data = [];
        $data['name'] = $request->name;
        $data['slug'] = $findSlug ? str_slug($request->name).'-'.str_random(10) : $slug;
        $data ['status'] = (bool) $request->status;

        $update = $attributeSet->update($data);

        if($update){
            return response()->json(['success' => 'Attribute Set successfully updated!']);
        }else{
            return response()->json(['error' => 'Ops! please try again!']); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AttributeSet  $attributeSet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        $delete = AttributeSet::destroy($request->id);

        if($delete){
            return response()->json(['success' => 'Attribute Set successfully deleted!']);
        }else{
            return response()->json(['error' => 'Deleting failed! Please try again!']);
        }
    }


    public function updateStatus(AttributeSet $attributeSet)
    {
        $data = [];
        if($attributeSet->status){
            $data['status'] = false;
        }else{
            $data['status'] = true;
        }

        $statusUpdate = $attributeSet->update($data);

        if ($statusUpdate) {
            if ($attributeSet->status) {
                return response()->json(['success' => 'Product successfullly published!']);
            }else{
                return response()->json(['success' => 'Product successfullly unpublished!']);
            }
        }else{
            return response()->json(['error' => 'Ops! please try again!']);
        }
    }

    
}
