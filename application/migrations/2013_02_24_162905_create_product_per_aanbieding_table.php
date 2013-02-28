<?php

class Create_Product_Per_Aanbieding_Table {    

	public function up()
    {
		Schema::create('product_per_aanbieding', function($table) {
			$table->increments('id');
			$table->integer('product_id')->unsigned();
			$table->integer('aanbieding_id')->unsigned();
			//$table->timestamps();

			$table->foreign('product_id')->references('idproduct')->on('producten');
			$table->foreign('aanbieding_id')->references('idaanbieding')->on('aandiedingen');
		});

    }    

	public function down()
    {
		Schema::drop('aanbieding');

    }

}