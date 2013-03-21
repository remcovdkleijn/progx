<?php

class Create_Orders_Regels_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_regels', function($table) {
			$table -> increments('id');
			$table -> integer('idproduct') -> unsigned();
			$table -> integer('order_id') -> unsigned();
			$table -> decimal('price', 7, 2);
			$table -> integer('qty') -> unsigned();

			$table -> foreign('idproduct') -> references('idproduct') -> on('producten') -> on_delete('cascade') -> on_update('cascade');
			$table -> foreign('order_id') -> references('id') -> on('orders') -> on_delete('cascade') -> on_update('cascade');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('order_regels');
	}

}