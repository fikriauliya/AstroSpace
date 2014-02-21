<?php

class UsersController extends BaseController {
	public function __construct() {
    $this->beforeFilter('csrf', array('on'=>'post'));
    $this->beforeFilter('auth', array('only'=>array('getDashboard')));
	}

	public function getRegister() {
		return View::make('users.register');
	}

	public function postCreate() {
    $validator = Validator::make(Input::all(), User::$rules);
 
    if ($validator->passes()) {
	    $user = new User;
	    $user->username = Input::get('username');
	    $user->email = Input::get('email');
	    $user->aim = Input::get('aim');
	    $user->msn = Input::get('msn');
	    $user->irc = Input::get('irc');
	    $user->icq = Input::get('icq');
	    $user->password = Hash::make(Input::get('password'));
	    $user->save();

	    return Redirect::to('users/login')->with('message', 'Thanks for registering!');
    } else {
    	return Redirect::to('users/register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
    }
	}

	public function getLogin() {
    return View::make('users.login');
	}

	public function postSignin() {
		if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {
			return Redirect::to('users/dashboard')
				->with('message', 'You are now logged in!');
		} else {
	    return Redirect::to('users/login')
	      ->with('message', 'Your username/password combination was incorrect')
	      ->withInput();
		}
	}

	public function getDashboard() {
		//Get whether the user has login before or not
		$user = Auth::user();
		$hasLogin = $user->hasLogin;
		if ($hasLogin == 0) {
			$user->hasLogin = 1;
			$user->save();
			return View::make('users.dashboard')->with('hasLogin',$hasLogin);
		}
		else {
			return Redirect::to('spaces/'.$user->id)->with('user',$user);
		}
	}

	public function getLogout() {
		Auth::logout();
    return Redirect::to('users/login')->with('message', 'Your are now logged out!');
	}

	public function getIndex() {
		$users = User::all();
		return View::make('users.index')->with('users', $users);
	}
}
