<?php

class Create_Orders_Table {

	public function up()
	{
		Schema::create('orders', function($table) {
			$table->increments('id');
			$table->integer('iduser')->unsigned();
			$table->timestamps();

			$table->foreign('iduser')->references('iduser')->on('users') -> on_delete('cascade') -> on_update('cascade');
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}