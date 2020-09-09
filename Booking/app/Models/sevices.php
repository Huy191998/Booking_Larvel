<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sevices extends Model
{
    protected $table = "sevices";
	protected $guarded = ['id'];   
	protected $timestamp = true;
	public function rooms()
	{
		return $this->belongsToMany('App\Models\rooms','posts','sevices_id','rooms_id');
	}
	public function posts()
    {
    	return $this->hasMany('App\Models\posts');
    }
}
