<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Comment;
use App\Like;
use App\Deslike;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\deslikerequest;
use App\Http\Requests;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class deslikecontroller extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {

        $this->middleware('auth');

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


      /**
     * Store a newly created resource for comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function commentStore(Request $request)
    {   $type = 'comment';
        $id = $request->input('id');
        Log::info($id);
        // this query to get Post and return it to Post page  //
        Comment::findOrFail($id);

         // Check if post has been liked
         $likeQuery = "SELECT * FROM likes WHERE type = '".$type."' AND user_id = '".Auth::id()."' AND post_id = '".$id."'";
         $likeCheck = DB::select( DB::raw($likeQuery) );
 
         if (count($likeCheck) > 0){ 
            return 'Comment has already been liked by You, You can not like and Dislike a comment at the same time';
        }

         // Check if post has been disliked
         $deslikeQuery = "SELECT * FROM deslikes WHERE type = '".$type."' AND user_id = '".Auth::id()."' AND post_id = '".$id."'";
         $deslikeCheck = DB::select( DB::raw($deslikeQuery) );
 
         if (count($deslikeCheck) > 0){ 
            return 'Comment has already been disliked by You';
        }

        DesLike::create([
            'type' => $type,
            'deslike' => 1,
            'user_id' => Auth::id(),
            'post_id' => $id
        ]);
        // THIS FUNCTION return YOU back CHANGE IT TO WAHT YOU WANT  //
        return 'disliked';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   $type = 'post';
        $id = $request->input('id');
        Log::info($id);
        // this query to get Post and return it to Post page  //
        Post::findOrFail($id);

         // Check if post has been liked
         $likeQuery = "SELECT * FROM likes WHERE type = '".$type."' AND user_id = '".Auth::id()."' AND post_id = '".$id."'";
         $likeCheck = DB::select( DB::raw($likeQuery) );
 
         if (count($likeCheck) > 0){ 
            return 'Post has already been liked by You, You can not like and Dislike a post at the same time';
        }

         // Check if post has been disliked
         $deslikeQuery = "SELECT * FROM deslikes WHERE type = '".$type."' AND user_id = '".Auth::id()."' AND post_id = '".$id."'";
         $deslikeCheck = DB::select( DB::raw($deslikeQuery) );
 
         if (count($deslikeCheck) > 0){ 
            return 'Post has already been disliked by You';
        }

        DesLike::create([
            'type' => $type,
            'deslike' => 1,
            'user_id' => Auth::id(),
            'post_id' => $id
        ]);
        // THIS FUNCTION return YOU back CHANGE IT TO WAHT YOU WANT  //
        return 'disliked';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
