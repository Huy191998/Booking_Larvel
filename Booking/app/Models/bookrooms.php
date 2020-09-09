<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bookrooms extends Model
{
    protected $table = "bookrooms";
    protected $guarded = ['id'];
    protected $timestamp = true;


    public function hotels()
    {
        return $this->belongsTo('App\Models\hotel','hotels_id');
    }
    public function rooms()
    {
        return $this->belongsTo('App\Models\rooms','rooms_id');
    }
     public function peoples()
    {
        return $this->belongsTo('App\Models\peoples','peoples_id');
    }
    public function  bookings()
    {
        return $this->belongsTo('App\Models\bookings');
    }

}
