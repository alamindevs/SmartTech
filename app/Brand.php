<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{	
	/**
	 * [$fillable description]
	 * @var [type]
	 */
    protected $fillable = ['name','tagline','image','slug','status'];

    /**
	 * Returns the action column html for datatables.
	 *
	 * @param \App\User
	 * @return string
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

    /**
     * [laratablesImage description]
     * @param  [type] $brand [description]
     * @return [type]        [description]
     */
    public static function laratablesImage($brand)
    {
        if ($brand->image) {
            return '<img src="'. asset($brand->image) .'" class="mr-2" alt="" width="60">';
        }else{
            return '<img src="'. asset('contants/admin/assets/images/placeholder.png') .'" class="mr-2" alt="" height="52" width="80">';
        }
    }

    /**
     * [laratablesStatus description]
     * @param  [type] $brand [description]
     * @return [type]        [description]
     */
    public static function laratablesStatus($brand)
    {
        if ($brand->status) {
            return '<span class="badge badge-soft-success">Active</span>';
        }else{
            return '<span class="badge badge-soft-warning">Inactive</span>';
        }
    }
}
