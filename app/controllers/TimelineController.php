<?php

class TimelineController extends \BaseController {

	/**
	 * Rule for publish tweet
	 * 
	 * @var array
	 */
	private $tweetRules = array(
		'tweet' => 'required|min:1|max:140'
		);

	/**
	 * Get timeline + list of followed tweets
	 * 
	 * @return Response
	 */
	public function timeline()
	{
		$user_id = Auth::user()->id;
		$follows = Follower::where('id', $user_id)->select('followed_id')->get();
		$followIds = array();

		foreach($follows as $follow) {
			array_push($followIds, $follow->followed_id);
		}

		$tweets = DB::table('tweets')
							->join('users', 'users.id', '=','tweets.user_id')
							->whereIn('users.id', $followIds)
							->orderBy('tweets.created_at', 'desc')
							->take(30)
							->get();

		return View::make('timeline', array(
			'tweets' => $tweets
			));
	}

	/**
	 * View timeline in profile page
	 * 
	 * @return View
	 */
	public function profileTimeline($username)
	{
		$user = User::where('username', $username)->first();
		if($user) {
			$tweets = DB::table('tweets')
									->join('users', 'users.id', '=','tweets.user_id')
									->where('users.id', $user->id)
									->orderBy('tweets.created_at', 'desc')
									->take(30)
									->get();
		} else {
			App::abort(404);
		}

		return View::make('timeline', array(
			'tweets' 	=> $tweets,
			'profile'	=> $user
			));
	}

	/**
	 * Publish a tweet
	 * 
	 * @return Redirect
	 */
	public function tweet()
	{
		$validator = Validator::make(Input::all(), $this->tweetRules);

		if($validator->fails()) {
			return Redirect::back()->withErrors(array(
				'message'	=> 'There were some inputs that not valid',
				'status'	=> false
				));
		}

		$tweet = new Tweet;
		$tweet->user_id = Auth::user()->id;
		$tweet->tweet = Input::get('tweet');
		$tweet->save();

		return Redirect::back()->with(array(
			'message' => 'Your tweet has successfully been published',
			'status'	=> true
			));
	}

}
