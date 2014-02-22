<?php

class Message extends Eloquent {
	protected $table = 'messages';

	public function sender() {
		return $this->belongsTo('User', 'sender_id', 'id');
	}

  public function recipient() {
    return $this->belongsTo('User', 'recipient_id', 'id');
  }
}