<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded=[];
    const ACTIVE_POST = '1';
    public function user(){
    	return $this->belongsTo(User::class,'user_id','id')->select('id','name');
    }

    public function category(){
    	return $this->belongsTo(Category::class,'category_id','id')->select('id','name','slug');
    }

}
