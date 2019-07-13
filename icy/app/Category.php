<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use App\Like;
use App\Deslike;
use App\User;
use App\Post;


class Category extends Model
{
   protected $fillable = [
        'parent_id', 'order','name','slug','imagecat'
    ];
    // THIS function Post TO MAKE RELATHION WITH Category
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
    // THIS function user TO MAKE RELATHION WITH Category
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
