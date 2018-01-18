<?php

use App\Events\MessagePosted;
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


    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    Route::get('signup',[
        'uses' => 'UserController@PreSignup',
        'as'=>'signup'
    ]);
    Route::get('signin', function () {
        return view('signin');
    })->name('signin');
    Route::post('postsignup',[
        'uses' => 'UserController@Signup',
        'as' =>'postsignup'
    ]);
    Route::post('postsignin',[
        'uses' => 'UserController@Signin',
        'as' =>'postsignin'
    ]);
    Route::get('/privacypolicy',[
        'uses'=>'UserController@privacy',
        'as'=>'privacypolicy'

    ]);
    Route::get('/termsofservice',[
        'uses'=>'UserController@terms',
        'as'=>'termsofservice'
    ]);

    Route::get('login/facebook',['uses' => 'UserController@redirectToFacebook','as' => 'facebook']);
    Route::get('login/facebook/callback',['uses'=> 'UserController@handleFacebookCallback']);

    Route::get('login/google',['uses' => 'UserController@redirectToGoogle','as' => 'google']);
    Route::get('login/google/callback', 'UserController@handleGoogleCallback');

    Route::get('logout',[
        'uses' => 'UserController@getLogout',
        'as' =>'logout',
   ]);

   Route::get('account',[
       'uses' => 'UserController@getAccount',
       'as' =>'account',
  ]);
   Route::get('fetchfields',[
        'uses' => 'PostController@fetchfields',
        'as' => 'fetchfields'
   ]);
  Route::post('updateaccount',[
  'uses' => 'UserController@postSaveAccount',
  'as'   => 'account.save'
  ]);

  Route::get('userimage/{filename}',[
    'uses' => 'UserController@getUserImage',
    'as'   => 'account.image'
  ]);
  Route::get('myposts',[
    'uses'=>'UserController@myposts',
    'as'=>'myposts'

  ]);
  Route::get('mychats',[
    'uses'=>'UserController@mychats',
    'as'=>'mychats'

  ]);
  Route::get('adduserfield',[
    'uses'=>'UserController@Fetchfield',
    'as'=> 'adduserfield'
  ]);
  Route::get('sendfield',[
    'uses'=>'UserController@sendField',
    'as'=> 'sendfield'
  ]);

    Route::get('dashboard',[
        'uses' => 'PostController@getDashboard',
        'as' =>'dashboard',
   ]);

    Route::post('createpost',[
    'uses' => 'PostController@createPost',
    'as'   => 'createpost'
    ]);

    Route::get('delete-post/{post_id}',[
        'uses' => 'PostController@getDeletePost',
        'as' =>'post.delete',
   ]);
    Route::post('/edit',[
        'uses'=>'PostController@editPost',
        'as'=>'edit'
 ]);

 Route::post('like',[
    'uses' => 'PostController@postLike',
    'as'=>'like',

    ]);
 Route::get('/social',[
     'uses'=>'UserController@social',
     'as'=>'social'
 ]);
 Route::post('/socialup',[
    'uses'=>'UserController@socialup',
    'as'=>'socialup'
]);

  Route::get('/chat',function(){
     return view ('chat');
   });

  Route::get('/messages',function(){
      return App\Message::with('user')->get();
    });

  Route::post('/messages', function () {
      // Store the new message
      $user = Auth::user();

      $message = $user->messages()->create([
          'message' => request()->get('message')
      ]);
      // Announce that a new message has been posted
      broadcast(new MessagePosted($message, $user))->toOthers();
      return ['status' => 'OK'];
  });


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
