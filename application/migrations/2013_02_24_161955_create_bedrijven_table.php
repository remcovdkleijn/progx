<?php

class Create_Bedrijven_Table {    

	public function up()
    {
		Schema::create('bedrijven', function($table) {
			$table->increments('idbedrijf');
			//$table->timestamps();
		});

    }    

	public function down()
    {
		Schema::drop('bedrijven');

    }

}