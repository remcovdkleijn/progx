<?php

class Users_Controller extends Base_Controller {

	public $restful = true;

	public function get_index() {

		$users = User::paginate(5);

		return View::make('user.index')
			-> with('users', $users);
	}

	public function get_login(){
		return View::make('user.login');
	}

	public function post_login() {
		$user = array(
			'username' => Input::get('email'),
			'password' => Input::get('password')
		);

		if(Auth::attempt($user)) {
			return Redirect::to_route('index')
				->with('message', 'Je bent nu ingelogd!');
		} else {
			return Redirect::to_route('login')
				-> with('message', 'Gebruikersnaam / wachtwoord komen niet overeen.')
				-> with_input();
		}
	}

	public function get_logout() {
		if(Auth::check()) {
			Auth::logout();
			return Redirect::to_route('login')
				->with('message', 'Je bent nu uitgelogd!');
		} else {
			return Redirect::to_route('index');
		}
	}

	public function get_new(){
		return View::make('user.new');
	}

	public function post_create(){

		$validation = User::validate(Input::all());

		if($validation->passes()) {
			User::create(array(
				'voornaam' => Input::get('voornaam'),
				'achternaam' => Input::get('achternaam'),
				'email' => Input::get('email'),
				'password' => Hash::make(Input::get('password')),
				'adres' => Input::get('adres'),
				'postcode' => Input::get('postcode'),
				'city' => Input::get('city'),
				'land' => Input::get('land')
			));

			$user = User::where_email(Input::get('email')) -> first();
			Auth::login($user);

			return Redirect::to_route('index')
				->with('message', 'Bedankt voor het registreren. Je bent nu ingelogd.');
		} else {
			return Redirect::to_route('register_user')
				-> with_errors($validation)
				-> with_input();
		}
	}

	public function get_show($user_id = NULL){
		$user = User::find($user_id);

		return View::make('user.show')
			-> with('user', $user);
	}

	public function get_edit($user_id = NULL){

		$user = User::find($user_id);

		return View::make('user.edit')
			-> with('user', $user);
	}

	public function put_update(){

		$id = Input::get('user_id');

		$profile_rules = array(
			'voornaam' => 'required',
			'achternaam' => 'required',
			'adres' => 'required',
			'postcode' => 'alpha_num',
			'city' => 'required',
			'land' => 'required'
		);

		$validation = Validator::make(Input::all(), $profile_rules);

		if($validation -> passes()) {
			User::update($id, array(
				'voornaam' => Input::get('voornaam'),
				'achternaam' => Input::get('achternaam'),
				'adres' => Input::get('adres'),
				'postcode' => Input::get('postcode'),
				'city' => Input::get('city'),
				'land' => Input::get('land')
			));

			return Redirect::to_route('edit_user', $id) -> with('message', 'Je profiel is geüpdated!');
		} else {
			return Redirect::to_route('edit_user')
				-> with_errors($validation)
				-> with('message', 'Er is iets mis gegaan. :(');
		}
	}
}