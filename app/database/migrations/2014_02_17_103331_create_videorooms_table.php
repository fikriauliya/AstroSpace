<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoroomsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('videorooms', function(Blueprint $table)
		{
			//
			$table->create();

			$table->increments('id');
			$table->string('room_id');
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
		Schema::table('videorooms', function(Blueprint $table)
		{
			//
			Schema::dropIfExists('videorooms');
		});
	}

}
