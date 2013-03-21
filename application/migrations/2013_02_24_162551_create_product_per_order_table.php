<?php

class Create_Product_Per_Order_Table {

	public function up()
    {
		Schema::create('product_per_order', function($table) {
			$table->increments('id');
			$table->integer('order_id')->unsigned();
			$table->integer('product_id')->unsigned();
			//$table->timestamps();

			$table->foreign('order_id')->references('id')->on('orders')-> on_delete('cascade') -> on_update('cascade');
			$table->foreign('product_id')->references('idproduct')->on('producten')-> on_delete('cascade') -> on_update('cascade');
		});

    }

	public function down()
	{
		Schema::drop('product_per_order');
	}
}