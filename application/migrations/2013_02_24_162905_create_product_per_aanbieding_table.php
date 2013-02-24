<?php

class Create_Product_Per_Aanbieding_Table {    

	public function up()
    {
		Schema::create('product_per_aanbieding', function($table) {
			$table->integer('idproduct');
			$table->integer('idaanbieding');
			//$table->timestamps();
		});

    }    

	public function down()
    {
		Schema::drop('aanbieding');

    }

}