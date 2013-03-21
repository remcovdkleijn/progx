<?php

class Create_Users_Per_Bedrijf_Table {

	public function up()
    {
		Schema::create('users_per_bedrijf', function($table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('bedrijf_id')->unsigned();
			//$table->timestamps();

			$table->foreign('user_id')->references('iduser')->on('users')-> on_delete('cascade') -> on_update('cascade');
			$table->foreign('bedrijf_id')->references('idbedrijf')->on('bedrijven')-> on_delete('cascade') -> on_update('cascade');
		});

    }

	public function down()
	{
		Schema::drop('users_per_bedrijf');
	}

}