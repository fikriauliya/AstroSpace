<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoleToUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		if (Schema::hasTable('users')){
			Schema::table('users', function($table){
				$table->string('role')->default('user');
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		if (Schema::hasTable('users') && Schema::hasColumn('users', 'role')){
			Schema::table('users', function($table){
				$table->dropColumn('role');
			});
		}

	}

}
