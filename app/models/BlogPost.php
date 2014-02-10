<?php

class BlogPost extends Eloquent {
	protected $table = 'blogposts';

	public function postedBy() {
		return $this->belongsTo('User', 'id', 'posted_by_id');
	}
}