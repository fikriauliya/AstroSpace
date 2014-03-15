<?php

class MessagesController extends BaseController {
	public function __construct() {
    $this->beforeFilter('csrf', array('on'=>'post'));
    $this->beforeFilter('auth', array('only'=>array('create', 'store', 'index')));
	}

	public function create() {
		$friends = Auth::user()->friends2;
		$friends_arr = array();
		foreach ($friends as $friend) {
			$friends_arr[$friend->id] = $friend->username;
		}
		return View::make('messages.create')->with('friends', $friends_arr);
	}

	public function store() {
		$user = Auth::user();
		
		$new_message = new Message;
		$new_message->sender_id = $user->id;
		$new_message->recipient_id = Input::get('recipient');
		$new_message->content = Input::get('content');
		$new_message->save();

		return Redirect::to('/')->with('message', 'Message sent');
	}

	public function index() {
		$user = Auth::user();

		$received_messages = Message::where('recipient_id', '=', $user->id)->get();
		$sent_messages = Message::where('sender_id', '=', $user->id)->get();
		return View::make('messages.index')->with('sent_messages', $sent_messages)->with('received_messages', $received_messages);
	}
}
