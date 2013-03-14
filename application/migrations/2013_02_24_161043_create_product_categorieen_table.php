<?php

class Create_Product_Categorieen_Table {

	public function up()
    {
		Schema::create('product_categorieen', function($table) {
			$table->increments('idproduct_categorie');
			$table->string('categorie');
			//$table->timestamps();
		});

    }

	public function down()
    {
		Schema::drop('product_categorieen');

    }

}