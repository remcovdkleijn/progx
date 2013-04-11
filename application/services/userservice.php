<?php

class Userservice extends Service {

	public static $rules = array(
		'email' => 'required|unique:users|email',
		'password' => 'required|alpha_num|min:4|confirmed',
		'password_confirmation' => 'required|alpha_num|min:4',
		'voornaam' => 'required',
		'achternaam' => 'required',
		'adres' => 'required',
		'postcode' => 'required|alpha_num',
		'city' => 'required',
		'land' => 'required'
	);

	public static $update_rules = array(
		'voornaam' => 'required',
		'achternaam' => 'required',
		'adres' => 'required',
		'postcode' => 'alpha_num',
		'city' => 'required',
		'land' => 'required'
	);

	public static function login($username, $password){
		$credentials = array(
			'username' => $username,
			'password' => $password
		);

		if(Auth::attempt($credentials)) {
			return Redirect::to_route('index')
				->with('message', 'Je bent nu ingelogd!');
		} else {
			return Redirect::to_route('login')
			-> with('message', 'Gebruikersnaam / wachtwoord komen niet overeen.')
			-> with_input();
		}
	}

	public static function validate_create() {
		return Validator::make($data, static::$rules);
	}

	public static function validate_update($data) {
		return Validator::make($data, static::$update_rules);
	}
}