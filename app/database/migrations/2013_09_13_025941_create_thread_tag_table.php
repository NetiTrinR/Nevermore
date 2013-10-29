<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadTagTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tag_thread', function(Blueprint $table)
		{
			$table->integer('tag_id')->unsigned();
			$table->integer('thread_id')->unsigned();

			$table->engine = 'InnoDB';
			$table->primary(array('tag_id','thread_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tag_thread');
	}

}