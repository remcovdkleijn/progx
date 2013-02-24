<?php

class Create_Producten_Table {    

	public function up()
    {
		Schema::create('producten', function($table) {
			$table->increments('idproduct');
			$table->integer('idproduct_categorie');
			$table->integer('idbedrijf');
			//$table->timestamps();
		});

    }    

	public function down()
    {
		Schema::drop('producten');

    }

}