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
		return Userservice::login(Input::get('email'), Input::get('password'));
	}

	public function get_logout() {
		Auth::logout();
		return Redirect::to_route('login')
			->with('message', 'Je bent nu uitgelogd!');
	}

	public function get_new(){
		return View::make('user.new');
	}

	public function post_create(){
		return Usermodel::create(Input::all());
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

		return Userservice::edit(Input::get('user_id'), Input::all());
	}

}