<?php

class UsersController extends BaseController {
	public function __construct() {
    $this->beforeFilter('csrf', array('on'=>'post'));
    $this->beforeFilter('auth', array('only'=>array('getDashboard', 'getChangePassword')));
	}

	public function getSearch() {
		$userinput = Input::get('search');
		$searchresult = User::where('username', '=', $userinput)->get();
		if (count($searchresult)>0) {
			return View::make('users.search')
				->with('user_result',$searchresult)
				->with('error', 0);
		}
		else if ($userinput != "") {
			return View::make('users.search')->with('error', 1);
		}
		else {
			return View::make('users.search')->with('error', 0);
		}
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
			$verification_code = str_random(100);
	    $user->verification_code = $verification_code;
	    $user->save();

	    $verification_url = url('/users/verify/?user_id='.$user->id.'&verification_code='.$verification_code);
	   	Mail::send('users.mails.welcome', 
	   		array('username'=>Input::get('username'), 
	   			'verification_code'=>$verification_code,
	   			'verification_url'=>$verification_url),
	   		function($message){
	    		$message->to(Input::get('email'), Input::get('username'))->subject('Verification code for AstroSpace');
	    	}
	    );

	    return Redirect::to('users/login')->with('message', 'Thanks for registering! Please activate your account by clicking the verification code sent to your email');
    } else {
    	return Redirect::to('users/register')->with('warning', 'The following errors occurred')->withErrors($validator)->withInput();
    }
	}

	public function getLogin() {
    return View::make('users.login');
	}

	public function postSignin() {
		if (Auth::attempt(
			array('email'=>Input::get('email'), 
					'password'=>Input::get('password'),
					'is_verified'=>true))) {
				setcookie('Cookie',str_random(60),time()+100000,'/','',1,0);
			return Redirect::to('users/dashboard')
				->with('message', 'You are now logged in!');
		} else {
	    return Redirect::to('users/login')
	      ->with('warning', 'Your username/password combination was incorrect. Or your account hasn not been activated, please check your email')
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

	public function getVerify() {
		$verification_code = Input::get('verification_code');
		$user_id = Input::get('user_id');
		$user = User::find($user_id);
		if ($user->verification_code == $verification_code) {
			$user->is_verified = true;
			$user->save();
	    return Redirect::to('users/login')->with('message', 'Your account has been activated. Please log in below');
		}			
		else {
		  return Redirect::to('users/login')->with('warning', 'Your verification code is invalid');
		}
	}

	public function getChangepassword() {
		return View::make('users.changepassword');
	}

	public function postChangepassword() {
    $validator = Validator::make(Input::all(), User::$change_password_rules);
 
    if ($validator->passes()) {
			$user = Auth::user();
			$current_password = Input::get('current_password');
			if (Hash::check($current_password, $user->password)) {
				$user->password = Hash::make(Input::get('password'));
				$user->save();

				Mail::send('users.mails.password_changed', 
		   		array('username'=>$user->username),
		   		function($message) use ($user){
		    		$message->to($user->email, $user->username)->subject('Password change notification');
		    	}
	    	);

				return Redirect::to('/')->with('message', 'Your password has been updated');		
			} else {
	    	return Redirect::to('users/changepassword')->with('warning', "The existing password doesn't match");
			}
		} else {
    	return Redirect::to('users/changepassword')->with('warning', 'The following errors occurred')->withErrors($validator)->withInput();
		}
	}
}
