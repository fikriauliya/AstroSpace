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
	    $validator = Validator::make(Input::all(), User::$profile_rules);
 
  	  if ($validator->passes()) {
				$user->username = Input::get('username');
				$user->aim = Input::get('aim');
		    $user->msn = Input::get('msn');
		    $user->irc = Input::get('irc');
		    $user->icq = Input::get('icq');

	    	if (Input::hasFile('photo')) {
	    		$file = Input::file('photo');
	    		$destination_path = public_path().'/photos/';
	    		$file_name = $user->id.'.'.$file->getClientOriginalExtension();

	    		$allowed_mimes = array('image/png', 'image/gif', 'image/jpeg', 'image/pjpeg', 'image/svg+xml');
	    		if ($file->getSize() < 1000000 && in_array($file->getMimeType(), $allowed_mimes)) {
	    			Input::file('photo')->move($destination_path, $file_name);
		    		$user->photo = $file_name;
		    	} else {
		    		return Redirect::to('profiles/'.$id.'/edit')->with('warning', "The uploaded image doesn't match the requirement");
		    	}	
	    	}
		    $user->save();
				if (Auth::user()->role == 'admin') {
					return Redirect::to('admin')->with('message','Succesfully update the profile of '.$user->username );
				}

				return Redirect::to('spaces/'.$id)->with('message', 'Profile updated');
			} else {
    		return Redirect::to('profiles/'.$id.'/edit')->with('warning', 'The following errors occurred')->withErrors($validator)->withInput();
    	}
		} else {
			//warning, attacker!
  	  return Redirect::to('/');
		}
	}
}
