<?php

class SpacesController extends BaseController {
	public function __construct() {
    $this->beforeFilter('csrf', array('on'=> array('put', 'post')));
    $this->beforeFilter('auth', array('only'=>array('edit', 'update')));
	}

	public function show($id) {
		$auth_user = Auth::user();
		$user = User::find($id);
		$blog_posts = $user->blogPosts->sortBy('updated_at')->reverse();
		$visible_blog_posts = array();
		$is_authorized = Auth::check();
  	
		if ($user->photo != NULL) {
			$photo_path = '/photos/'.$user->photo;
		} else {
			$photo_path = '';
		}
		foreach ($blog_posts as $blog_post) {
			if ($blog_post->is_visible_to_user()) {
				array_push($visible_blog_posts, $blog_post);
			}
		}
		
		if ($is_authorized) {
			$is_friend = $user->friends()->where('friend_id', '=', $auth_user->id)->count();
			$is_request_friend = $user->friendRequests()->where('friend_id', '=', $auth_user->id)->count();
			$is_request_friend += $auth_user->friendRequests()->where('friend_id','=',$user->id)->count();
		}
		$show_add_friend = 0;
		if ($is_authorized && $auth_user->id != $user->id && $is_friend==0 && $is_request_friend==0) {
			$show_add_friend = 1;
		}

		$view = View::make('spaces.show')
			->with('user', $user)
			->with('blog_posts', $visible_blog_posts)
			->with('show_add_friend',$show_add_friend)
			->with('photo_path', eval('return "'.$photo_path.'";'))
			->nest('showFriend', 'friends.showFriend', array('user'=>$user))
			->nest('showVideoCallInfo', 'webRTC.showVideoCallInfo', array('user'=>$user))
			->nest('manageAds','ads.manage',array('user'=>$user));
		//return View::make('spaces.show')->with('user', $user)->with('blog_posts', $visible_blog_posts);
		return $view;
	}

	public function edit($id) {
		$user = User::find($id);
		if (Auth::user()->id == $user->id) {
			return View::make('spaces.edit')->with('user', $user);
		} else {
			//warning, attacker!
 	    return Redirect::to('/');
 	  }
	}

	public function update($id) {
		// TODO: except password & email
		$user = User::find($id);
		if (Auth::user()->id == $user->id || Auth::user()->role == 'admin') {
			$user->header = Input::get('header');
			$user->right_content = Input::get('right_content');
	    $user->save();

		 	if (Auth::user()->role == 'admin') {
				return Redirect::to('admin')->with('message', 'Successfully update spaces of '.$user->username);
			}

			return Redirect::to('spaces/'.$id)->with('message', 'Space updated');
		} else {
			//warning, attacker!
  	  return Redirect::to('/');
		}
	}
}
