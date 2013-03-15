<?php

class User extends Basemodel {

	public static $timestamps = false;

	public static $key = 'iduser';

	public static $rules = array(
		'voornaam' => 'required',
		'achternaam' => 'required',
		'email' => 'required|unique:users|email',
		'password' => 'required|alpha_num|min:6|confirmed',
		'password_confirmation' => 'required|alpha_num|min:6',
		'adres' => 'required',
		'postcode' => 'required|alpha_num',
		'city' => 'required',
		'land' => 'required'
	);

	public function bedrijven(){
		return $this->has_many_and_belongs_to('Bedrijf', 'users_per_bedrijf');
	}
}