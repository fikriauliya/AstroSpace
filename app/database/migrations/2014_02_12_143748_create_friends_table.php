<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('friends', function(Blueprint $table)
		{
			//Create friends table containing the friend_id, friend_of_id
			$table->create();
			$table->increments('id');
			$table->integer('friend_id');
			$table->integer('friend_of_id');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('friends', function(Blueprint $table)
		{
			//Drop the table friends if exist
			Schema::dropIfExists('friends');
		});
	}

}
