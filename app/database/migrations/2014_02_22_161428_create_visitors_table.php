<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('visitors', function(Blueprint $table)
		{
			//
			$table->create();

			$table->increments('id');

			$table->string('ip');
			$table->string('location');
			$table->string('current_page');
			$table->integer('visits');
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
		Schema::table('visitors', function(Blueprint $table)
		{
			//
			Schema::dropifExists('visitors');
		});
	}

}
