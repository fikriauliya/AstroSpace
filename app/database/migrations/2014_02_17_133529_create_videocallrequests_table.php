<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideocallrequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('videocallrequests', function(Blueprint $table)
		{
			//
			$table->create();

			$table->increments('id');
			$table->string('room_id');
			$table->integer('owner_id');
			$table->integer('host_id');

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
		Schema::table('videocallrequests', function(Blueprint $table)
		{
			//
			Schema::dropIfExists('videocallrequests');
		});
	}

}
