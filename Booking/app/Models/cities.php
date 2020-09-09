<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cities extends Model
{
    protected $table = "cities";
	protected $guarded = ['id'];   
	protected $timestamp = true;
	public function regions()
	{
		return $this->belongsTo('App\Models\Regions','region_id');
	}
	public function peoples()
	{
		return $this->hasOne('App\Models\users');
	}
	
}
