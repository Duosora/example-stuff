<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Post;
use App\Category;

class Bannedips extends Model
{
    protected $fillable = [
        'id', 'ip'
    ];
}
