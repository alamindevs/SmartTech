<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Option;
use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;

class OptionController extends Controller
{
    /**
     * [dataTableOption description]
     * @return [type] [description]
     */
    public function dataTableOption()
    {
        return Laratables::recordsOf(Option::class, function($query)
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
        return view('admin.option.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.option.create');
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
            'type' => 'required|string|max:190',
        ]);

        $data = [];
        $data['name'] = $request->name;
        $data['type'] = $request->type;
        $data['is_required'] = (bool) $request->is_required;
        $data['is_global'] = (bool) true;

        $option = Option::create($data);

        $create = $option->values()->createMany($request->values);

        if($create){
            return response()->json(['success' => 'Option successfully created!']);
        }else{
            return response()->json(['error' => 'Ops! please try again!']); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {   
        return view('admin.option.edit',compact('option'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        $this->validate($request,[
            'name' => 'required|string|max:190',
            'type' => 'required|string|max:190',
        ]);

        $data = [];
        $data['name'] = $request->name;
        $data['type'] = $request->type;
        $data['is_required'] = (bool) $request->is_required;
        $data['is_global'] = (bool) true;

        $option->values()->delete();
        $option->values()->createMany($request->values);

        $update = $option->update($data);

        if($update){
            return response()->json(['success' => 'Option successfully updated!']);
        }else{
            return response()->json(['error' => 'Ops! please try again!']); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = Option::destroy($request->id);

        if($delete){
            return response()->json(['success' => 'Option successfully deleted!']);
        }else{
            return response()->json(['error' => 'Deleting failed! Please try again!']);
        }
    }
}
