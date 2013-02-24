<?php

class Create_Product_Per_Order_Table {    

	public function up()
    {
		Schema::create('product_perorder', function($table) {
			$table->integer('idorder');
			$table->integer('idproduct');
			//$table->timestamps();
		});

    }    

	public function down()
    {
		Schema::drop('order');

    }

}