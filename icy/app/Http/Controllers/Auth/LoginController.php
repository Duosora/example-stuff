<?php

namespace App\Http\Controllers\Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    function authenticated(Request $request, $user)
{

       $user->latestip = Request()->ip();
       $user->save();
}

/**

    * Handle Social login request

    *

    * @return response

    */

    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }
 
    /**
 
     * Obtain the user information from Social Logged in.
 
     * @param $social
 
     * @return Response
 
     */

     private function autolog($user,$type,$poster){
        if ($type == 'create'){
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz'.$user->getName();
            User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => substr(str_shuffle($permitted_chars), 0, 10),
                'latestip' => request()->ip()
            ]);
        $user = User::where(['email' => $user->getEmail()])->first();
         }

        Auth::login($user);

        if ( $poster === false){
            return redirect()->action('HomeController@index');
        }
        else { 
            if ($poster === 'guest'){ $poster = 'posts\create';}
            return Redirect::to($poster); } 
     }

    public function handleProviderCallback($social)
    {   // Check if User has been flagged
    
    if (isset($_COOKIE['poster'])) {
        $poster = $_COOKIE['poster'];
    }
    else { $poster = false; }

        $userSocial = Socialite::driver($social)->user();
        $user = User::where(['email' => $userSocial->getEmail()])->first();
        if($user){return $this->autolog($user,'justLog',$poster);}
        return $this->autolog($userSocial,'create',$poster);
    }
}
