<?php

class UsersController extends BaseController {
	public function getRegister() {
		return View::make('users.register');
	}

	public function postLogin() {

	}
}