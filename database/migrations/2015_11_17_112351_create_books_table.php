<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('books', function(Blueprint $table)
		{
			$table->increments('book_id');
			$table->string('book_name');		//书名
			$table->string('book_auther');	//作者
			$table->string('book_press');		//出版社
			$table->integer('book_num');		//图书总数
			$table->integer('book_res');		//图书剩余数
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('books');
	}

}
