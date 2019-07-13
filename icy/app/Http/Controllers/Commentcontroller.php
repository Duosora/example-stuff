<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Comment;
use App\Point;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Commentrequest;
use App\Http\Requests;
use Illuminate\Support\Facades\Log;

class Commentcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // this function __construct Determine if the user is authorized to make this request. //
    public function __construct() {

        // $this->middleware('auth');

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

    public function checkCaptcha($g_recaptcha_response){
        $secret = \Config::get('recaptcha.SECRET');
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$g_recaptcha_response);
        $responseData = json_decode($verifyResponse);
        return $responseData->success;
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         if (!Auth::id()){
        return $this->gueststore($request);
         }

         if (trim($request->content) == ''){
             return Redirect()->back()->with(['dmsg' => 'You can not post an empty content']);
         }
        // this query to get Post and return it to Post page  //
        $post = Post::findOrFail($request->post_id);
        // THIS FUNCTION TO CREATE COMMENT WITH SINGLE POST  //
        Comment::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'post_id' => $post->id
        ]);
        // THIS FUNCTION TO CREATE Point WITH SINGLE USER  //
        Point::create([
            'Points' => 1,
            'user_id' => Auth::id()
        ]);
        return Redirect()->back()->with(['goodmsg' => 'Post Made Succesfully']);
    }

    public function gueststore(Request $request)
    {  
        
        if (trim($request->content) == ''){
            return Redirect()->back()->with(['dmsg' => 'You can not post an empty content']);
        }

        $g_recaptcha_response = $request->input('g-recaptcha-response');
        if ($this->checkCaptcha($g_recaptcha_response) == false){
         return Redirect()->back()->with(['msg' => 'Incorrect Captcha']);
        } 
        
        // Check if User has been flagged
        if (isset($_COOKIE['guest_flag'])) {
            return Redirect()->back()->with(['msg' => 'You have been barred for the next 10 hours']);
        }

                //Create Cookie (for Unique ID) if it does not exist before
                if (!isset($_COOKIE['guest'])) {
                    $rand = $this->randStrGen(8);
                    $presentTimeInUnix = time();
                    $cookieValue = sha1($rand.$presentTimeInUnix.$_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);
                    setcookie('guest', $cookieValue, time() + (86400 * 30), "/");
                }else {
                    $cookieValue = $_COOKIE['guest'];
                }

        // this query to get Post and return it to Post page  //
        $post = Post::findOrFail($request->post_id);
        // THIS FUNCTION TO CREATE COMMENT WITH SINGLE POST  //
        Comment::create([
            'content' => $request->content,
            'user_id' => 0,
            'guestid' => $cookieValue,
            'post_id' => $post->id
        ]);
        
        return Redirect()->back()->with(['goodmsg' => 'Your comment has been successfully posted']);
            
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
