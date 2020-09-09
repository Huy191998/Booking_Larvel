<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class roomcategorys extends Model
{
    protected $table = "roomcategory";
	protected $guarded = ['id'];   
	protected $timestamp = true;
	public function rooms()
	{
		return $this->hasMany('App\Models\rooms');
	}
	
}
