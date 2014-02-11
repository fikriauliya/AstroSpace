<?php

class SpacesController extends BaseController {
	public function show($id) {
		$auth_user = Auth::user();
		$user = User::find($id);
		$blog_posts = $user->blogPosts;

		$friends = $user->friends;
		$friend_requests = $user->friendRequests;
		
		if (Auth::check()) {
		$is_friend = $user->friends()->where('friend_id', '=', $auth_user->id)->count();
		$is_request_friend = $user->friendRequests()->where('request', '=', $auth_user->id)->count();
		$is_request_friend += $auth_user->friendRequests()->where('request','=',$user->id)->count();
		}
		$show_add_friend = 0;
		if (Auth::check() && $auth_user->id != $user->id && $is_friend==0 && $is_request_friend==0) {
			$show_add_friend = 1;
		}

		$view = View::make('spaces.show')
			->with('user', $user)
			->with('blog_posts', $blog_posts)
			->with('friends',$friends)
			->with('friend_requests', $friend_requests)
			->with('show_add_friend',$show_add_friend);
		//return View::make('spaces.show')->with('user', $user)->with('blog_posts', $blog_posts);
		return $view;
	}
}
