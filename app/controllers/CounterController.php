<?php

class CounterController extends BaseController {
	$ip = Request::getClientIp();
	
	#Check if visitor exists
	$visitor = Visitor::where('ip', '=', $ip)->orderBy('created_at')->first();

	if($visitor > '0'){
		#User exists, check for time difference from updated_at (last_active)
		$then = strtotime($visitor->updated_at);
		$now = strtotime(date("Y-m-d H:i:s"));

		$difference = ($now - $then);

		if($difference > '1200'){
			$xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=.$ip");
			$country = $xml->geoplugin_countryName;

			$visitor = new Visitor;
			$visitor->ip = $ip;
			$visitor->location = $country;
			$visitor->current_page = Request::path();

			$visitor->save();
		}else{
			#update the current visitor timing
			$visitor->current_page = Request::path();
			$visitor->save();
		}
	}else{
			#New visitor, create new instance

			$xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=.$ip");
			$country = $xml->geoplugin_countryName;

			$visitor = new Visitor;

			$visitor->ip = $ip;
			$visitor->location = $country;
			$visitor->current_page = Request::path();
			
			$visitor->visits=++$visitor->visits;
			$visitor ->save();
	}
}
