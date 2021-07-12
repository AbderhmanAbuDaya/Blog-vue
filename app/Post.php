<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Post extends Model
{
    protected $guarded=[];
 public $timestamps=true;
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class,'post_id','id');
    }
    //change return find method
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function getCreatedAtAttribute($value){
        return  \Carbon\Carbon::createFromTimeStamp(strtotime($value))->diffForHumans();
    }
    public function numComments(){
        return $this->comments->count();
    }
}
