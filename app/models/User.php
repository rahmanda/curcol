<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $fillable = array('username', 'fullname', 'email', 'password');

	protected $hidden = array('remember_token');

	public static $sessionField = array(
		'username'	=> 'sru',
		'fullname'	=> 'srf',
		'email'			=> 'sre',
		'id'				=> 'sri'
		);

	/**
	 * Each user has many tweets
	 * 
	 * @var array
	 */
	public function tweets() {
		return $this->hasMany('Tweet');
	}
	/**
	 * Each user has many followers
	 * 
	 * @var Array
	 */
	public function follow() {
		return $this->belongsToMany('User', 'followers', 'id', 'followed_id');
	}

	public function followers() {
		return $this->belongsToMany('User', 'followers', 'followed_id', 'id');
	}

}
