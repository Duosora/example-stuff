<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Category;
use App\Like;
use App\Post;
use App\User;
use Session;
use Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $FeatPosts = Post::where('feature', '!=', null)->orderBy('created_at','desc')->paginate(5,['*'],'fp');
    	// this query to get all posts and return it to home page //
        $Posts = Post::paginate(12, ['*'], 'op');
        //\Log::info($FeatPosts[0]->author_id);
        // this query to get all Categores and return it to home page //
        $Categores = Category::all();
        return view('home',compact('Categores','Posts', 'FeatPosts'));
    }


    /**
     * This TO RETURN CONTACT PAGE
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        // This TO RETURN CONTACT PAGE  //
        return view('contact');
    }


}
