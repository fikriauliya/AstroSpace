<?php

class ProfilesController extends BaseController {
	// Deprecated
	// public function show($id) {
	// 	$user = User::find($id);
	// 	return View::make('profiles.show')->with('user', $user);
	// }

	public function __construct() {
    $this->beforeFilter('csrf', array('on'=>'post'));
    $this->beforeFilter('auth', array('only'=>array('edit', 'update')));
	}

	public function edit($id) {
		$user = User::find($id);
		if (Auth::user()->id == $user->id) {
			return View::make('profiles.edit')->with('user', $user);
		} else {
			//warning, attacker!
 	    return Redirect::to('/');
 	  }
	}

	public function update($id) {
		// TODO: except password & email
		$user = User::find($id);
		if (Auth::user()->id == $user->id || Auth::user()->role == 'admin') {
			$user->username = Input::get('username');
			$user->aim = Input::get('aim');
	    $user->msn = Input::get('msn');
	    $user->irc = Input::get('irc');
	    $user->icq = Input::get('icq');

    	if (Input::hasFile('photo')) {
    		$file = Input::file('photo');
    		$destination_path = public_path().'/photos/';
    		$file_name = $user->id.'.'.$file->getClientOriginalExtension();
    		Input::file('photo')->move($destination_path, $file_name);
	    	$user->photo = $file_name;
    	}
	    $user->save();
		 if (Auth::user()->role == 'admin') {
			return Redirect::to('admin')->with('message','Succesfully update the profile of '.$user->username );
		 }

			return Redirect::to('spaces/'.$id)->with('message', 'Profile updated');
		} else {
			//warning, attacker!
  	  return Redirect::to('/');
		}
	}
}
