<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrivacyToBlogpost extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('blogposts', function($table)
		{
		    $table->boolean('is_private')->default(false);
		    $table->text('visible_tos');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('blogposts', function($table)
		{
		    $table->dropColumn('is_private');
		    $table->dropColumn('visible_tos');
		});
	}

}