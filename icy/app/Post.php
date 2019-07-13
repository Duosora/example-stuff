<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Comment;
use App\User;
use App\Like;
use App\Deslike;

class Post extends Model
{
   public $fillable = ['title','body','author_id'];

    // THIS function category TO MAKE RELATHION WITH Post
     public function category()
    {
        return $this->belongsTo('App\Category','category_id');


    }
    // THIS function comments TO MAKE RELATHION WITH Post
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    //For getting slug with -
    public function getSlugAttribute ($value){
        $value =  strtolower(preg_replace("/[^a-zA-Z0-9]+/",'-',$value));
        return $value;

    }

     // THIS function liks TO MAKE RELATHION WITH Post
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
     // THIS function deslikes TO MAKE RELATHION WITH Post
    public function deslikes()
    {
        return $this->hasMany('App\Deslike');
    }
    // THIS function user TO MAKE RELATHION WITH Post
    public function user()
    {
        return $this->belongsTo('App\User','author_id');
    }

}
