<?php

class Aanbiedingen_Controller extends Base_Controller {

	public $restful = true;

	public function get_index(){

		$aanbiedingen = Aanbieding::get_all_active();

		return View::make('aanbieding.index')
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
		$producten = Product::all();

		if( ! $this->bedrijf_belongs_to_user($aanbieding->bedrijf->idbedrijf)) {
			return Redirect::to_route('index');
		}

		return View::make('aanbieding.edit')
		-> with('aanbieding', $aanbieding)
		-> with('producten', $producten);
	}

	public function get_new($idbedrijf){

		if(!$this->bedrijf_belongs_to_user($idbedrijf)) {
			return Redirect::to_route('index');
		}

		$bedrijf = Bedrijf::find($idbedrijf)->first();
		$producten = Product::where('idbedrijf', '=', $bedrijf->idbedrijf)->get();

		return View::make('aanbieding.new')
			-> with('bedrijf', $bedrijf)
			-> with('producten', $producten);
	}

	public function get_all_per_bedrijf($idbedrijf) {

		$bedrijf = Bedrijf::find($idbedrijf);

		$aanbiedingen = Aanbieding::get_all_belonging_to_bedrijf($idbedrijf);

		return View::make('aanbieding.bedrijven_showall')
		-> with('aanbiedingen', $aanbiedingen)
		-> with('bedrijf', $bedrijf);
	}

	public function post_create(){

		$bedrijf_id = Input::get('bedrijf_id');

		if( ! $this->bedrijf_belongs_to_user($bedrijf_id)) {
			return Redirect::to_route('index');
		}

		$validation = Aanbieding::validate(Input::all());

		if ($validation->passes()) {

			$newproducten = Input::get('producten');

			$aanbieding = Aanbieding::create(array(
				'idbedrijf' => $bedrijf_id,
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
				-> with('message', 'Uw aanbieding is succesvol aangemaakt.');
		}  else {

			return Redirect::to_route('new_aanbieding', $bedrijf_id)
			-> with_errors($validation)
			-> with_input();
		}
	}

	public function put_update() {

		$id = Input::get('aanbieding_id');

		$aanbieding = Aanbieding::find($id);

		if(!$this->bedrijf_belongs_to_user($aanbieding -> idbedrijf)){ return Redirect::to_route('index'); }

		$validation = Aanbieding::validate(Input::all());

		if ($validation->passes()) {

			Aanbieding::update($id, array(
				'actienaam' => Input::get('actienaam'),
				'omschrijving' => Input::get('omschrijving'),
				'korting' => Input::get('korting'),
				'actief' => Input::get('actief')
			));

			$newproducten = Input::get('producten');

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

	public function get_destroy($aanbieding_id){

		$aanbieding = Aanbieding::find($aanbieding_id);

		if(!$this->bedrijf_belongs_to_user($aanbieding->idbedrijf)){
			return Redirect::to_route('index');
		}

		$aanbieding -> producten() -> delete();
		$aanbieding -> delete();

		return Redirect::to_route('bedrijf')
			-> with('message', 'De aanbieding is succesvol verwijderd.');
	}

	public function bedrijf_belongs_to_user($company_id){

		// Werkt nog niet :(

		$bedrijf = Bedrijf::find($company_id);
		$bedrijven_van_gebruiker = Auth::user() -> bedrijven;

		if(in_array($bedrijf, $bedrijven_van_gebruiker)) {
			return true;
		}

		return true; // Tijdelijke fix
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

