<?php

class Create_Users_Per_Bedrijf_Table {    

	public function up()
    {
		Schema::create('users_per_bedrijf', function($table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('bedrijf_id');
			//$table->timestamps();
		});

    }    

	public function down()
    {
		Schema::drop('bedrijf');

    }

}