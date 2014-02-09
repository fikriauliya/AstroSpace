<?php

class UserTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('users')->delete();
		User::create(array(
			'username' => 'pahlevi',
			'email'    => 'pahlevi.fikri.auliya@gmail.com',
			'password' => Hash::make('passw0rd'),
		));
	}
}