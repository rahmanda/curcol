<?php

class AuthController extends BaseController {

  /**
   * Rules for validating login
   * 
   * @var array
   */
  private $loginRules = array(
    'username' => 'required|alphaNum',
    'password' => 'required|alphaNum'
    );

  /**
   * Login user
   *
   * @return Redirect
   */ 
  public function login() 
  {

    $validator = Validator::make(Input::all(), $this->loginRules);

    if ($validator->fails()) {
      $error = $validator;

      return Redirect::back()->withErrors(array(
        'message' => 'There were some inputs that not valid',
        'status' => false
        ));
    } else {
      $credentials = array(
        'username'     => Input::get('username'),
        'password'  => Input::get('password')
        );

      if (Auth::attempt($credentials)) {
        Session::put(User::$sessionField['username'], Auth::user()->username);
        Session::put(User::$sessionField['fullname'], Auth::user()->fullname);
        Session::put(User::$sessionField['id'], Auth::user()->id);
        return Redirect::route('timeline');
      } else {        

        return Redirect::back()->withErrors(array(
          'message' => 'Your request couldn\'t be performed due to server error, please try again later',
          'status' => false
          ));

      }
    }
  }

  /**
   * Logout user
   *
   * @return Redirect
   */  
  public function logout() 
  {
    Auth::logout();
    Session::flush();
    return Redirect::route('home');
  }

}
