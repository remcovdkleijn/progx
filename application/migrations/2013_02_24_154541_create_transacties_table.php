36<?php

class Create_Transacties_Table {    

	public function up()
    {
		Schema::create('transacties', function($table) {
			$table->increments('idtransactie');
			$table->integer('iduser');
			$table->integer('idtransactie_type');
			//$table->timestamps();
		});

    }    

	public function down()
    {
		Schema::drop('transactions');

    }

}