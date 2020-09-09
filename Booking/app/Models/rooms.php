<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rooms extends Model
{
    protected $table = "rooms";
	protected $guarded = ['id'];   
	protected $timestamp = true;
	public function regions()
	{
		return $this->belongsTo('App\Models\regions','regions_id');
	}
	public function hotels()
	{
		return $this->belongsTo('App\Models\hotel','hotels_id');
	}
	public function posts()
	{
		return $this->hasMany('App\Models\posts');
	}
	public function images()
	{
		return $this->hasMany('App\Models\images');
	}
	public function kindrooms()
	{
		return $this->belongsTo('App\Models\kindrooms');
	}
	public function roomcategory()
	{
		return $this->belongsTo('App\Models\roomcategorys');
	}
	public function sevices()
    {
    	return $this->belongsToMany('App\Models\sevices','posts','rooms_id','sevices_id');
    }
    public function comments()
	{
		return $this->hasOne('App\Models\comments');
	}
	public function bookrooms()
	{
		return $this->hasMany('App\Models\bookrooms');
	}
}
