<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Midea;
use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use Storage;


class MideaController extends Controller
{

    public function dataTableMidea()
    {
        return Laratables::recordsOf(Midea::class, function($query){
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
        return view('admin.midea.index');
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
        $image = $request->file('file');

        if(!Storage::disk('public')->exists('images')){
            Storage::disk('public')->makeDirectory('images');
        }

        $data = [];
        $data['name'] = $image->getClientOriginalName();
        $data['path'] = $image->store('images');
        $data['extension'] = $image->getClientOriginalExtension();
        $data['size'] = $image->getSize();

        $upload = Midea::create($data);

        if($upload){
            return response()->json(['success' => 'Image successfully uploaded!']);
        }else{
            return response()->json(['error' => 'Ops! please try again!']); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Midea  $midea
     * @return \Illuminate\Http\Response
     */
    public function show(Midea $midea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Midea  $midea
     * @return \Illuminate\Http\Response
     */
    public function edit(Midea $midea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Midea  $midea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Midea $midea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Midea  $midea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = Midea::find($request->id)->each( function ($image){
            
            $this->removeImage($image->path);
            $image->delete();
        });
        if($delete){
            return response()->json(['success' => 'Image successfully deleted!']);
        }else{
            return response()->json(['error' => 'Deleting failed! Please try again!']);
        }
    }

    /**
     * [removeImage common function in remove file/image]
     * @param  [string] $path [peramiter]
     * @return [type]       [description]
     */
    private function removeImage($path)
    {
        if(Storage::disk('public')->exists($path)){
            Storage::disk('public')->delete($path);
        }
    }
}
