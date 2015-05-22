<?php

class UserController extends \BaseController {

	/**
	 * Rules for validating register new user
	 * 
	 * @var array
	 */
	private $rules = array(
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
  public function follow($toFollowId) 
  {
  	// $toFollowId = Input::get('to_follow_id');
  	$userId = Auth::user()->id;

  	if(!$toFollowId) {
  		return Redirect::back()->withErrors(array(
  			'message' => 'This request should be provided by a parameter',
  			'status'	=> false
  			));
  	}

  	$toFollow = Follower::where('id', $userId)
        								->where('followed_id', $toFollowId)
        								->first();

  	if(!$toFollow) {
      $follower = new Follower;
      $follower->id = $userId;
      $follower->followed_id = $toFollowId;
      $follower->timestamps = false;
      $follower->save();

      return Redirect::back()->with(array(
        'message' => 'You have successfully followed another user',
        'status'  => true
        ));
  	}

    return Redirect::back()->withErrors(array(
      'message' => 'The parameter that you\'ve sent is not exist in database',
      'status'  => false
      ));
  }

  /**
   * Unfollow a user
   * 
   * @return Response
   */
  public function unfollow($toUnfollowId)
  {
  	$userId = Auth::user()->id;

  	if(!$toUnfollowId) {
  		return Redirect::back()->withErrors(array(
  			'message' => 'This request should be provided by a parameter',
  			'status'	=> false
  			));
  	}

  	$toUnfollow = DB::table('followers')
                      ->where('id', $userId)
		  								->where('followed_id', $toUnfollowId);

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

  /**
   * Search another account by name
   * 
   * @return View or Redirect
   */
  public function search()
  {
    $query = Input::get('query');

    $user_id = Auth::user()->id;
    $follows = Follower::where('id', $user_id)->select('followed_id')->get();
    $followIds = array();

    foreach($follows as $follow) {
      array_push($followIds, $follow->followed_id);
    }

    if($query) {
      $results = User::where('fullname', 'LIKE', '%'.$query.'%')
                      ->where('username', '!=', Auth::user()->username)
                      ->get();
      return View::make('search', array(
        'query' => $query,
        'results' => $results,
        'followIds'  => $followIds
      ));
    }

    return Redirect::route('home');
  }

}
