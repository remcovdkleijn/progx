<?php

class Bedrijven_Controller extends Base_Controller {

	public $restful = true;

	public function get_index(){

		$user = Auth::user();
		$bedrijven = $user->bedrijven()->get();

		return View::make('bedrijf.index', array('bedrijven' => $bedrijven));
		
	}

	public function get_show($bedrijf_id){

		$bedrijf = Bedrijf::find($bedrijf_id);

		return View::make('bedrijf.show')
			-> with('bedrijf', $bedrijf);

	}

	public function get_new(){
		return View::make('bedrijf.new');
	}

	public function get_edit($bedrijf_id){

		$bedrijf = Bedrijf::find($bedrijf_id);

		// if( ! in_array($bedrijf, Auth::user() -> bedrijven)) {
		// 	return Redirect::to_route('index');
		// }

		return View::make('bedrijf.edit')
			-> with('bedrijf', $bedrijf);

	}

	public function post_create(){

		$validation = Bedrijf::validate(Input::all());

		if ($validation -> passes()) {

			Bedrijf::create(array(
				'bedrijfsnaam' => Input::get('bedrijfsnaam'),
				'kvk' => Input::get('kvk'),
				'adres' => Input::get('adres'),
				'postcode' => Input::get('postcode'),
				'city' => Input::get('city'),
				'land' => Input::get('land')
			));

			return Redirect::to_route('index')
				-> with('message', 'Het bedrijf "' . Input::get('bedrijfsnaam') . '" is succesvol aangemaakt!');

		} else {

			return Redirect::to_route('new_bedrijf')
				-> with_input()
				-> with_errors($validation);

		}
	}

	public function put_update(){

		$id = Input::get('bedrijf_id');

		$validation = Bedrijf::validate(Input::all());

		if ($validation->passes()) {

			Bedrijf::update( $id, array(
				'bedrijfsnaam' => Input::get('bedrijfsnaam'),
				'kvk' => Input::get('kvk'),
				'adres' => Input::get('adres'),
				'postcode' => Input::get('postcode'),
				'city' => Input::get('city'),
				'land' => Input::get('land')
			));

			return Redirect::to_route('bedrijf', $id)
				-> with('message', 'Bedrijfsinformatie geüpdate!');

		} else {

			return Redirect::to_route('edit_bedrijf', $id)
				-> with_input()
				-> with_errors($validation);

		}
	}

	public function get_ontkoppel($index)
	{
		$user = Auth::user();
		$bedrijf = $user->bedrijven()->detach($index);
		if($bedrijf == 0){
			return Redirect::to_route('index');
		}

		$temp = Session::get('businessids');
		unset($temp[array_search($index, $temp)]);

		if( count($temp ) == 0 ) {
			Session::forget('businessids');
			Session::put('logintype', 'user');
			return Redirect::to_route('index')->with('message', 'Het bedrijf is opnieuw gekoppeld aan jouw account.');
		}

		Session::put('businessids', $temp);
		return Redirect::to_route('bedrijven')->with('message', 'Het bedrijf is opnieuw gekoppeld aan jouw account.');
	}
}