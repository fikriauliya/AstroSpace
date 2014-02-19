<?php

class BlogPost extends Eloquent {
	protected $table = 'blogposts';

	public function postedBy() {
		return $this->belongsTo('User', 'posted_by_id', 'id');
	}

  public function comments() {
    return $this->hasMany('Comment', 'blog_post_id', 'id');
  }
}