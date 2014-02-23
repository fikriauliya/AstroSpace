<?php

class Visitor extends Eloquent {
	protected $table = 'visitors';

	public function user(){
		return $this->belongsTo('User', 'owner_id', 'id');
	}

}
