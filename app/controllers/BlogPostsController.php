<?php

class BlogPostsController extends BaseController {
	public function __construct() {
    $this->beforeFilter('csrf', array('on'=>'post'));
    $this->beforeFilter('auth', array('only'=>array('create', 'store')));
	}

	public function show($id) {
		$auth_user = Auth::user();
		$blog_post = BlogPost::find($id);
		if ($blog_post->posted_by_id != $auth_user->id && $blog_post->is_private) {
			$visible_tos = explode(',', $blog_post->visible_tos);

			if (!in_array($auth_user->id, $visible_tos)) {
				return Redirect::to('/')->with('message', 'This post is private');
			}
		}

		$comments = $blog_post->comments;
		return View::make('blogposts.show')->with('blogpost', $blog_post)->with('comments', $comments);
	}

	public function create() {
		$friends = Auth::user()->friends2;
		return View::make('blogposts.create')->with('friends', $friends);
	}

	public function store() {
		$user_id = Auth::user()->id;
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
		if (Input::get('visible_tos') != NULL) {
			$blog_post->visible_tos = join(',', Input::get('visible_tos'));
		}
		$blog_post->save();

		return Redirect::to('spaces/'.$user_id)->with('message', 'New post created');
	}
}
