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
		return View::make('profiles.edit')->with('user',	$user);	
	}

	public function getEditSpace(){
		$user = User::find( Input::get('user_id') );
		return View::make('spaces.edit')->with('user', $user);

	}

	public function getDeleteComment(){
		$user = User::find( Input::get('user_id') );
		return View::make('admin.deleteComment')->with('user', $user);
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
			$user->ads()->delete();
			$user->comments()->delete();
			$others_comment = $user->comments2()->get();
			foreach($others_comment as $key => $value) $key->delete();

			$user->blogPosts()->delete();
			Friend::where('friend_id','=',$user_id)->delete();
			$user->friends()->delete();
			$user->friendRequests()->delete();
			FriendRequest::where('host_id','=',$user_id)->delete();
			$user->videoCallRequests()->delete();
			$user->videoRoom()->delete();
			$user->delete();

		}
		return Redirect::to($current_url)
			->with('message','Successfully delete user: '.$username);
	}


}
