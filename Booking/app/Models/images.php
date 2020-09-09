<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    protected $table = "images";
	protected $guarded = ['id'];   
	protected $timestamp = true;
	public function rooms()
	{
		return $this->belongsTo('App\Models\rooms','rooms_id');
	}
}
