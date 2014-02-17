<?php

class FriendRequest extends Eloquent {
	protected $table = 'friendrequests';

	public function user() {
		return $this->belongsTo('User', 'id', 'owner_id');
	}
}
