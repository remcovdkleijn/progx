<?php

class Create_Aanbiedingen_Table {

	public function up()
    {
		Schema::create('aanbiedingen', function($table) {
			$table->increments('idaanbieding');
			$table->integer('idbedrijf')->unsigned();
			$table->string('actienaam');
			$table->string('omschrijving');
			$table->integer('korting');
			$table->boolean('actief');
			//$table->timestamps();

			$table->foreign('idbedrijf')->references('idbedrijf')->on('bedrijven')-> on_delete('cascade') -> on_update('cascade');
		});
    }

	public function down()
    {
		Schema::drop('aanbiedingen');

    }

}