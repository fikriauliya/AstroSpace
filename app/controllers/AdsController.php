<?php
class AdsController extends BaseController {
	public function __construct(){
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('getReview', 'postPublish', 'getCreate')));

	}

	public function getBottom(){
		//Get random ads
		$ad = Ad::orderBy(DB::raw('RAND()'))->first();
		if (count($ad)==0){
			return "No ads";
		}


		//get Ad information
		$url = $ad->url;
		$price = 1;
		$budget = $ad->budget;
		if ($budget < $price) {
			$ad->delete();
		}
		else {
			$ad->budget = $budget - $price;
			$ad->save();
		}
		return View::make('ads.show')
			->with('url',$url);
	}

	public function postPublish(){
		//Get current url
		$current_url = Session::get('current_url');
		Session::forget('current_url');
		//Get user
		$user = Auth::user();

		//Check budget
		$budget = Input::get('budget');
		$num_budget = 0;
		if (!is_numeric($budget) || (int)$budget <= 0) {
			return Redirect::to($current_url)->with('message','Budget is not a positive number!"');
		}
		else {
			$num_budget = (int)$budget; 
		}

		//Create new ad row
		$ad = new Ad;
		$ad->owner_id = $user->id;
		$ad->budget = $num_budget;
		$ad->title = Input::get('title');
		$ad->description = Input::get('description');
		//sanitize url
		$url = Input::get('url');
		$pattern = '/[^-A-Za-z0-9+&@#\/%?=~_|!:,.;\(\)]/';
		$safe_url = preg_replace($pattern, '', $url);
		if ( ( strpos($safe_url, "http://") != 0 && strpos($safe_url, "https://") != 0) || ($url == "" || $url != $safe_url)){
			return Redirect::to($current_url)->with('message', 'The url is either not full url path or it contain dangerous character');
		}
		$ad->url = $safe_url;
		$ad->save();

		return Redirect::to('spaces/'.$user->id)->with('message','Successfully publish app!');

	}

	public function getReview(){
		$url = Input::get('url');
     	$pattern = '/[^-A-Za-z0-9+&@#\/%?=~_|!:,.;\(\)]/';
	   $safe_url = preg_replace($pattern, '', $url);
		if ($url == '') {
			return "The ads review will be shown here";
		}
		return View::make('ads.show')
			->with('url',$url);
	}

	public function getCreate(){
		$user = Auth::user();
		return View::make('ads.create')
			->with('user',$user);
	}

}

	 
