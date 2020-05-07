<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;

class CouponController extends Controller
{

    public function dataTableCoupon()
    {
        return Laratables::recordsOf(Coupon::class, function($query)
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
        return view('admin.coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('parent_id')->get()->nest()->setIndent('|-- ')->listsFlattened('name');
        return view('admin.coupon.create', compact('categories'));
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
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:coupons',
            'value' => 'required|numeric',
            'start_date' => 'nullable|date|required_with:end_date',
            'end_date' => 'nullable|date|required_with:start_date|after:start_date',
            'minimum_spend' => 'nullable|numeric',
            'maximum_spend' => 'nullable|numeric',
            'usage_limit_per_coupon' => 'nullable|numeric',
            'usage_limit_per_customer' => 'nullable|numeric'
        ]);

        $request['free_shipping'] = (boolean) $request->free_shipping;
        $request['is_active'] = (boolean) $request->is_active;

        $coupon = Coupon::create($request->all());
        $coupon->categories()->attach($request->categories);
        $coupon->products()->attach($request->products);

        if($coupon){
            return response()->json(['success' => 'Coupon successfully created!']);
        }else{
            return response()->json(['error' => 'Ops! Please try again']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        $categories = Category::orderBy('parent_id')->get()->nest()->setIndent('|-- ')->listsFlattened('name');
        return view('admin.coupon.edit', compact('categories', 'coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:coupons,code,'.$coupon->id,
            'value' => 'required|numeric',
            'start_date' => 'nullable|date|required_with:end_date',
            'end_date' => 'nullable|date|required_with:start_date|after:start_date',
            'minimum_spend' => 'nullable|numeric',
            'maximum_spend' => 'nullable|numeric',
            'usage_limit_per_coupon' => 'nullable|numeric',
            'usage_limit_per_customer' => 'nullable|numeric'
        ]);

        $request['free_shipping'] = (boolean) $request->free_shipping;
        $request['is_active'] = (boolean) $request->is_active;

        $coupon->update($request->all());

        $coupon->categories()->sync($request->categories);
        $coupon->products()->sync($request->products);

        if($coupon){
            return response()->json(['success' => 'Coupon successfully updated!']);
        }else{
            return response()->json(['error' => 'Ops! Please try again']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = Coupon::destroy($request->id);

        if($delete){
            return response()->json(['success' => 'Coupon successfully delete!']);
        }else{
            return response()->json(['error' => 'Ops! Please try again']);
        }
    }

    public function updateStatus(Coupon $coupon)
    {
        $data = [];
        if($coupon->is_active){
            $data['is_active'] = false;
        }else{
            $data['is_active'] = true;
        }

        $statusUpdate = $coupon->update($data);

        if ($statusUpdate) {
            if ($coupon->status) {
                return response()->json(['success' => 'Coupon successfullly published!']);
            }else{
                return response()->json(['success' => 'Coupon successfullly unpublished!']);
            }
        }else{
            return response()->json(['error' => 'Ops! please try again!']);
        }
    }
}
