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

Route::post('follow', array(
  'as' => 'follow', 
  'before' => 'isLoggedIn', 
  'uses' => 'UserController@follow'
  ));

Route::post('unfollow', array(
  'as' => 'unfollow', 
  'before' => 'isLoggedIn', 
  'uses' => 'UserController@unfollow'));

Route::post('tweet', array(
  'as' => 'tweet', 
  'before' => 'isLoggedIn', 
  'uses' => 'TimelineController@tweet'
  ));
