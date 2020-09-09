<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $table = "users";
	protected $guarded = ['id'];   
	protected $timestamp = true;
	public function peoples()
	{
		return $this->hasOne('App\Models\peoples');
	}
	public function hotel()
	{
		return $this->hasOne('App\Models\hotel');
	}
	public function comments()
	{
		return $this->hasOne('App\Models\comments');
	}

}
