<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\NestableTrait;

class Category extends Model
{
	/**
	 * use trait;
	 */
	use NestableTrait;

	/**
	 * [$fillable category table column ]
	 * @var [type]
	 */
    protected $fillable = ['name', 'slug', 'parent_id', 'status'];

    /**
     * [nestedCategory return category with nested cateogry( useing package) ]
     * @return [type] [return nested category]
     */
    public static function nestedCategory()
    {
    	return static::select('id', 'parent_id', 'name')
			    	->orderBy('parent_id')
			    	->get()
			    	->nest()
			    	->setIndent('|-- ')
			    	->listsFlattened('name');
    }
}
