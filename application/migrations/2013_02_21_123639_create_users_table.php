<?php

class Create_Users_Table {    

	public function up()
    {
		Schema::create('users', function($table) {
			$table->increments('iduser');
			$table->string('voornaam');
			$table->string('achternaam');
			$table->string('email');
			$table->string('password');
			$table->string('adres');
			$table->string('postcode');
			$table->string('city');
			$table->string('land');
			//$table->timestamps();
		});

    }    

	public function down()
    {
		Schema::drop('users');

    }

}