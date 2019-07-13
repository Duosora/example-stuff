<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Post;


class Deslike extends Model
{
     protected $fillable = [
        'user_id', 'post_id','deslike','type'
    ];

    protected $with = ['user'];
    /**
     * Get the Post that owns the Deslike.
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
     // THIS function user TO MAKE RELATHION WITH Deslike
    public function user()
    {
        return $this->belongsTo('App\User');
    } 
}
