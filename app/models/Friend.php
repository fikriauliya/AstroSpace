<?php

class Friend extends Eloquent {
	protected $table = 'friends';

	public function friendOf() {
		return $this->belongsTo('User',  'id', 'owner');
	}
}
