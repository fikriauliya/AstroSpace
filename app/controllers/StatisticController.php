<?php

class StatisticController extends BaseController {
 	public function __construct() {
    	$this->beforeFilter('csrf', array('on'=>'post'));
    	$this->beforeFilter('auth', array('only'=>array('getShow')));
   }



	public function getShow(){
		return View::make('statistics.show');
	}
}
