<?php

class Bedrijven_Controller extends Base_Controller {

	public $restful = true;

	public function get_index(){

		$user = Auth::user();
		$bedrijven = $user->bedrijven()->get();

		return View::make('bedrijf.index', array('bedrijven' => $bedrijven));
	}

	public function post_create(){

		$rules = array(
			'bedrijfsnaam' => 'required',
			'kvk' => 'required',
			'email' => 'required|unique:users,email|email',
			'password' => 'required|min:6|confirmed',
			'password_confirmation' => 'required|required_with:first_name',
			'adres' => 'required',
			'postcode' => 'required',
			'city' => 'required',
			'land' => 'required'
		);

		$messages = array(
			'required' => 'The :attribute field is required.',
			'unique' => 'The :attribute field already exists.'
		);

		$validation = Validator::make(Input::all(), $rules, $messages);

		$values = array(
			'bedrijfsnaam' => Input::get('bedrijfsnaam'),
			'kvk' => Input::get('kvk'),
    		'email' => Input::get('email'),
    		'password' => Hash::make(Input::get('password')),
    		'adres' => Input::get('adres'),
    		'postcode' => Input::get('postcode'),
    		'city' => Input::get('city'),
    		'land' => Input::get('land'),
    	);

		if ($validation->fails()) {
			unset($values['password']);
        	return Redirect::to_route('new_bedrijf')->with('form_values', $values)->with_errors($validation);
    	} else {
    		
    		$bedrijf = Bedrijf::create($values);
    		if($bedrijf){
    			return Redirect::to_route('index')->with('message', 'your business account had been created');
    		} else {
    			return 'database error';
    		}
    	}

	}

	public function get_show($index){
		$user = Auth::user();
		$bedrijf = $user->bedrijven()->find($index);

		return View::make('bedrijf.show', array('bedrijf' => $bedrijf));
	}

	public function get_edit($index){
		$user = Auth::user();
		$bedrijf = $user->bedrijven()->find($index);

		return View::make('bedrijf.edit', array('bedrijf' => $bedrijf));
	}

	public function get_new(){
		return View::make('bedrijf.new');
	}

	public function put_update(){

		$idbedrijf = Input::get('idbedrijf');

		$rules = array(
			'bedrijfsnaam' => 'required',
			'kvk' => 'required',
			'adres' => 'required',
			'postcode' => 'required',
			'city' => 'required',
			'land' => 'required'	
		);

		$messages = array(
			'required' => 'The :attribute field is required.'
		);

		$validation = Validator::make(Input::all(), $rules, $messages);

		$values = array(
			'bedrijfsnaam' => Input::get('bedrijfsnaam'),
			'kvk' => Input::get('kvk'),
    		'adres' => Input::get('adres'),
    		'postcode' => Input::get('postcode'),
    		'city' => Input::get('city'),
    		'land' => Input::get('land'),
    	);

		if ($validation->fails()) {
			return Redirect::to_route('edit_bedrijf', $idbedrijf)->with('form_values', $values)->with_errors($validation);
    	} else {
    		$user = Auth::user();
			$bedrijf = $user->bedrijven()->find($idbedrijf);
			$bedrijf->fill($values);
			$bedrijf->save();
			return Redirect::to_route('edit_bedrijf', $idbedrijf)->with('message', 'your account had been edited');
    	}

	}

	public function get_ontkoppel($index){
		$user = Auth::user();
		$bedrijf = $user->bedrijven()->detach($index);
		return Redirect::to_route('bedrijven')->with('message', 'the business has been detach from your arrount');
	}

}