<?php

class BlogPost extends Eloquent {
	protected $table = 'blogposts';

	public static $rules = array(
    'title'=>'required|min:2',
    'content'=>'required',
    );

	public function postedBy() {
		return $this->belongsTo('User', 'posted_by_id', 'id');
	}

  public function comments() {
    return $this->hasMany('Comment', 'blog_post_id', 'id');
  }

  public function is_visible_to_user() {
  	$is_authorized = Auth::check();
  	$auth_user = Auth::user();
		
		if ((!$is_authorized || $this->posted_by_id != $auth_user->id) && $this->is_private) {
			$visible_tos = explode(',', $this->visible_tos);

			if (!$is_authorized || !in_array($auth_user->id, $visible_tos)) {
				return false;
			}
		}
		return true;
  }

  public static function boot()
  {
    parent::boot();

    static::created(function($blog_post){
      $visible_tos = explode(',', $blog_post->visible_tos);
      foreach ($visible_tos as $visible_to) {
        $notification = new Notification;
        $notification->user_id = $visible_to;
        $notification->content = "You are tagged in blog post: ".$blog_post->title;
        $notification->url = url("/blogposts/".$blog_post->id);
        $notification->save();
      }
    });
  }
}