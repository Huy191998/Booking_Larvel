<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class regions extends Model
{
    protected $table = "regions";
	protected $guarded = ['id'];   
	protected $timestamp = true;
	public function cities()
	{
		return $this->hasMany('App\Models\cities');
	}

}
