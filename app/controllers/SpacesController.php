<?php

class SpacesController extends BaseController {
	public function show($id) {
		$auth_user = Auth::user();
		$user = User::find($id);
		$blog_posts = $user->blogPosts;
		$visible_blog_posts = array();

		foreach ($blog_posts as $blog_post) {
			if ($blog_post->posted_by_id != $auth_user->id && $blog_post->is_private) {
				$visible_tos = explode(',', $blog_post->visible_tos);

				if (in_array($auth_user->id, $visible_tos)) {
					array_push($visible_blog_posts, $blog_post);
				}
			} else {
				array_push($visible_blog_posts, $blog_post);
			}
		}
		
		if (Auth::check()) {
			$is_friend = $user->friends()->where('friend_id', '=', $auth_user->id)->count();
			$is_request_friend = $user->friendRequests()->where('friend_id', '=', $auth_user->id)->count();
			$is_request_friend += $auth_user->friendRequests()->where('friend_id','=',$user->id)->count();
		}
		$show_add_friend = 0;
		if (Auth::check() && $auth_user->id != $user->id && $is_friend==0 && $is_request_friend==0) {
			$show_add_friend = 1;
		}

		$view = View::make('spaces.show')
			->with('user', $user)
			->with('blog_posts', $visible_blog_posts)
			->with('show_add_friend',$show_add_friend)
			->nest('showFriend', 'friends.showFriend', array('user'=>$user))
			->nest('showVideoCallInfo', 'webRTC.showVideoCallInfo', array('user'=>$user));
		//return View::make('spaces.show')->with('user', $user)->with('blog_posts', $visible_blog_posts);
		return $view;
	}
}
