<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table = "sliders";
    protected $guarded = ['id'];
    protected $timestrap = true;
}
