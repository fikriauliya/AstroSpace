<?php

class WebRTCController extends BaseController {
	public function __construct(){
		$this->beforeFilter('auth',array('only'=>array('goToRoom', 'createRoom', 'inviteToRoom', 'approveRoom', 'exitRoom') ));
		$this->beforeFilter('csrf',array('on'=>'post'));
	}

	public function goToRoom(){
		//get user
		$user = Auth::user();
		//get the room id
		$room_id = Input::get('r');
		//make sure the room_id is only alpha numeric
		$room_id = preg_replace("/[^A-Za-z0-9_]/","",$room_id);
		//Check whether the user is authorized to go to the room
		if (!($user->videoRoom()->exists()) ||  !($user->videoRoom->room_id == $room_id)){
			//redirect
			Session::flash('message', 'You are not authorized to the video room');
			return Redirect::to('spaces/'.$user->id);
		}

		return View::make('webRTC.videoCall')
			->with('user',$user);
	}

	public function createRoom(){
		//get user
		$user = Auth::user();
		
		//check whether the user already have active room
		if ($user->videoRoom()->exists()) {
			Session::flash('message', 'You already have an active video call room!');
			return Redirect::to('spaces/'.$user->id);
		}

		//generate a unique id
		$room_id = uniqid('astrospace_');
		while (VideoRoom::where('room_id','=',$room_id)->exists()) {
			$room_id = uniqid();
		}
		
		$video_room = new VideoRoom;
		$video_room->room_id = $room_id;
		$video_room->owner_id = $user->id;
		$video_room->save();

		Session::flash('message', 'Successfully create a video chat room');
		return Redirect::to('webrtc/?r='.$room_id);
	}

	public function inviteToRoom(){
		//get user
		$user = Auth::user();

		//check whether the user have active room
		if (!($user->videoRoom()->exists()) ) {
			Session::flash('message', 'You do not have any active room!');
			return Redirect::to('spaces/'.$user->id);
		}

		//get input
		$friend_id = Input::get('friend_id');
		$room_id = $user->videoRoom->room_id;
		$friend = User::find($friend_id);

		if ($friend->videoCallRequests()->where('room_id','=',$room_id)->exists() || ($friend->videoRoom()->exists() && $friend->videoRoom->room_id == $room_id) ){
			Session::flash('message', 'The user is already invited!');
			return "User already invited!";
		}	

		//add to table
		$video_call_request = new VideoCallRequest;
		$video_call_request->room_id = $room_id;
		$video_call_request->owner_id = $friend_id;
		$video_call_request->host_id = $user->id;
		$video_call_request->save();

		return "SUCCESS";
	}


	public function approveRoom(){
		//get user
		$user = Auth::user();

		//Get input
		$room_id = Input::get('room_id');

		//check if the user already have an active room
		if ($user->videoRoom()->exists()){
			Session::flash('message', 'You already have an active room!');
			return Redirect::back();
		}

		//check if the room exist
		if (!VideoRoom::where('room_id','=',$room_id)->exists()){
			Session::flash('message', 'The room is not exist anymore');
			return Redirect::back();
		}

		//check if the user really have an invitation
		if (!$user->videoCallRequests()->where('room_id','=',$room_id)->exists()){
			Session::flash('message', 'You do not have the invitation to the room!');
			return Redirect::back();
		}
		
		//Get and delete the videoCallRequest
		$video_call_request = $user->videoCallRequests()->where('room_id', '=', $room_id);
		$video_call_request->delete();

		//Add the room to the active room of the user
		$video_room = new VideoRoom;
		$video_room->room_id = $room_id;
		$video_room->owner_id = $user->id;
		$video_room->save();

		//refresh browser and give message
		Session::flash('message', 'Successfully approve room');
		return Redirect::to('webrtc/?r='.$room_id);
	}

	public function exitRoom(){
		//get user
		$user = Auth::user();

		//check whether the user have active room
		if (!$user->videoRoom()->exists()) {
			Session::flash('message', 'You do not have any active room to exit!');
			return Redirect::to('spaces/'.$user->id);
		}

		//delete the video room entry
		$room_id = $user->videoRoom->room_id;
		$user->videoRoom()->delete();

		//Check whether the video room is empty
		//if yes, delete all request to the room
		if (!VideoRoom::where('room_id', '=', $room_id)->exists()){
			VideoCallRequest::where('room_id', '=', $room_id)->delete();
		}

		//redirect
		Session::flash('message', 'Successfully exit from room');
		return Redirect::to('spaces/'.$user->id);
	}

}
