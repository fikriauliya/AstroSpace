<?php

class Notification extends Eloquent {
	protected $table = 'notifications';

	public static $rules = array(
    'title'=>'required|min:2',
    'content'=>'required'
    );
}