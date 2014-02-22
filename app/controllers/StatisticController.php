<?php

class StatisticController extends BaseController {
 	public function __construct() {
    	$this->beforeFilter('csrf', array('on'=>'post'));
    	$this->beforeFilter('auth', array('only'=>array('getShow')));
   }



	public function getShow(){
		$user = Auth::user();
		$username = $user->username;
		return View::make('statistics.show')->with('user',$user);
	}
}
