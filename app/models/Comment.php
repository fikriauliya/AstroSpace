<?php

class Comment extends Eloquent {
  protected $table = 'comments';
	public static $rules = array(
    'content'=>'required'
   );

  public function postedBy() {
    return $this->belongsTo('User', 'posted_by_id', 'id');
  }

  public function blogPost() {
    return $this->belongsTo('BlogPost', 'blog_post_id', 'id');
  }

   public static function boot(){
      parent::boot();

      static::creating(function($comment){
			$blogpost = BlogPost::find($comment->blog_post_id);
			$blogpost->comment_count = $blogpost->comment_count+1;
			$blogpost->save();
		});

		static::deleting(function($comment){
			$blogpost = BlogPost::find($comment->blog_post_id);
			$blogpost->comment_count = $blogpost->comment_count-1;
			$blogpost->save();
		});

   }   



}
