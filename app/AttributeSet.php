<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeSet extends Model
{
    /**
	 * [$fillable description]
	 * @var [type]
	 */
    protected $fillable = ['name','slug','status'];

    /**
     * [attributes description]
     * @return [type] [description]
     */
    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
    /**
	 * Returns the action column html for datatables.
	 * @param \App\AttributeSet
	 * @return string
	 */
    public static function laratablesCustomAction($action)
    {
    	// $route =  strtolower(class_basename(get_class()));
    	$route =  'attribute-set';
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

    /**
     * [scopeActive description]
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
}
