<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCorpusTable extends Migration {

	public function up()
	{
		Schema::create('corpus', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 50)->unique();
		});
	}

	public function down()
	{
		Schema::drop('corpus');
	}
}