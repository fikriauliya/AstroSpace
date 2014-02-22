<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThemeDefaultValueToUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
		{
			if (Schema::hasColumn('users', 'theme')) {
		    $table->dropColumn('theme');
			}
		});
		Schema::table('users', function($table)
		{
   	    $table->string('theme')->default('default');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	}

}
