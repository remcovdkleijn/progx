<?php

class Create_Orders_Regels_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders_regels', function($table) {
			$table -> increments('orders_regels_id');
			$table -> integer('product_id') -> unsigned();
			$table -> integer('order_id') -> unsigned();
			$table -> decimal('price', 7, 2);
			$table -> integer('qty') -> unsigned();

			$table -> foreign('product_id') -> references('idproduct') -> on('producten') -> on_delete('cascade') -> on_update('cascade');
			$table -> foreign('order_id') -> references('idorder') -> on('orders') -> on_delete('cascade') -> on_update('cascade');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders_regels');
	}

}