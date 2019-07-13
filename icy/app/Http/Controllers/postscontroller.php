<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Category;
use Embed\Embed;
use TCG\Voyager\Models\User;
use App\Http\Requests;
use App\Post;
use App\Deslike;
use Session;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Point;
use DateTime;
use App\Bannedips;
use function GuzzleHttp\json_decode;
use League\Flysystem\Exception;

class postscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
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
        // unset guest poster cookie
        setcookie('poster', '', time() - 86400, "/");
        $Categores = Category::all();
        if (Auth::id()){
        // this query to get all Categores and return it to home page //
        return view('posts.create',compact('Categores'));}
        else {
            return redirect()->route('guestcreate');
        }
    }

    public function guestCreate(){
        // this query to get all Categores and return it to home page //
        $Categores = Category::all();
        setcookie('poster','guest', time() + (1000 * 60), "/");
        return view('posts.create_guest',compact('Categores'));
    }

    // Set all array values unless you are only verifying your key, then just set 'blog'

//	$comment['blog'] = "";
//	$comment['user_ip'] = "";
//	$comment['user_agent'] = "";
//	$comment['referrer'] = "";
//	$comment['permalink'] = "";
//	$comment['comment_type'] = "";
//	$comment['comment_author'] = "";
//	$comment['comment_author_email'] = "";
//	$comment['comment_author_url'] = "";
//	$comment['comment_content'] = "";

function akismetCheckRaw( $key, $data ) {
    $request = 'blog='. urlencode($data['blog']) .
     '&user_ip='. urlencode($data['user_ip']) .
     '&user_agent='. urlencode($data['user_agent']) .
     '&referrer='. urlencode($data['referrer']) .
     '&permalink='. urlencode($data['permalink']) .
     '&comment_type='. urlencode($data['comment_type']) .
     '&comment_author='. urlencode($data['comment_author']) .
     '&comment_author_email='. urlencode($data['comment_author_email']) .
     '&comment_author_url='. urlencode($data['comment_author_url']) .
     '&comment_content='. urlencode($data['comment_content']);
    $host = $http_host = $key.'.rest.akismet.com';
    $path = '/1.1/comment-check';
    $port = 443;
    $akismet_ua = "WordPress/4.4.1 | Akismet/3.1.7";
    $content_length = strlen( $request );
    $http_request  = "POST $path HTTP/1.0\r\n";
    $http_request .= "Host: $host\r\n";
    $http_request .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $http_request .= "Content-Length: {$content_length}\r\n";
    $http_request .= "User-Agent: {$akismet_ua}\r\n";
    $http_request .= "\r\n";
    $http_request .= $request;
    $response = '';
    if( false != ( $fs = @fsockopen( 'ssl://' . $http_host, $port, $errno, $errstr, 10 ) ) ) {

    fwrite( $fs, $http_request );

    while ( !feof( $fs ) )
    $response .= fgets( $fs, 1160 ); // One TCP-IP packet
    fclose( $fs );

    $response = explode( "\r\n\r\n", $response, 2 );
    }

    if ( 'true' == $response[1] )
    return true;
    else
    return false;
    }


public function akismetCheck( $comment , $type , $key )
{
    $payload = http_build_query($comment);
    switch ($type)
    {
    case "verify-key":
        $call = "1.1/verify-key";
        $payload = "key={$key}&blog={$comment['blog']}";
        break;

    case "check-spam":
        $call = "1.1/comment-check";
        break;

    case "submit-spam":
        $call = "1.1/submit-spam";
        break;

    case "submit-ham":
        $call = "1.1/submit-ham";
        break;

    default:
        return "Error: 'type' not recognized";
        break;
    }

$curl = curl_init("http://$key.rest.akismet.com/$call");

curl_setopt($curl,CURLOPT_USERAGENT,"Fuspam/1.3 | Akismet/1.11");
curl_setopt($curl,CURLOPT_TIMEOUT,5);
curl_setopt($curl,CURLOPT_POSTFIELDS,$payload);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);

$i = 0;
do
    {
    $result = curl_exec($curl);

    if ($result === false)
        { sleep(1); }

    $i++;
    }
while ( ($i < 6) and ($result === false) );

if ($result === false)
    { $result = "Error: Repeat Failure"; }

return $result;
}

    function randStrGen($len){
        $result = "";
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789$11";
        $charArray = str_split($chars);
        for($i = 0; $i < $len; $i++){
            $randItem = array_rand($charArray);
            $result .= "".$charArray[$randItem];
        }
        return $result;
    }

    /**
     * THIS FUNCTION CREATES NEW POST IN PAGE POSTS CREATE 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function checkCaptcha($g_recaptcha_response){
            $secret = \Config::get('recaptcha.SECRET');
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$g_recaptcha_response);
            $responseData = json_decode($verifyResponse);
            return $responseData->success;
    }
    public function store(Request $request)
    {          
        $Post = new Post;
        /** GET AUTHOR ID */
        if (!Auth::id()){
            //Check if Captcha is Right    
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

        
        //To get Date Of last Post
         $lastPostTime = Post::where('guestid','=', trim($cookieValue) )->orderBy('created_at','desc')->paginate(1)[0]['created_at'];
         $diffTimeInSeconds = strtotime("now") - strtotime($lastPostTime);
        //To count the number of post in the last 2 minutes
        $nowUnix = strtotime("now");
        $nowFormat = new DateTime("@$nowUnix");
        $now = $nowFormat->format('d-m-Y H:i:s');
        $sinceUnix = $nowUnix - (60 * 2);
        $sinceFormat = new DateTime("@$sinceUnix");
        $since = $sinceFormat->format('d-m-Y H:i:s');

        $Post->guestid = $cookieValue;
        $author_id = 0;
        $Post->author_id = $author_id;
        
        /** GET THE NUMBER OF POSTS IN THE LAST TWO MINUTES */
        $pPQuery = "SELECT count(*) as postCount FROM posts WHERE UNIX_TIMESTAMP(created_at) between '". $sinceUnix ."' and '". $nowUnix ."' AND author_id = ". $author_id ." AND guestid = ". $author_id ."";
        $prevPosts = DB::select( DB::raw($pPQuery) )[0];

       /*** USERS CAN ONLY POST WITHIN 20 seconds or more interval */
       if ($diffTimeInSeconds <= 20){
                return Redirect()->back()->with(['msg' => 'Hold On. You can only post once in 20 seconds']);
       }

       /*** Here is where the User is Flagged and Held Back for 24 hours if 2 minutes posts count exheed 6 */
       if ($prevPosts->postCount >= 6){
        setcookie('guest_flag', sha1('flagged'), time() + 36000, "/");
       return Redirect()->back()->with(['msg' => 'Hold On. You are moving too fast. You have to wait for the next 10 hours to post again']);
      }

        } // END OF CHECKING FOR GUESTS (!AUTH('id'))
        else {
            $author_id = Auth::id();
            $Post->author_id = $author_id;
            //To get Date Of last Post
            $lastPostTime = Post::where('author_id','=', Auth::id())->orderBy('created_at','desc')->paginate(1)[0]['created_at'];
            $diffTimeInSeconds = strtotime("now") - strtotime($lastPostTime);
    
            //To count the number of post in the last 2 minutes
            $nowUnix = strtotime("now");
            $nowFormat = new DateTime("@$nowUnix");
            $now = $nowFormat->format('d-m-Y H:i:s');
    
            $sinceUnix = $nowUnix - (60 * 2);
            $sinceFormat = new DateTime("@$sinceUnix");
            $since = $sinceFormat->format('d-m-Y H:i:s');
        /** GET THE NUMBER OF POSTS IN THE LAST TWO MINUTES */
        $pPQuery = "SELECT count(*) as postCount FROM posts WHERE UNIX_TIMESTAMP(created_at) between '". $sinceUnix ."' and '". $nowUnix ."' AND author_id = ". $author_id ."";
        $prevPosts = DB::select( DB::raw($pPQuery) )[0];

        /*** Here is where we check and stop a flagged user */

        /***  Get the user Details first */
        $checkQuery = "SELECT * FROM users WHERE id = '". $author_id ."'";
        $userDetails = DB::select( DB::raw($checkQuery) )[0];

        /*** CHECK IF USER WAS EVEN FLAGGED AT ALL, THEN CHECK IF FLAGGING PERIOD IS OVER */
        if (trim($userDetails->flag) != ''){
        //Check if it's up to 10 hours
        $diffFor10 = $nowUnix - $userDetails->flag;
        $diffLeftInHours = round((36000 - $diffFor10) / 3600, 2);

        if ($diffFor10 <= 36000){
            return Redirect()->back()->with(['msg' => 'You have been barred from Posting for the Next '.$diffLeftInHours. ' hours']);
        }

       }

       /*** USERS CAN ONLY POST WITHIN 20 seconds or more interval */
       if ($diffTimeInSeconds <= 20){
                return Redirect()->back()->with(['msg' => 'Hold On. You can only post once in 20 seconds']);
       }

       /*** Here is where the User is Flagged and Held Back for 10 hours if 2 minutes posts count exheed 6 */
       if ($prevPosts->postCount >= 6){
       $flagData = array('flag'=>$nowUnix);
       DB::table('users')->where('id', $author_id)->update($flagData);
       return Redirect()->back()->with(['msg' => 'Hold On. You are moving too fast. You have to wait for the next 10 hours to post again']);
      }

} //END OF IF


        $title = $request->input('title');
        // THIS INPUT RETURN FROM CREATE PAGE POST //
        $Post->category_id = $request->input('category_id');
        $Post->title = $title;
        $Post->body = $request->input('body')?$request->input('body'):'';
        $Post->slug = $title;
        $Post->url = $request->input('url');

        //Check if SLUG EXISTS
        $slugQuery = "SELECT * FROM posts WHERE slug = '".$title."'";
        $slugCheck = DB::select( DB::raw($slugQuery) );

        if (count($slugCheck) > 0){
            return Redirect()->back()->with(['msg' => 'Please Change Your Post Title, a post already exist with similar title']);
        }

        // THIS FUNCTION CREATE NEW IMAGE POST IN PAGE POSTS CREATE //
      if ($request->file('image')){
          $file = $request->file('image');
          // THIS FUNCTION TO GET DATE NAME FILE //
          $date = date('FY');
          // THIS TO GET FILE PATCH //
          $destinationPath = 'storage/posts/'.$date.'/';
          $viewimage = 'posts/'.$date.'/';
          $filename = $viewimage.$file->getClientOriginalName();
          $file->move($destinationPath, $filename);
          $Post->image = $filename;
      }

        if ($Post->save()){
        return Redirect()->back()->with(['goodmsg' => 'Your post has been successfully posted <a href="/'.$Post->category->name.'/'.$Post->slug.'-'.$Post->id.'">'.$Post->slug.'</a>']);
        }

       // THIS FUNCTION returns you back  //
       return Redirect()->back()->with(['msg' => 'An Error Occured']);
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function flag(Request $request)
    {
       $id = $request->input('id');
       $flag =  $request->input('flag');
        // THIS WILL UPDATE POST TABLE WITH FLAG VARIAB:E//
        $result = Post::where('id', $id)->update(array('flag' => $flag));
       // THIS FUNCTION return YOU back CHANGE IT TO WAHT YOU WANT  //
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($category = null, $slugAndid = null)
    {
        // Set Guest Guest Commenter(Poster) Cookie
        setcookie('poster', $_SERVER['REQUEST_URI'], time() + 86400, "/");
        $idArr = explode('-',$slugAndid);
        $id = $idArr[count($idArr)-1];
        // this query to get Post and return it to Post page  //
        $Post = Post::where('id', '=', $id)->firstOrFail();
        $Embed = '';
        if ($Post->url != null){
            $Embed = $this->getEmbed($Post->url);
        }
        // this query to get Popular Posts and return it to Popular Posts page  //
        $PopularPosts = Post::orderBy('created_at','desc')->paginate(5);
        // this query to get all Categores and return it to home page //
        $Catmenus = Category::all();
        //To Get All Comments Post  OUT SIDE IN HOME VIEW
        $comments = $Post->comments;
        //To Get All likes Post  OUT SIDE IN HOME VIEW
        $likes = $Post->likes;
        //To Get All des likes Post  OUT SIDE IN HOME VIEW
        $deslikes = $Post->deslikes;
        return view('posts.show', compact('Post','PopularPosts','Catmenus','comments','likes','deslikes','Embed'));
    }

    public function getEmbed($url){
        try {
            if (@file_get_contents($url) == false){throw new Exception($url.'has issues empty');}
            $embed = @Embed::create($url);
            $iframelyKey = \Config::get('embed.iframelyAPIKEY');
            if ($embed->code == false) {
                $data = @file_get_contents('http://iframe.ly/api/iframely?url='.$url.'&api_key='.$iframelyKey);
                Log::info($data);
                if ($data == false){
                    throw new Exception($data.'is empty');
                }
                $iframely = json_decode( $data, true);
                if (array_key_exists('html',$iframely)) {
                    $embed->code = $iframely['html'];
                }
                else {
                    Log::info($iframely);
                    $embed->code = $url;   
                }
            }
        } catch (\Exception $e) {
            $embed = new \stdClass();
            Log::info($e);
            $embed->code = $url;
          }
          catch (\Throwable $e) {
            $embed = new \stdClass();
            Log::info($e);
            $embed->code = $url;
          }
        return $embed;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // TO GET Post SINGLE
        $Post = Post::findOrFail($id);
        // TO GET Post SINGLE AND delete IT
        $Post->delete();
        // TO RETURN BACK BAGE

        return view('success.delete');

    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
}
