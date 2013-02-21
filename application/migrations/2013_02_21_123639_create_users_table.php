<?php

class Create_Users_Table {    

	public function up()
    {
		Schema::create('users', function($table) {
			$table->increments('iduser');
			$table->string('name');
			$table->string('email');
			$table->string('password');
		});

    }    

	public function down()
    {
		Schema::drop('users');

    }

}