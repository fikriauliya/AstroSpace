<?php

class SpacesController extends BaseController {
	public function show($id) {
		$user = User::find($id);
		$blog_posts = $user->blogPosts;
		return View::make('spaces.show')->with('user', $user)->with('blog_posts', $blog_posts);
	}
}