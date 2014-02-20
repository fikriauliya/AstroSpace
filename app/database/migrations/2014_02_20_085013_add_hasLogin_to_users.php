<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHasLoginToUsers extends Migration {

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
				$table->integer('hasLogin')->default(0);
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
		if (Schema::hasTable('users') && Schema::hasColumn('users', 'hasLogin') ){
			Schema::table('users',function($table){
				$table->dropColumn('hasLogin');
			});
		}
	}

}
