<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kindrooms extends Model
{
    protected $table = "kindrooms";
	protected $guarded = ['id'];   
	protected $timestamp = true;
	public function rooms()
	{
		return $this->hasMany('App\Models\rooms');
	}
	
}
