<?php

namespace App;
use App\User;
use App\Post;


use Illuminate\Database\Eloquent\Model;


class Point extends Model
{
    protected $fillable = [
        'id', 'Points', 'user_id'
    ];

    protected $with = ['user'];

     // THIS function user TO MAKE RELATHION WITH Point
    public function user()
    {
        return $this->belongsTo('App\User');
    } 
}
