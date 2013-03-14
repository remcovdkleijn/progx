<?php

class Create_Orders_Table {

	public function up()
	{
		Schema::create('orders', function($table) {
			$table->increments('idorder');
			$table->integer('iduser')->unsigned();
			//$table->timestamps();

			$table->foreign('iduser')->references('iduser')->on('users');
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}