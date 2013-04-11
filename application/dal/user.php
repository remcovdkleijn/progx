<?php

class User extends Eloquent {

	public static $timestamps = false;

	public static $key = 'iduser';

	public function bedrijven(){
		return $this->has_many_and_belongs_to('Bedrijf', 'users_per_bedrijf');
	}

}