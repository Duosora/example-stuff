<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Like;
use App\Category;
use App\Http\Requests;
use App\Point;

class Usercontroller extends Controller
{


    public function __construct() {

        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // this query to get all Categores and return it to USERS page //
        $Users = User::where('role_id', '!=', 1)->orwhere('role_id', '=', null)->orderBy('created_at','desc')->paginate(6);
        // this query to get all Points and return it to USERS page //
        $Points = Point::all();
        return view('users.index',compact('Users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Leaderboard()
    {
        // this query to get all Categores and return it to USERS page //
        $Users = User::where('role_id', '!=', 1)->orwhere('role_id', '=', null)->orderBy('created_at','desc')->get();
        // this query to get all Points and return it to USERS page //
        $Points = Point::all();
        // RETURN TO  USERS Leaderboard page //
        return view('users.Leaderboard',compact('Users','Points'));
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {     \Log::error('yeah');
        // this query to get USER SINGLE page //
        $User = User::where('name', '=', $name)->firstOrFail();
        // this query to get ALL Posts USER SINGLE page //
        $Posts = Post::where('author_id','=', $User->id)->paginate(6);
        // this query to get ALL likes USER SINGLE page //
        $User->likes;
        // TO GET USER Likes SINGLE
        $Likes = $User->likes;
        // TO GET USER Points SINGLE
        $User->Points;
        // TO GET USER Points SINGLE
        $Points = $User->Points;
        return view('users.show', compact('User','Posts','Likes','Points'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($name)
    {
        // this query to get USER edit page //
        $User = User::where('name', '=', $name)->firstOrFail();
        // RETURN TO USER edit page //
        return view('users.edit', compact('User'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $name)
    {

        // THIS FUNCTION update User IN PAGE User //
        $User = User::where('name', '=', $name)->firstOrFail();
        // THIS INPUT RETURN FROM UPDATE PAGE USER //
        $User->name = $request->input('name');
        $User->email = $request->input('email');
        $User->password = $request->input('password');
        // THIS FUNCTION UPDATE NEW IMAGE USER IN PAGE USER UPDATE //
         if ($request->file('avatar')){
          $file = $request->file('avatar');
          $date = date('FY');
          $destinationPath = 'storage/users/'.$date.'/';
          $viewimage = 'users/'.$date.'/';
          $filename = $viewimage.$file->getClientOriginalName();
          $file->move($destinationPath, $filename);
          $User->avatar = $filename;
          // THIS TO SAVE  USER UPDATE //
          $User->save();
       }else{
          // THIS TO SAVE  USER UPDATE //
          $User->save();
       }
       // this query to get Posts and return it to USER page  //
        $Posts = Post::where('author_id','=', $User->id)->paginate(5);
        // this query to get likes and return it to USER page  //
        $User->likes;
        // TO GET USER likes SINGLE
        $Likes = $User->likes;
         // TO GET USER Points SINGLE
        $User->Points;
         // TO GET USER Points SINGLE
        $Points = $User->Points;
        return view('users.show', compact('User','Posts','Likes','Points'));
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
