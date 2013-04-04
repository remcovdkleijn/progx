<?php

class Usermodel {

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

	public static function validate($data) {
		return Validator::make($data, static::$rules);
	}

	public static function validate_update($data) {
		return Validator::make($data, static::$update_rules);
	}

	public static function create($data){
		$user = IoC::resolve('user');

		$user->voornaam = $data['voornaam'];
		$user->achternaam = $data['achternaam'];
		$user->email = $data['email'];
		$user->password = Hash::make($data['password']);
		$user->adres = $data['adres'];
		$user->postcode = $data['postcode'];
		$user->city = $data['city'];
		$user->land = $data['land'];

		$user->save();

		return $user;
	}

	public static function edit($id, $data){
		$user = User::find($id);

		$user->voornaam = $data['voornaam'];
		$user->achternaam = $data['achternaam'];
		$user->adres = $data['adres'];
		$user->postcode = $data['postcode'];
		$user->city = $data['city'];
		$user->land = $data['land'];

		$user->save();

		return $user;
	}

}