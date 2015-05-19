<?php

class FollowersTableSeeder extends Seeder {

  public function run() {
    DB::table('followers')->delete();

    for($i = 1; $i <= 5; $i++) {
      $follower = new Follower(array(
        'id' => $i,
        'followed_id' => $i
        ));

      $follower->timestamps = false;
      $follower->save();
    }
  }

}