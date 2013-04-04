<?php

class Userservice extends Service {

	public static $validation;

	public function __construct(){

	}

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

	public static function create($data){

		$validation = Usermodel::validate(Input::all());

		if($validation->passes()) {

			$userobj = Usermodel::create($data);
			Auth::login($userobj);

			return Redirect::to_route('index')
				->with('message', 'Bedankt voor het registreren. Je bent nu ingelogd.');
		} else {
			return Redirect::to_route('register_user')
				-> with_errors($validation)
				-> with_input();
		}

	}

	public static function edit($id, $data){

		$validation = Usermodel::validate_update($data);

		if($validation -> passes()) {

			Usermodel::edit($id, $data);

			return Redirect::to_route('edit_user', $id) -> with('message', 'Je profiel is geüpdated!');
		} else {
			return Redirect::to_route('edit_user', $id)
				-> with_errors($validation)
				-> with('message', 'Er is iets mis gegaan. :(');
		}
	}

}