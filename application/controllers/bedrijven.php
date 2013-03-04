<?php

class Bedrijven_Controller extends Base_Controller {

	public $restful = true;

	public $form_rules = array(
		'bedrijfsnaam' => 'required',
		'kvk' => 'required',
		'adres' => 'required',
		'postcode' => 'required',
		'city' => 'required',
		'land' => 'required'
	);


	public $form_messages = array(
		'required' => 'The :attribute field is required.',
		'unique' => 'The :attribute field already exists.'
	);

	public function get_index(){

		$user = Auth::user();
		$bedrijven = $user->bedrijven()->get();

		return View::make('bedrijf.index', array('bedrijven' => $bedrijven));
	}

	public function post_create(){

		$validation = Validator::make(Input::all(), $this->form_rules, $this->form_messages);

		$values = array(
			'bedrijfsnaam' => Input::get('bedrijfsnaam'),
			'kvk' => Input::get('kvk'),
    		'adres' => Input::get('adres'),
    		'postcode' => Input::get('postcode'),
    		'city' => Input::get('city'),
    		'land' => Input::get('land'),
    	);

		if ($validation->fails()) {
        	return Redirect::to_route('new_bedrijf')->with('form_values', $values)->with_errors($validation);
    	} else {
    		
    		$bedrijf = Bedrijf::create($values);
    		if($bedrijf){
    			return Redirect::to_route('index')->with('message', 'het bedrijf is aangemaakt');
    		} else {
    			return 'database error';
    		}
    	}

	}

	public function get_show($index){
		$user = Auth::user();
		$bedrijf = $user->bedrijven()->find($index);
		if(is_null($bedrijf)){
			return Redirect::to_route('index');
		}

		return View::make('bedrijf.show', array('bedrijf' => $bedrijf));
	}

	public function get_edit($index){
		$user = Auth::user();
		$bedrijf = $user->bedrijven()->find($index);
		if(is_null($bedrijf)){
			return Redirect::to_route('index');
		}

		return View::make('bedrijf.edit', array('bedrijf' => $bedrijf));
	}

	public function get_new(){
		return View::make('bedrijf.new');
	}

	public function put_update($index){

		$validation = Validator::make(Input::all(), $this->form_rules, $this->form_messages);

		$values = array(
			'bedrijfsnaam' => Input::get('bedrijfsnaam'),
			'kvk' => Input::get('kvk'),
    		'adres' => Input::get('adres'),
    		'postcode' => Input::get('postcode'),
    		'city' => Input::get('city'),
    		'land' => Input::get('land'),
    	);

		if ($validation->fails()) {
			return Redirect::to_route('edit_bedrijf', $index)->with('form_values', $values)->with_errors($validation);
    	} else {
    		$user = Auth::user();
			$bedrijf = $user->bedrijven()->find($index);
			$bedrijf->fill($values);
			$bedrijf->save();
			return Redirect::to_route('bedrijven', $index)->with('message', 'your account had been edited');
    	}

	}

	public function get_ontkoppel($index){
		$user = Auth::user();
		$bedrijf = $user->bedrijven()->detach($index);
		if($bedrijf == 0){
			return Redirect::to_route('index');
		} else {
			$temp = Session::get('businessids');
			unset($temp[array_search($index, $temp)]);
			
			if(count($temp) == 0){
				Session::forget('businessids');
				Session::put('logintype', 'user');
				return Redirect::to_route('index')->with('message', 'the business has been detach from your arrount');
			}
			Session::put('businessids', $temp);
			return Redirect::to_route('bedrijven')->with('message', 'the business has been detach from your arrount');
		}
	}

}