<?php

class ProfilesController extends BaseController {
	public function show($id) {
		$user = User::find($id);
		return View::make('profiles.show')->with('user', $user);
	}

	public function edit($id) {
		$user = User::find($id);
		return View::make('profiles.edit')->with('user', $user);
	}

	public function update($id) {
		// TODO: except password & email
		$user = User::find($id);
		$user->username = Input::get('username');
		$user->aim = Input::get('aim');
    $user->msn = Input::get('msn');
    $user->irc = Input::get('irc');
    $user->icq = Input::get('icq');
    $user->save();

		return Redirect::to('profiles/'.$id)->with('message', 'Profile updated');
	}
}