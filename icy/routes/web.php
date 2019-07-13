<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
|--------------------------------------------------------------------------
| Voyager::routes
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'admin'], function () {
    
    Voyager::routes();

});
/*
|--------------------------------------------------------------------------
| Auth::routes
|--------------------------------------------------------------------------
|
*/
Auth::routes();

Route::get('/login/{social}','Auth\LoginController@socialLogin')->where('social','facebook|google');

Route::get('/login/{social}/callback','Auth\LoginController@handleProviderCallback')->where('social','facebook|google');

//-- Guest Post View--//
Route::get('/guest/create', 'postscontroller@guestCreate')->name('guestcreate');

/*
|--------------------------------------------------------------------------
| HomeController HOME PAGE
|--------------------------------------------------------------------------
|
*/
Route::get('/', 'HomeController@index')->name('home');
/*
|--------------------------------------------------------------------------
| Leaderboard PAGE
|--------------------------------------------------------------------------
|
*/
Route::get('/leaderboard', 'Usercontroller@Leaderboard')->name('Leaderboard');

//--UPDATE a link with a flag--//
Route::post('/flag', 'postscontroller@flag')->name('flag');

//--Ban A User's IP--//
Route::post('/banip', 'Altadmincontroller@banip')->name('banip');

//-- Delete All of User's Posts--//
Route::post('/deleteallposts', 'Altadmincontroller@deleteUserPosts')->name('deleteall');

//-- Feature A User's Post--//
Route::post('/featurepost', 'Altadmincontroller@featurePost')->name('featurepost');

//--UPDATE a Post with a like--//
Route::post('/like', 'Likecontroller@store')->name('like');

//--UPDATE a Comment with a like--//
Route::post('/commentlike', 'Likecontroller@commentStore')->name('like');

//--UPDATE a Comment with a like--//
Route::post('/commentdislike', 'DesLikecontroller@commentStore')->name('dislike');


//--UPDATE a Post with a dislike--//
Route::post('/dislike', 'Deslikecontroller@store')->name('dislike');
/*
|--------------------------------------------------------------------------
| Web resource
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
|--------------------------------------------------------------------------
| postscontroller
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| categorescontroller
|--------------------------------------------------------------------------
|
*/
Route::resource('categories','categorescontroller');
/*
|--------------------------------------------------------------------------
| Commentcontroller
|--------------------------------------------------------------------------
|
*/
Route::resource('comments','Commentcontroller');
/*
|--------------------------------------------------------------------------
| Likecontroller
|--------------------------------------------------------------------------
|
*/
Route::resource('likes','Likecontroller');
/*
|--------------------------------------------------------------------------
| Deslikecontroller
|--------------------------------------------------------------------------
|
*/
Route::resource('deslikes','deslikecontroller');
/*
|--------------------------------------------------------------------------
| Usercontroller
|--------------------------------------------------------------------------
|
*/
Route::resource('users','Usercontroller');
/*
|--------------------------------------------------------------------------
| search controller RETURN search PAGE Route
|--------------------------------------------------------------------------
|
*/
Route::get('search', 'searchcontroller@search')->name('search');

/*
|--------------------------------------------------------------------------
| contact PAGE
|--------------------------------------------------------------------------
|
*/
Route::get('contact', 'HomeController@contact')->name('contact');

Route::resource('posts','postscontroller');

Route::get('{category}/{slugAndid}', 'postscontroller@show');

/*
|--------------------------------------------------------------------------
| missing RETURN 404 PAGE Route

|--------------------------------------------------------------------------
|
*/

/* Legal Routes */
Route::get('terms', function () {
    return view('legal/terms');
});
Route::get('privacy', function () {
    return view('legal/privacy');
});
Route::get('content-policy', function () {
    return view('legal/content-policy');
});
Route::get('guidelines', function () {
    return view('legal/guidelines');
});
/* Legal Routes */

Route::get('get-featured', function () {
    return view('legal/get-featured');
});

Route::get('missing', function () {
    return view('404');
});