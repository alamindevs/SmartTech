<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Midea extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','path','extension','size'];

    public function path()
    {
    	return 'storage/'.$this->path;
    }
    /**
	 * Returns truncated name for the datatables.
	 *
	 * @param \App\User
	 * @return string
	 */
    public static function laratablesPath($midea)
    {
    	return '<img height="50" src=" ' . asset($midea->path()) .'" alt="{{ $midea->name }}">';
    }

    public static function laratablesCreatedAt($midea)
    {
    	return $midea->created_at->diffForHumans();
    }


    /**
	 * Returns the action column html for datatables.
	 *
	 * @param \App\User
	 * @return string
	 */
    public static function laratablesCustomAction($action)
    {
    	return view('layouts.partials.admin.action')->with([
    		'action' => $action,
    		'route' => strtolower(class_basename(get_class())),
    		'view' => false,
    		'edit' => false,
    		'image' => true,

    	])->render();
    }
}
