<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('flags', function(Blueprint $table)
		{
			$table->integer('id')->unsigned();
			$table->integer('type')->unsigned();
			$table->integer('created_by')->unsigned();
			$table->timestamps();

			$table->engine = 'InnoDB';
			$table->primary(array('id','type','created_by'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('flags');
	}

}