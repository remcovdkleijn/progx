<?php

class Create_Orders_Table {    

	public function up()
    {
		Schema::create('orders', function($table) {
			$table->increments('idorder');
			$table->integer('iduser');
			//$table->timestamps();
		});

    }    

	public function down()
    {
		Schema::drop('orders');

    }

}