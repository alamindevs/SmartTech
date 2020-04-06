<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    /**
	 * [$fillable description]
	 * @var [type]
	 */
     protected $fillable = ['attribute_id', 'value', 'status'];
}
