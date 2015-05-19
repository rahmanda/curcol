<?php
/*
|--------------------------------------------------------------------------
| Routes filter
|--------------------------------------------------------------------------
*/
/**
 * Check if the user has logged in
 */
Route::filter('isLoggedIn', function() {
  if(!Session::has(User::$sessionField['username'])) {
    return Redirect::route('login');
  }
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::get('/', array('as' => 'home', function() {
  if(Session::has(User::$sessionField['username'])) {
    return Redirect::route('timeline');
  }
  return View::make('login');
}));

Route::get('search', array('as' => 'search', 'uses' => 'UserController@search'));

Route::get('register', array('as' => 'register', function() {
  if(Session::has(User::$sessionField['username'])) {
    return Redirect::route('timeline');
  }
  return View::make('register');
}));

Route::post('login', array(
  'as' => 'login', 
  'uses' => 'AuthController@login'
  ));

Route::get('logout', array(
  'as' => 'logout', 
  'uses' => 'AuthController@logout'
  ));

Route::post('register', array(
  'as' => 'register', 
  'uses' => 'UserController@register'
  ));

Route::get('timeline', array(
  'as' => 'timeline', 
  'before' => 'isLoggedIn', 
  'uses' => 'TimelineController@timeline'
  ));

Route::get('profile/{username}', array(
  'as' => 'profile', 
  'before' => 'isLoggedIn', 
  'uses' => 'TimelineController@profileTimeline'
  ));

Route::get('follow/{to_follow_id}', array(
  'as' => 'follow', 
  'before' => 'isLoggedIn', 
  'uses' => 'UserController@follow'
  ));

Route::get('unfollow/{to_unfollow_id}', array(
  'as' => 'unfollow', 
  'before' => 'isLoggedIn', 
  'uses' => 'UserController@unfollow'));

Route::post('tweet', array(
  'as' => 'tweet', 
  'before' => 'isLoggedIn', 
  'uses' => 'TimelineController@tweet'
  ));

Route::get('test/{query}', function($query) {
  $users = User::where('username', 'LIKE', '%'.$query.'%')
              ->orWhere('fullname', 'LIKE', '%'.$query.'%')
              ->get();
  return Response::make($users);
});