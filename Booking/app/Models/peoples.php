<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class peoples extends Model
{
    protected $table = "peoples";
	protected $guarded = ['id'];   
	protected $timestamp = true;
	public function users()
	{
		return $this->belongsTo('App\Models\users','users_id');
	}
	public function cities()
	{
		return $this->belongsTo('App\Models\cities','cyti_id');
	}
	public function bookrooms()
    {
        return $this->hasOne('App\Models\bookrooms');
    }
	
}
