<?php

namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\AttributeSet;
use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\File;
use App\Option;
use App\Product;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Freshbitsweb\Laratables\Laratables;

class ProductController extends Controller
{

    public function dataTableProduct()
    {
        return Laratables::recordsOf(Product::class, function($query)
        {
            return $query->latest('id');
        });
    }

    public function getProducts()
    {
        return response()->json( Product::all());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::nestedCategory();
        $brands = Brand::all();
        $attributesets = AttributeSet::all();
        $options = Option::where('is_global', 1)->get();
        return view('admin.product.create',compact('categories','brands','attributesets','options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $slug = str_slug($request->name);
        $product = Product::whereSlug($slug)->first();
        
        $request['status'] = (boolean)$request->status;
        $request['slug'] = $product ? "$slug-$request->sku" : $slug;
        $request['qr_code'] = "storage/images/$request->sku.png";

        $product = Product::create($request->all());

        $product->saveRelations($request);
        
        QrCode::format('png')->size(399)->generate($request->sku, storage_path("app/public/images/$request->sku.png"));

        if($product){
            return response()->json(['success' => 'Product successfully created!']);
        }else{
            return response()->json(['error' => 'Ops! please try again!']); 
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->load('categories', 'brand', 'attributes', 'options', 'metadata', 'medias');
        return view('admin.product.view',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::nestedCategory();
        $brands = Brand::all();
        $attributesets = AttributeSet::all();
        $options = Option::where('is_global', 1)->get();
        
        $product->load('categories', 'brand', 'attributes', 'options', 'metadata', 'medias');
        return view('admin.product.edit', compact('categories', 'brands', 'attributesets', 'options', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request['status'] = (boolean)$request->status;
        $request['slug'] = str_slug($request->url);

        $request['qr_code'] = "storage/images/$request->sku.png";

        if ($product->sku != $request->sku) {
            if(file_exists( public_path($product->qr_code)) ){
                unlink($product->qr_code);
                QrCode::format('png')->size(399)->generate($request->sku, storage_path("app/public/images/$request->sku.png"));
            }else{
                QrCode::format('png')->size(399)->generate($request->sku, storage_path("app/public/images/$request->sku.png"));
            }
        }

        $product->update($request->all());

        $product->saveRelations($request);

        if($product){
            return response()->json(['success' => 'Product successfully updated!']);
        }else{
            return response()->json(['error' => 'Ops! please try again!']); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = Product::findOrFail($request->id)->each(function ($product){
            $product->medias()->detach();
            $product->metadata()->delete();
            if(File::exists($product->qr_code)) {
                File::delete($product->qr_code);
            }
            $product->delete();  
        });

        if($delete){
            return response()->json(['success' => 'Product successfully deleted!']);
        }else{
            return response()->json(['error' => 'Ops! please try again!']); 
        }
    }

    public function updateStatus(Product $product)
    {
        {
        $data = [];
        if($product->status){
            $data['status'] = false;
        }else{
            $data['status'] = true;
        }

        $statusUpdate = $product->update($data);

        if ($statusUpdate) {
            if ($product->status) {
                return response()->json(['success' => 'Product successfullly published!']);
            }else{
                return response()->json(['success' => 'Product successfullly unpublished!']);
            }
        }else{
            return response()->json(['error' => 'Ops! please try again!']);
        }

    }
    }



    // ajax function
    public function attributeValues(Attribute $attribute)
    {
        $values = $attribute->values;
        return view('admin.product.ajax.values', compact('values'));
    }


    public function optionValues(Option $option)
    {
        return view('admin.product.ajax.options', compact('option'));
    }
}
