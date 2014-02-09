<?php

class ProfilesController extends BaseController {
	public function __construct() {
    $this->beforeFilter('csrf', array('on'=>'post'));
    // $this->beforeFilter('auth', array('only'=>array('getDashboard')));
	}

	public function getShow() {
		$id = Input::get('id');
		$user = User::find($id);
		return View::make('profiles.show')->with('user', $user);
	}
}