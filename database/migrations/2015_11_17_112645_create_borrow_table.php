<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('borrow', function(Blueprint $table)
		{
			$table->increments('borrow_id');
			$table->integer('book_id');
			$table->string('username');	//借书人姓名
			$table->string('userno');		//借书人工号
			$table->string('phone');		//借书人联系方式
			$table->timestamp('return_at');			//预计归还日期
			$table->tinyInteger('status');				//归还状态
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
		Schema::drop('borrow');
	}

}
