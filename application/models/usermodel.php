<?php

class Usermodel {

	public static function create($data){

		$validated = Userservice::validate_create($data);

		if($validated) {

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

			Auth::login($user);

			return Redirect::to_route('index')
				->with('message', 'Bedankt voor het registreren. Je bent nu ingelogd.');
		} else {
			return Redirect::to_route('register_user')
				-> with_errors($validation)
				-> with_input();
		}
	}

	public static function edit($id, $data){

		$validated = Userservice::validate_update($data);

		if($validated) {

			$user = User::find($id);

			$user->voornaam = $data['voornaam'];
			$user->achternaam = $data['achternaam'];
			$user->adres = $data['adres'];
			$user->postcode = $data['postcode'];
			$user->city = $data['city'];
			$user->land = $data['land'];

			$user->save();

			return Redirect::to_route('edit_user', $id) -> with('message', 'Je profiel is geüpdated!');
		} else {

			return Redirect::to_route('edit_user', $id)
				-> with_errors($validation)
				-> with_input()
				-> with('message', 'Er is iets mis gegaan. :(');
		}
	}

}