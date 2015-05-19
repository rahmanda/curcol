<?php

class FollowersTableSeeder extends Seeder {

  public function run() {
    DB::table('followers')->delete();

    // for($i = 1; $i <= 5; $i++) {
      $follower = new Follower(array(
        'id' => 1,
        'followed_id' => 1
        ));

      $follower->timestamps = false;
      $follower->save();

      $follower = new Follower(array(
        'id' => 4,
        'followed_id' => 4
        ));

      $follower->timestamps = false;
      $follower->save();
    // }
  }

}