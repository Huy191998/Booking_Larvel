<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class blogtag extends Model
{
    protected $table = 'blogtag';
    //2.field id khong dược phép tương tác còn lại tất cả
    protected $guarded  = ['id'];
    //3.option cho phép lưu timestamp
    protected $timestamp = true;

}
