<?php

class UserController extends \BaseController {

	/**
	 * Rules for validating register new user
	 * 
	 * @var array
	 */
	private $registerRules = array(
		'email' 						=> 'required|email',
		'username' 					=> 'required|alphaNum|min:4',
    'fullname'          => 'required',
		'password' 					=> 'required|alphaNum|min:5',
		'validate_password' => 'required|alphaNum|min:5'
		);

	/**
   * Register user
   * 
   * @return Response
   */
  public function register()
  {

    $validator = Validator::make(Input::all(), $this->registerRules);

    if ($validator->fails()) {
      $error = $validator;

      return Redirect::back()->withErrors(array(
        'message' => 'There were some inputs that not valid',
        'status'	=> false
        )); 
    } else {
      
      $userdata = new User;
      $userdata->email = Input::get('email');
      $userdata->username = Input::get('username');
      $userdata->fullname = Input::get('fullname');
      $userdata->password = Hash::make(Input::get('password'));

      if ($userdata->save()) {
        $follower = new Follower;
        $follower->id = $userdata->id;
        $follower->followed_id = $userdata->id;
        $follower->timestamps = false;
        if($follower->save()) {
          return Redirect::back()->with(array(
            'message' => 'You have successfully registered, please log in to continue',
            'status'	=> true
            )); 
        }
      } else {        

        return Redirect::back()->withErrors(array(
          'message' => 'Your request couldn\'t be performed due to server error, please try again later',
          'status'	=> false
          )); 

      }

    }
  }

  /**
   * Follow a user
   * 
   * @return Response
   */
  public function follow() 
  {
  	$toFollowId = Input::get('to_follow_id');
  	$userId = Auth::user()->id;

  	if(!$toFollowId) {
  		return Redirect::back()->withErrors(array(
  			'message' => 'This request should be provided by a parameter',
  			'status'	=> false
  			));
  	}

  	$toFollow = User::where('id', $userId)
  									->where('followedId', $toFollowId)
  									->first();

  	if(!$toFollow) {
  		return Redirect::back()->withErrors(array(
  			'message' => 'The parameter that you\'ve sent is not exist in database',
  			'status'	=> false
  			));
  	}

  	$follower = new Follower;
  	$follower->id = $userId;
  	$follower->followed_id = $toFollowId;
  	$follower->timestamps = false;
  	$follower->save();

  	return Redirect::back()->with(array(
  		'message' => 'You have successfully followed another user',
  		'status'	=> true
  		));
  }

  /**
   * Unfollow a user
   * 
   * @return Response
   */
  public function unfollow()
  {
  	$toUnfollowId = Input::get('to_unfollow_id');
  	$userId = Auth::user()->id;

  	if(!$toUnfollowId) {
  		return Redirect::back()->withErrors(array(
  			'message' => 'This request should be provided by a parameter',
  			'status'	=> false
  			));
  	}

  	$toUnfollow = User::where('id', $userId)
		  								->where('followedId', $toUnfollowId)
		  								->first();

  	if(!$toUnfollow) {
  		return Redirect::back()->withErrors(array(
  			'message' => 'The parameter that you\'ve sent is not exist in database',
  			'status'	=> false
  			)); 
  	}

  	$toUnfollow->delete();

  	return Redirect::back()->with(array(
  		'message' => 'You have successfully unfollowed another user',
  		'status'	=> true
  		));
  }

}
