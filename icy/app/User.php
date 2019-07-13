<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Comment;
use App\Post;
use App\Like;
use App\Deslike;
use App\Category;
use App\Point;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar','role_id','latestip'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
     // THIS function comments TO MAKE RELATHION WITH USERS
     public function comments()
    {
        return $this->hasMany('App\Comment');
    }

     // THIS function Points TO MAKE RELATHION WITH USERS
     public function Points()
    {
        return $this->hasMany('App\Point');
    }


    // THIS function likes TO MAKE RELATHION WITH USERS
     public function likes()
    {
        return $this->hasMany('App\Like');
    }

    // THIS function deslikes TO MAKE RELATHION WITH USERS
     public function deslikes()
    {
        return $this->hasMany('App\Deslike');
    }
    // THIS function Post TO MAKE RELATHION WITH USERS
     public function posts()
    {
        return $this->hasMany('App\Post');
    }
   // THIS function category TO MAKE RELATHION WITH USERS
     public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
