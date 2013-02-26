<?php

class Create_Product_Per_Aanbieding_Table {    

	public function up()
    {
		Schema::create('product_per_aanbieding', function($table) {
			$table->increments('id');
			$table->integer('product_id');
			$table->integer('aanbieding_id');
			//$table->timestamps();
		});

    }    

	public function down()
    {
		Schema::drop('aanbieding');

    }

}