<?php

class Ad extends Eloquent {
	protected $table = 'ads';

	public function user(){
		return $this->belongsTo('User', 'id', 'owner_id');
	}
}
			
