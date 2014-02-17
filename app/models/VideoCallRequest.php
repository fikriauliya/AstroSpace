<?php

class VideoCallRequest extends Eloquent {
	protected $table = 'videocallrequests';

	public function users(){
		return $this->belongsTo('User','id', 'owner_id');
	}
}
