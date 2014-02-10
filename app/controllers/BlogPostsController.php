<?php

class BlogPostsController extends BaseController {
	// Deprecated
	public function __construct() {
    $this->beforeFilter('csrf', array('on'=>'post'));
    $this->beforeFilter('auth', array('only'=>array('create', 'store')));
	}

	public function create() {
		return View::make('blogposts.create');
	}

	public function store() {
		$user_id = Auth::user()->id;
		$blog_post = new BlogPost;
		$blog_post->title = Input::get('title');
		$blog_post->content = Input::get('content');
		$blog_post->mood = Input::get('mood');
		$blog_post->posted_by_id = $user_id;
		$blog_post->save();

		return Redirect::to('spaces/'.$user_id)->with('message', 'New post created');
	}
}