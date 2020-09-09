<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';
    //2.field id khong dược phép tương tác còn lại tất cả
    protected $guarded  = ['id'];
    //3.option cho phép lưu timestamp
    protected $timestamp = true;

    public function blog()
    {
        return $this->belongsToMany('App\Models\blog','blogtag','tag_id','blog_id');
    }


}
