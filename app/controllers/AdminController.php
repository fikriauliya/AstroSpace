<?php

class AdminController extends BaseController{
	public function __construct(){
		$this->beforeFilter('csrf',array('on'=>'post'));
	}
	
	public function getIndex(){
		return View::make('admin.index')->with('user',Auth::user());
	}

	public function getEditInfo(){
		$user = User::find( Input::get('user_id') );
		if (count($user) > 0) {
			return View::make('profiles.edit')->with('user',	$user);	
		}
		else {
			$user_id = Input::get('user_id');
			$user_id = $this->htmlentity($user_id);
			$warning = "User id: ".$user_id."\tnonexistent. <!--NoUser:".$user_id."-->";
			Session::flash('warning', $warning);
			return View::make('admin.error');
		}
	}

	public function getEditSpace(){
		$user = User::find( Input::get('user_id') );
		if (count($user) > 0) {
			return View::make('spaces.edit')->with('user', $user);
		}
		else {
			$user_id = Input::get('user_id');
			$warning = "User id: ".$user_id." nonexistent";
			return View::make('admin.error')->with('warning', $warning);
		}
	}

	public function getDeleteComment(){
		$user = User::find( Input::get('user_id') );
		if (count($user) > 0) {
			return View::make('admin.deleteComment')->with('user', $user);
		}
		else {
			$user_id = Input::get('user_id');
			$warning = "User id ".$user_id." nonexistent!";
			return View::make('admin.error')->with('warning', $warning);
		}
	}


	public function postDeleteComment(){
		//Get input
		$comment_id = Input::get('comment_id');
		$comment = Comment::find( $comment_id );

		if (count($comment) && Auth::user()->role == 'admin'){
			$comment->delete();
		}
		return Redirect::to('admin')->with('message', 'Comment deleted');
	}

	public function postDeleteUser(){
		//Get current url
		$current_url = Session::get('current_url');
		Session::forget('current_url');
		//Get the user that want to be deleted
		$user_id = Input::get('user_id');
		$user = User::find( $user_id );
		$username = $user->username;
		if (count($user) > 0) {
			//Delete cleanly
			$user->delete();

		}
		return Redirect::to($current_url)
			->with('message','Successfully delete user: '.$username);
	}

	private function htmlentity($input){
		$temp = strtolower($input);
		$result = str_replace("<script>", "",$temp);
		$result = strip_tags($result, "<script>");
		return $result;
	}
	
}
