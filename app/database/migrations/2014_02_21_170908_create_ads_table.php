<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ads', function(Blueprint $table)
		{
			//
			$table->create();

			$table->increments('id');

			$table->string('title');
			$table->string('description');
			$table->string('url');
			$table->integer('budget');
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
		Schema::dropIfExists('ads');
		Schema::table('ads', function(Blueprint $table)
		{
			//
		});
	}

}
