<?php

class BlogpostTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('blogposts')->delete();
		
    $user0 = $this->getUser("user0")->id;
    $user1 = $this->getUser("user1")->id;
    $user2 = $this->getUser("user2")->id;
    $user4 = $this->getUser("user4")->id;
    $blog0 = $this->createBlogPost("Title 0 by user 0, visible to public", "Content", "Mood", $user0, false, '');
    $blog1 = $this->createBlogPost("Title 1 by user 0, visible to user 1 only", "Content", "Mood", $user0, true, $user1);
    $blog2 = $this->createBlogPost("Title 2 by user 0, visible to user 1 and 2 only", "Content", "Mood", $user0, true, $user1.",".$user2);
    $blog3 = $this->createBlogPost("Title 0 by user 1, visible to public", "Content", "Mood", $user1, false, '');
    $blog4 = $this->createBlogPost("Title 0 by user 2, visible to public", "Content", "Mood", $user2, false, '');
  
    $this->writeComment($blog0->id, 'Comment by user 0', $user0);
    $this->writeComment($blog0->id, 'Comment by user 1', $user1);
    $this->writeComment($blog1->id, 'Comment by user 1', $user1);
    $this->writeComment($blog2->id, 'Comment by user 1', $user1);
    $this->writeComment($blog2->id, 'Comment by user 2', $user2);
    $this->writeComment($blog3->id, 'Comment by user 4', $user4);
  }

  public function getUser($username) {
    return User::where('username', '=', $username)->get()[0];
  }

  public function createBlogPost($title, $content, $mood, $posted_by_id, $is_private, $visible_tos) {
    return BlogPost::create(array(
      'title' => $title,
      'content' => $content,
      'mood' => $mood,
      'posted_by_id' => $posted_by_id,
      'is_private' => $is_private,
      'visible_tos' => $visible_tos
    ));
  }

  public function writeComment($blog_post_id, $content, $posted_by_id) {
    return Comment::create(array(
      'blog_post_id' => $blog_post_id,
      'posted_by_id' => $posted_by_id,
      'content' => $content
    ));
  }
}
