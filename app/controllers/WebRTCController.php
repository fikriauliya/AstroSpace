<?php

class WebRTCController extends BaseController {
	public function __construct(){

	}

	public function videoCall(){
		return View::make('webRTC.videoCall');
	}


}
