<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Post;
use App\Category;

class Like extends Model
{
    protected $fillable = [
        'user_id', 'post_id', 'like', 'type'
    ];

    protected $with = ['user'];
    /**
     * Get the Post that owns the Like.
     */
    public function post()
    {
        return $this->belongsTo('App\Post','post_id');
    }
     // THIS function user TO MAKE RELATHION WITH Like
    public function user()
    {
        return $this->belongsTo('App\User');
    } 
    // THIS function category TO MAKE RELATHION WITH Like
     public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
