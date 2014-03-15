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

    static::saved(function($blog_post){
      if ($blog_post->is_private) {
        $visible_tos = explode(',', $blog_post->visible_tos);
        foreach ($visible_tos as $visible_to) {
          DB::insert(DB::raw('insert into notifications (user_id, content, url, created_at, updated_at) values('.
            $visible_to.', "'.$blog_post->title.'", "'.url("/blogposts/".$blog_post->id).'")'));
        }
      }
    });
  }
}