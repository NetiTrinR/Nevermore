<?php

use Illuminate\Database\Migrations\Migration;

class InstallAdditionalColumnsUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table){
			$table->string('username');
			$table->string('mcname');
			$table->date('dob');
			$table->boolean('show_dob')->default(0);
			$table->boolean('show_email')->default(0);
			$table->string('location')->nullable();
			$table->boolean('show_loc')->default(0);
			//Is micro enabled? Can people post on it?
			$table->boolean('show_micro')->default(1);
			$table->boolean('show_post')->default(1);
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table)
		{
		    $table->dropColumn('username', 'mcname', 'dob', 'deleted_at');
		});
	}

}