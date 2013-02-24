<?php

class Create_Aandiedingen_Table {    

	public function up()
    {
		Schema::create('aandiedingen', function($table) {
			$table->increments('idaanbieding');
			//$table->timestamps();
		});

    }    

	public function down()
    {
		Schema::drop('aandiedingen');

    }

}