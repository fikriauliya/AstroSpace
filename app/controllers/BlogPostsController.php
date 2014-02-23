<?php

class BlogPostsController extends BaseController {
	public function __construct() {
    $this->beforeFilter('csrf', array('on'=>'post'));
    $this->beforeFilter('auth', array('only'=>array('create', 'store')));
	}

	public function show($id) {
		$blog_post = BlogPost::find($id);

		if (!$blog_post->is_visible_to_user()) {
			return Redirect::to('/')->with('warning', 'This post is private');
		}

		$comments = $blog_post->comments->sortBy('created_at')->reverse();
		return View::make('blogposts.show')->with('blogpost', $blog_post)->with('comments', $comments);
	}

	public function edit($id) {
		$blog_post = BlogPost::find($id);
    $user_id = Auth::user()->id;
		$friends = Auth::user()->friends2;
		$visible_tos = explode(',', $blog_post->visible_tos);

		$friend_infos = array();
		foreach ($friends as $friend) {
			$friend_info = array(
				'id' => $friend->id,
				'username' => $friend->username,
				'is_checked' => ''
			);
			if (in_array($friend->id, $visible_tos)) {
				$friend_info['is_checked'] = 'checked';
			}
			array_push($friend_infos, $friend_info);
		}
		$privacy = 'public';
		
		if ($blog_post->is_private) {
			$privacy = 'private';
		}
		
		if ($user_id == $blog_post->posted_by_id) {
			return View::make('blogposts.edit')
				->with('blogpost', $blog_post)
				->with('friends', $friend_infos)
				->with('privacy', $privacy)
				->with('visible_tos', $visible_tos);
		} else {
			//warning, attacker!
 	    return Redirect::to('/');
 	  }
	}

	public function update($id) {
		$blog_post = BlogPost::find($id);
    $validator = Validator::make(Input::all(), BlogPost::$rules);
		$user_id = Auth::user()->id;

    if ($validator->passes()) {
  		if ($user_id != $blog_post->posted_by_id) {
  			return Redirect::to('/')->with('warning', 'You are not authorized to edit this blogpost');
  		} 
			$blog_post->title = Input::get('title');
			$blog_post->content = Input::get('content');
			$blog_post->mood = Input::get('mood');
			if (Input::get('privacy') == 'private') {
				$blog_post->is_private = true;
			} else {
				$blog_post->is_private = false;
			}

			$blog_post->visible_tos = '';
			//TODO: check whether they are really friend
			if (Input::get('visible_tos') != NULL) {
				$blog_post->visible_tos = join(',', Input::get('visible_tos'));
			}
			$blog_post->save();
			return Redirect::to('blogposts/'.$id)->with('message', 'Post updated'); 
    } else {
    	return Redirect::to('blogposts/'.$id.'/edit')->with('warning', 'The following errors occurred')->withErrors($validator)->withInput();
    }
	}

	public function create() {
		$friends = Auth::user()->friends2;
		return View::make('blogposts.create')->with('friends', $friends);
	}

	public function store() {
		$user_id = Auth::user()->id;

    $validator = Validator::make(Input::all(), BlogPost::$rules);

    if ($validator->passes()) {
			$blog_post = new BlogPost;
			$blog_post->title = Input::get('title');
			$blog_post->content = Input::get('content');
			$blog_post->mood = Input::get('mood');
			$blog_post->posted_by_id = $user_id;
			if (Input::get('privacy') == 'private') {
				$blog_post->is_private = true;
			} else {
				$blog_post->is_private = false;
			}

			//TODO: check whether they are really friend
			if (Input::get('visible_tos') != NULL) {
				$blog_post->visible_tos = join(',', Input::get('visible_tos'));
			}
			$blog_post->save();

			return Redirect::to('spaces/'.$user_id)->with('message', 'New post created');
		} else {
    	return Redirect::to('blogposts/create')->with('warning', 'The following errors occurred')->withErrors($validator)->withInput();
		}
	}
}
