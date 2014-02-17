<?php 

class VideoRoom extends Eloquent {
	protected $table = 'videorooms';

	public function users() {
		return $this->belongsTo('User', 'id', 'owner_id');
	}
}
