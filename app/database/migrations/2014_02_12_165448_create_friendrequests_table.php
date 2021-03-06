<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendrequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('friendrequests', function(Blueprint $table)
		{
			//
			$table->create();

			$table->increments('id');
			$table->integer('friend_id');
			$table->integer('owner_id');

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
		Schema::table('friendrequests', function(Blueprint $table)
		{
			//
			Schema::dropIfExists('friendrequests');
		});
	}

}
