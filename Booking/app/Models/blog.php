<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    protected $table = 'blog';
    //2.field id khong dược phép tương tác còn lại tất cả
    protected $guarded  = ['id'];
    //3.option cho phép lưu timestamp
    protected $timestamp = true;

    public function tag()
    {
        return $this->belongsToMany('App\Models\Tag','blogtag','blog_id','tag_id');
    }
    public function seo()
    {
        return $this->morphMany('App\Models\Seoable','seoble');
    }
}
