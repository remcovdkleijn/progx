<?php

class Create_Giftcards_Table {

	public function up()
    {
		Schema::create('giftcards', function($table) {
			$table->increments('idgiftcard');
			$table->integer('iduser')->nullable()->unsigned();
			//$table->timestamps();

			$table->foreign('iduser')->references('iduser')->on('users')-> on_delete('cascade') -> on_update('cascade');
		});

    }

	public function down()
    {
		Schema::drop('giftcards');

    }

}