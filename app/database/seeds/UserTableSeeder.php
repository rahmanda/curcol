<?php

class UserTableSeeder extends Seeder {

  public function run() {
    DB::table('users')->delete();

    User::create(array(
      'username' => 'rahmandawibowo',
      'fullname' => 'Rahmanda Wibowo',
      'email' => 'rahmandawibowo@gmail.com',
      'password' => Hash::make('rahmandawibowo'),
      ));

    User::create(array(
      'username' => 'triardini',
      'fullname' => 'Tri Ardini',
      'email' => 'triardini@gmail.com',
      'password' => Hash::make('triardini'),
      ));

    User::create(array(
      'username' => 'anasbladz',
      'fullname' => 'Muhammad Nasrurrohman',
      'email' => 'anasbladz@gmail.com',
      'password' => Hash::make('anasbladz')
      ));

    User::create(array(
      'username' => 'miftahfarid',
      'fullname' => 'Miftah Farid',
      'email' => 'miftahfarid@bing.com',
      'password' => Hash::make('miftahfarid')
      ));
  }

}