<?php

class CommentsController extends BaseController {
  public function __construct() {
    $this->beforeFilter('csrf', array('on'=>'post'));
    $this->beforeFilter('auth', array('only'=>array('create', 'store')));
  }

  public function store() {
    $auth_user_id = Auth::user()->id;

    $blog_post = BlogPost::find(Input::get('blog_post_id'));
    if ($blog_post->posted_by_id != $auth_user_id && $blog_post->is_private) {
      $visible_tos = explode(',', $blog_post->visible_tos);

      if (!in_array($auth_user_id, $visible_tos)) {
        return Redirect::to('/')->with('message', 'This post is private');
      }
    }
    $comment = new Comment;
    $comment->content = Input::get('content');
    $comment->posted_by_id = $auth_user_id;
    $comment->blog_post_id = Input::get('blog_post_id');
    $comment->save();

    return Redirect::to('blogposts/'.$comment->blog_post_id)->with('message', 'Your comment has been posted');
  }
}