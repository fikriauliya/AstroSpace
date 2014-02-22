<?php

class MessagesController extends BaseController {
	public function __construct() {
    $this->beforeFilter('csrf', array('on'=>'post'));
    $this->beforeFilter('auth', array('only'=>array('create', 'store', 'show')));
	}

	// public function show($id) {
	// 	$auth_user = Auth::user();
	// 	$blog_post = BlogPost::find($id);
	// 	if ($blog_post->posted_by_id != $auth_user->id && $blog_post->is_private) {
	// 		$visible_tos = explode(',', $blog_post->visible_tos);

	// 		if (!in_array($auth_user->id, $visible_tos)) {
	// 			return Redirect::to('/')->with('message', 'This post is private');
	// 		}
	// 	}

	// 	$comments = $blog_post->comments;
	// 	return View::make('blogposts.show')->with('blogpost', $blog_post)->with('comments', $comments);
	// }

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
		
		// TODO: check whether they are really friend
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
