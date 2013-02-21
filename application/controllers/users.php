<?php

class Users_Controller extends Base_Controller {

	public $restful = true;

	public function get_index(){
		return View::make('user.index');
	}

	public function post_create(){

		$rules = array(
			'email' => 'required|unique:users,email|email',
			'name' => 'required',
			'password' => 'required|min:6|confirmed',
			'password_confirmation' => 'required|required_with:first_name'
		);

		$messages = array(
			'required' => 'The :attribute field is required.',
			'unique' => 'The :attribute field already exists.'
		);

		$validation = Validator::make(Input::all(), $rules, $messages);

		if ($validation->fails()) {
        	return Redirect::to_route('new_user')->with('form_values', array('email' => Input::get('email'), 'name' => Input::get('name')))->with_errors($validation);
    	} else {
    		$values = array(
    			'email' => Input::get('email'),
    			'name' => Input::get('name'),
    			'password' => Hash::make(Input::get('password'))
    		);
    		$user = User::create($values);
    		if($user){
    			return Redirect::to_route('index')->with('message', 'your account had been created');
    		} else {
    			return 'database error';
    		}
    	}

	}

	public function get_show(){
		
	}

	public function get_edit(){
		
	}

	public function get_new(){
		return View::make('user.new');
	}

	public function put_update(){

	}

	public function detele_destroy(){
	
	}

	public function post_login(){

		$rules = array(
			'email' => 'required|email',
			'password' => 'required|min:6',
		);

		$messages = array(
			'required' => 'The :attribute field is required.',
			'unique' => 'The :attribute field already exists.'
		);

		$validation = Validator::make(Input::all(), $rules, $messages);

		if ($validation->fails()) {
        	return Redirect::to_route('login')->with('form_values', array('email' => Input::get('email')))->with_errors($validation);
    	} else {

			$credentials = array(
				'username' => Input::get('email'),
				'password' => Input::get('password')
			);

			if(Auth::attempt($credentials)){
				return Redirect::to_route('admin');
			}
			return Redirect::to_route('login')->with('loginfail', 'true');
    	}
	}

	public function get_logout(){
		Auth::logout();
		// unset any session variables
		return Redirect::to_route('index');
	}
}