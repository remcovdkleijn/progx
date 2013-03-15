<?php

class User extends Basemodel {

	public static $timestamps = false;

	public static $key = 'iduser';

	public static $rules = array(
		'email' => 'required|unique:users|email',
		'password' => 'required|alpha_num|min:6|confirmed',
		'password_confirmation' => 'required|alpha_num|min:6',
		'voornaam' => 'required',
		'achternaam' => 'required',
		'adres' => '',
		'postcode' => 'alpha_num',
		'city' => '',
		'land' => ''
	);

	public function bedrijven(){
		return $this->has_many_and_belongs_to('Bedrijf', 'users_per_bedrijf');
	}
}