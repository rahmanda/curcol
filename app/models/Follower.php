<?php

class Follower extends Eloquent {

  /**
   * The database table used by model
   * 
   * @var string
   */
  protected $table = 'followers';

  protected $fillable = array('id', 'followed_id');

}