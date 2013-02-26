<?php

class Create_Bedrijven_Table {    

	public function up()
    {
		Schema::create('bedrijven', function($table) {
			$table->increments('idbedrijf');
			$table->string('bedrijfsnaam');
			$table->string('kvk');
			$table->string('adres');
			$table->string('postcode');
			$table->string('city');
			$table->string('land');
			//$table->timestamps();
		});

    }    

	public function down()
    {
		Schema::drop('bedrijven');

    }

}