<?php

class Create_Transactie_Types_Table {

	public function up()
    {
		Schema::create('transactie_types', function($table) {
			$table->increments('idtransactie_type');
			//$table->timestamps();
		});

    }

	public function down()
    {
		Schema::drop('transactie_types');

    }

}