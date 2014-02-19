<?php

class CommentsController extends BaseController {
  public function __construct() {
    $this->beforeFilter('csrf', array('on'=>'post'));
    $this->beforeFilter('auth', array('only'=>array('create', 'store')));
  }

  public function store() {
    $user_id = Auth::user()->id;
    $comment = new Comment;
    $comment->content = Input::get('content');
    $comment->posted_by_id = $user_id;
    $comment->blog_post_id = Input::get('blog_post_id');
    $comment->save();

    return Redirect::to('blogposts/'.$comment->blog_post_id)->with('message', 'Your comment has been posted');
  }
}