<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{	

	public function values()
	{
		return $this->hasMany(AttributeValue::class);
	}
	/**
	 * [$fillable description]
	 * @var [type]
	 */
     protected $fillable = ['attribute_set_id', 'name', 'slug', 'status'];

    /**
	 * Returns the action column html for datatables.
	 * @param \App\AttributeSet
	 * @return string
	 */
    public static function laratablesCustomAction($action)
    {
    	// $route =  strtolower(class_basename(get_class()));
    	$route =  'attribute';
    	return view('layouts.partials.admin.action')->with([
    		'action' => $action,
    		'route' => $route,
    		'view' => false,
    		'switch' => true,
    	])->render();
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
