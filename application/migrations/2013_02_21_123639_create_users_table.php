<?php

class Create_Users_Table {

	public function up()
	{
		Schema::create('users', function($table) {
			$table->increments('iduser');
			$table->string('voornaam');
			$table->string('achternaam');
			$table->string('email')->unique();
			$table->string('password');
			$table->string('adres');
			$table->string('postcode');
			$table->string('city');
			$table->string('land');
			$table -> boolean('is_admin');
			// $table->timestamps();
		});

		DB::table('users') -> insert(array(
			'email' => 'admin@admin.nl',
			'password' => '$2a$08$WDBpcm5KanU0RjM5c2x3TeLDrOscHBYjycYfvIrBd0ZccycommyFe',
			'is_admin' => TRUE
		));
	}

	public function down()
	{
		Schema::drop('users');
	}
}