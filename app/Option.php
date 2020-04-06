<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    /**
	 * [$fillable description]
	 * @var [type]
	 */
    protected $fillable = ['name', 'type', 'is_required', 'is_global'];

    /**
     * [values description]
     * @return [type] [description]
     */
    public function values() {
    	return $this->hasMany(OptionValue::class);
    }
    /**
	 * Returns the action column html for datatables.
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
    		// 'switch' => true,
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
