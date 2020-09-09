<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hotel extends Model
{
    protected $table = "hotels";
	protected $guarded = ['id'];
	protected $timestamp = true;
	public function users()
	{
		return $this->belongsTo('App\Models\users','users_id');
	}
	public function cities()
	{
		return $this->belongsTo('App\Models\cities','city_id');
	}
	public function rooms()
	{
		return $this->hasMany('App\Models\rooms');
	}
    public function bookrooms()
    {
        return $this->hasOne('App\Models\bookrooms');
    }
}
