<?php

class Aanbiedingen_Controller extends Base_Controller {

	public $restful = true;

	public function get_index(){

		$aanbiedingen = Aanbieding::get_all_active();

		return View::make('aanbieding.all')
		-> with('aanbiedingen', $aanbiedingen);
	}

	public function get_show($product_id){

		$aanbieding = Aanbieding::find($product_id);

		if(is_null($aanbieding)){
			return Redirect::to_route('index')
			-> with('message', 'Aanbieding is niet gevonden.');
		}

		return View::make('aanbieding.show')
		-> with('aanbieding', $aanbieding);
	}

	public function get_edit($aanbieding_id){

		$aanbieding = Aanbieding::find($aanbieding_id);

		if(is_null($aanbieding)){
			return Redirect::to_route('index');
		}

		if( ! $this->check_business_auth($aanbieding->bedrijf->idbedrijf)) {
			return Redirect::to_route('index');
		}

		return View::make('aanbieding.edit')
		-> with('aanbieding', $aanbieding);
	}

	public function get_new($idbedrijf){

		if(!$this->check_business_auth($idbedrijf)){ return Redirect::to_route('index'); }

		$bedrijf = Bedrijf::find($idbedrijf)->first();
		$producten = Product::where('idbedrijf', '=', $bedrijf->idbedrijf)->get();

		return View::make('aanbieding.new', array('bedrijf' => $bedrijf, 'producten' => $producten));
	}

	public function get_aanbiedingen_van_bedrijf($idbedrijf) {

		$bedrijf = Bedrijf::find($idbedrijf);

		$aanbiedingen = Aanbieding::get_all_belonging_to_bedrijf($idbedrijf);

		return View::make('aanbieding.index')
		-> with('aanbiedingen', $aanbiedingen)
		-> with('bedrijf', $bedrijf);
	}

	public function post_create(){

		if( ! $this->check_business_auth(Input::get('idbedrijf'))) {
			return Redirect::to_route('index');
		}

		$validation = Aanbieding::validate(Input::all());

		if ($validation->passes()) {

			$newproducten = Input::get('producten');

			Aanbieding::create(array(
				'idbedrijf' => Input::get('idbedrijf'),
				'actienaam' => Input::get('actienaam'),
				'omschrijving' => Input::get('omschrijving'),
				'korting' => Input::get('korting'),
				'actief' => Input::get('actief')
				));

			if(is_array($newproducten)){
				foreach ($newproducten as $key => $value) {
					$productenaanbieding = $aanbieding->producten()->attach($value);
				}
			} else {
				$productenaanbieding = $aanbieding->producten()->attach($newproducten);
			}

			return Redirect::to_route('bedrijven')
			-> with('message', 'de aanbieding is aangemaakt');
		}  else {

			return Redirect::to_route('new_aanbieding', Input::get('idbedrijf'))
			-> with_errors($validation)
			-> with_input();
		}
	}

	public function put_update() {

		$id = Input::get('aanbieding_id');

		if(!$this->check_business_auth($aanbieding->bedrijf->idbedrijf)){ return Redirect::to_route('index'); }

		$validation = Aanbieding::validate(Input::all());

		if ($validation->passes()) {

			Aanbieding::update($id, array(
				'actienaam' => Input::get('actienaam'),
				'omschrijving' => Input::get('omschrijving'),
				'korting' => Input::get('korting'),
				'actief' => Input::get('actief')
				));

			$newproducten = Input::get('producten');

			$aanbieding = Aanbieding::find($index);
			$aanbieding->producten()->delete();
			$aanbieding->fill($values);
			$aanbieding->save();

			if(is_array($newproducten)){
				foreach ($newproducten as $key => $value) {
					$productenaanbieding = $aanbieding->producten()->attach($value);
				}
			} else {
				$productenaanbieding = $aanbieding->producten()->attach($newproducten);
			}

			return Redirect::to_route('bedrijven')->with('message', 'de aanbieding is aangepast');
		} else {

			return Redirect::to_route('edit_aanbieding', $id)
			-> with_input()
			-> with_errors($validation);
		}
	}

	public function get_destroy($index){
		$aanbieding = Aanbieding::with('producten')->where('idaanbieding', '=', $index)->first();
		if(is_null($aanbieding)){
			return Redirect::to_route('index');
		}

		if(!$this->check_business_auth($aanbieding->producten[0]->idbedrijf)){ return Redirect::to_route('index'); }

		$aanbieding->producten()->delete();
		$aanbieding->delete();
		return Redirect::to_route('bedrijven')->with('message', 'de aanbieding is verwijderd');
	}

	public function check_business_auth($requested_business_id){
		if(!Session::has('businessids')){
			return false;
		}
		if(in_array($requested_business_id, Session::get('businessids'))){
			return true;
		} else {
			return false;
		}
	}
}


// Niet weghalen dit is een aantekening

// Post Create
// if(is_array($newproducten)){
// 	$aanbieding = Aanbieding::create($values);
// 	foreach ($newproducten as $key => $value) {
// 		$product = Product::find($value);
// 		$productenaanbieding = $product->aanbiedingen()->attach($aanbieding);
// 	}
// } else {
// 	$aanbieding = new Aanbieding($values);
// 	$product = Product::find($newproducten);
// 	$productenaanbieding = $product->aanbiedingen()->insert($aanbieding);
// }

