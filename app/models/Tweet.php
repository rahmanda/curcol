<?php

class Tweet extends Eloquent {

  /**
   * The database table used by model
   * 
   * @var string
   */
  protected $table = 'tweets';

  /**
   * List of table fields that are available to be mass assigned
   * 
   * @var array
   */
  protected $fillable = array('user_id', 'tweet');

  /**
   * List of rules that use for self-validation
   * 
   * @var array
   */
  private $maxTweet = 140;
  
  public static $rules = array(
    'tweet' => 'required|min:1|max:140'
    );

  /**
   * Each tweet belongs to one User
   * 
   * @var array
   */
  public function user() {
    return $this->belongsTo('User');
  }

}