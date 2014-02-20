<?php

class Comment extends Eloquent {
  protected $table = 'comments';

  public function postedBy() {
    return $this->belongsTo('User', 'posted_by_id', 'id');
  }

  public function blogPost() {
    return $this->belongsTo('BlogPost', 'id', 'blog_post_id');
  }
}