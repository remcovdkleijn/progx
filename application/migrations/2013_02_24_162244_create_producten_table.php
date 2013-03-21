<?php

class Create_Producten_Table {

	public function up()
    {
		Schema::create('producten', function($table) {
			$table->increments('idproduct');
			$table->integer('idproduct_categorie')->unsigned();
			$table->integer('idbedrijf')->unsigned();
			$table->string('naam');
			$table->string('omschrijving');
			$table->string('hoeveelheid');
			$table->string('prijs');
			$table->timestamps();

			$table->foreign('idproduct_categorie')->references('idproduct_categorie')->on('product_categorieen')-> on_delete('cascade') -> on_update('cascade');
			$table->foreign('idbedrijf')->references('idbedrijf')->on('bedrijven')-> on_delete('cascade') -> on_update('cascade');
		});

    }

	public function down()
	{
		Schema::drop('producten');
	}

}