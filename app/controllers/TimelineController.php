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
		$tweets = DB::table('followers')
								->join('tweets', 'followers.followed_id', '=', 'tweets.user_id')
								->join('users', 'followers.followed_id', '=', 'users.id')
								->select('users.id', 'users.username', 'users.fullname', 'tweets.tweet', 'tweets.user_id', 'tweets.created_at')
								->where('followers.followed_id', $user_id)
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
			$tweets = User::find($user->id)
										->tweets()
										->orderBy('created_at', 'desc')
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
