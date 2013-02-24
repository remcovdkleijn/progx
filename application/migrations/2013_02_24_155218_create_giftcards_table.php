<?php

class Create_Giftcards_Table {    

	public function up()
    {
		Schema::create('giftcards', function($table) {
			$table->increments('idgiftcard');
			$table->integer('iduser');
			//$table->timestamps();
		});

    }    

	public function down()
    {
		Schema::drop('kortingsbonnen');

    }

}