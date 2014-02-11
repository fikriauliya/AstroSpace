<?php

class FriendRequest extends Eloquent {
	protected $table = 'friendrequests';

	public function user() {
		return $this->belongTo('User', 'id', 'owner');
	}
}
