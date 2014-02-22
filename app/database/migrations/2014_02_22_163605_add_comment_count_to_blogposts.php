<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentCountToBlogposts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		if (Schema::hasTable('blogposts')){
			Schema::table('blogposts', function($table){
				$table->integer('comment_count')->default(0);
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
		if (Schema::hasTable('blogposts') && Schema::hasColumn('blogposts', 'comment_count')){
			Schema::table('blogposts', function($table){
				$table->dropColumn('comment_count');
			});
		}
	}

}
