<?php

class UserTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('users')->delete();
		$this->createUser("user0");
    $this->createUser("user1");
    $this->createUser("user2");
    $this->createUser("user3");
    $this->createUser("user4");
    $this->createUser("user5");
    $this->createUser("user6");
    $this->createUser("user7");
    $this->createUser("user8");

    $this->makeFriend("user0", "user1");
    $this->makeFriend("user0", "user2");
    $this->makeFriend("user0", "user3");
    $this->makeFriend("user0", "user4");

    $this->makeFriend("user1", "user5");
	}

  public function createUser($id) {
    User::create(array(
      'username' => $id,
      'email'    => $id."@email.com",
      'password' => Hash::make('passw0rd'),
      'is_verified' => true
    ));
  }
  public function makeFriend($id1, $id2) {
    $friend = new Friend;
    $friend->friend_id = User::where('username', '=', $id1)->get()[0]->id;
    $friend->owner_id = User::where('username', '=', $id2)->get()[0]->id;
    $friend->save();

    $friend = new Friend;
    $friend->friend_id = User::where('username', '=', $id2)->get()[0]->id;
    $friend->owner_id = User::where('username', '=', $id1)->get()[0]->id;
    $friend->save();
  }
}