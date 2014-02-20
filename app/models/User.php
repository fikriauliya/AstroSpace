<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
	public static $rules = array(
    'username'=>'required|alpha|min:2',
    'email'=>'required|email|unique:users',
    'password'=>'required|alpha_num|between:6,12|confirmed',
    'password_confirmation'=>'required|alpha_num|between:6,12'
    );
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	public function videoRoom() {
		return $this->hasOne('VideoRoom', 'owner_id', 'id');
	}

	public function videoCallRequests() {
		return $this->hasMany('VideoCallRequest', 'owner_id', 'id');
	}

	public function blogPosts() {
		return $this->hasMany('BlogPost', 'posted_by_id', 'id');
	}

	public function friends() {
		return $this->hasMany('Friend', 'owner_id', 'id');
	}

	public function friends2() {
		return $this->belongsToMany('User', 'friends', 'owner_id', 'friend_id');
	}

	public function friendRequests() {
		return $this->hasMany('FriendRequest', 'owner_id', 'id');
	}

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
}
