<?php

class SpacesController extends BaseController {
	public function show($id) {
		$user = User::find($id);
		return View::make('spaces.show')->with('user', $user);
	}
}