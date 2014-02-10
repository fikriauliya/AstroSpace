<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
		{
			$table->create();
			$table->increments('id');
		  $table->string('username');
			$table->string('password', 64);
			$table->string('email')->unique();
			$table->string('aim')->nullable();
			$table->string('msn')->nullable();
			$table->string('irc')->nullable();
			$table->string('icq')->nullable();
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
		Schema::dropIfExists('users');
	}

}
