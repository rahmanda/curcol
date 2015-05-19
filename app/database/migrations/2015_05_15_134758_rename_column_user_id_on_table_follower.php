<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnUserIdOnTableFollower extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('followers', function($table) {
			$table->renameColumn('user_id', 'id');
			$table->renameColumn('follower_id', 'followed_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('followers', function($table) {
			$table->renameColumn('id', 'user_id');
			$table->renameColumn('followed_id', 'follower_id');
		});
	}

}
