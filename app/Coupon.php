<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
	/**
	 * [$fillable description]
	 * @var [type]
	 */
    protected $fillable = ['name', 'code', 'value', 'is_percent', 'free_shipping', 'minimum_spend', 'maximum_spend', 'usage_limit_per_coupon', 'usage_limit_per_customer', 'used', 'is_active', 'start_date', 'end_date'];

    /**
     * [products description]
     * @return [type] [description]
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'coupon_products');
    }

    /**
     * [categories description]
     * @return [type] [description]
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'coupon_categoris');
    }

    // custome laratable function 
    
    /**
     * [laratablesCustomAction description]
     * @param  [type] $action [description]
     * @return [type]         [description]
     */
    public static function laratablesCustomAction($action)
    {
    	$route =  strtolower(class_basename(get_class()));
    	return view('layouts.partials.admin.action')->with([
    		'action' => $action,
    		'route' => $route,
    		'view' => false,
    		'switch' => true,
    	])->render();
    }

    public static function laratablesIsActive($coupon)
    {
        if ($coupon->is_active) {
            return '<span class="badge badge-soft-info">Active</span>';
        }else{
            return '<span class="badge badge-soft-warning">Inactive</span>';
        }
    }
}
