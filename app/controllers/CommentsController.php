<?php

class CommentsController extends BaseController {
  public function __construct() {
    $this->beforeFilter('csrf', array('on'=>'post'));
    $this->beforeFilter('auth', array('only'=>array('store')));
  }

  public function store() {
    $auth_user_id = Auth::user()->id;

    $blog_post = BlogPost::find(Input::get('blog_post_id'));
    if (!$blog_post->is_visible_to_user()) {
      return Redirect::to('/')->with('message', 'This post is private');
    }

    $validator = Validator::make(Input::all(), Comment::$rules);

    if ($validator->passes()) {
      $comment = new Comment;
      $comment->content = Input::get('content');
      $comment->posted_by_id = $auth_user_id;
      $comment->blog_post_id = Input::get('blog_post_id');
      $comment->save();

      return Redirect::to('blogposts/'.$blog_post->id)->with('message', 'Your comment has been posted');
    } else {
      return Redirect::to('blogposts/'.$blog_post->id)->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
    }
  }
}