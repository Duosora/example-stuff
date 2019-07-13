<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests;
use App\Like;
use App\Post;
use App\User;
use Session, DB;
use Auth;

class searchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
           // Gets the query string from our form submission
           $search = \Request::get('search');
           // Searches for Posts titles //
           $Posts = Post::where('title', 'LIKE', '%' . $search . '%')->paginate(5);
           return view('search', compact('Posts','search'));
    }


}
