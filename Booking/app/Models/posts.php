<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    protected $table = "posts";
	protected $guarded = ['id'];   
	protected $timestamp = true;
	public function rooms()
	{
		return $this->belongsTo('App\Models\rooms','rooms_id');
	}
	public function sevices()
	{
		return $this->belongsTo('App\Models\sevices','sevices_id');
	}
	
}
