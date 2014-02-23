<?php

class NotificationsController extends BaseController {
  public function __construct() {
    $this->beforeFilter('csrf', array('on'=>'post'));
    $this->beforeFilter('auth', array('only'=>array('index')));
  }

  public function index() {
    $user = Auth::user();

    $notifications = Notification::where('user_id', '=', $user->id)
      ->where('is_read', '=', false)
      ->orderBy('created_at', 'desc')
      ->get();
    DB::table('notifications')
      ->where('user_id', '=', $user->id)
      ->where('is_read', '=', false)
      ->update(array('is_read' => true));
    return View::make('notifications.index')->with('notifications', $notifications);
  }
}
