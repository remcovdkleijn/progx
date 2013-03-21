<?php

class Create_Transacties_Table {

	public function up()
    {
		Schema::create('transacties', function($table) {
			$table->increments('idtransactie');
			$table->integer('iduser')->unsigned();
			$table->integer('idtransactie_type')->unsigned();
			//$table->timestamps();

			$table->foreign('idtransactie_type')->references('idtransactie_type')->on('transactie_types') -> on_delete('cascade') -> on_update('cascade');
			$table->foreign('iduser')->references('iduser')->on('users') -> on_delete('cascade') -> on_update('cascade');
		});

    }

	public function down()
    {
		Schema::drop('transacties');

    }

}