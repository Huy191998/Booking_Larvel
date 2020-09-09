<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    protected $table = "comments";
	protected $guarded = ['id'];   
	protected $timestamp = true;
	
	public function rooms()
	{
		return $this->belongsTo('App\Models\rooms','roomss_id');
	}
	
	public function users()
    {
    	return $this->belongsTo('App\Models\users','users_id');
    }
}
