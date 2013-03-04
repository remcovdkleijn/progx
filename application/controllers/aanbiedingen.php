<?php

class Aanbiedingen_Controller extends Base_Controller {

	public $restful = true;

	public $form_rules = array(
		'actienaam' => 'required',
		//'omschrijving' => '',
		'korting' => 'required|numeric',
		'producten' => 'required',
		'actief' => 'required'
	);

	public $form_messages = array(
		'required' => 'The :attribute field is required.'
	);

	public function get_all(){
		$aanbiedingen = Aanbieding::with(array('producten', 'bedrijf'))->where('actief', '=', '1')->get();
		foreach ($aanbiedingen as $key => $aanbieding) {
			foreach ($aanbieding->relationships['producten'] as $key2 => $product) {
				$aanbiedingen[$key]->relationships['producten'][$key2] = Product::with('productcategorie')->where('idproduct', '=', $product->idproduct)->first();
			}
		}

		return View::make('aanbieding.all', array('aanbiedingen' => $aanbiedingen));
	}

	public function get_index($idbedrijf){

		$bedrijf = Bedrijf::find($idbedrijf);

		$aanbiedingen = Aanbieding::with(array('producten'))->where('idbedrijf', '=', $idbedrijf)->get();
		foreach ($aanbiedingen as $key => $aanbieding) {
			foreach ($aanbieding->relationships['producten'] as $key2 => $product) {
				$aanbiedingen[$key]->relationships['producten'][$key2] = Product::with('productcategorie')->where('idproduct', '=', $product->idproduct)->first();
			}
		}

		return View::make('aanbieding.index', array('aanbiedingen' => $aanbiedingen, 'bedrijf' => $bedrijf));
	}

	public function post_create(){

		if(!$this->check_business_auth(Input::get('idbedrijf'))){ return Redirect::to_route('index'); }

		$validation = Validator::make(Input::all(), $this->form_rules, $this->form_messages);

		if ($validation->fails()) {
			$values = array(
				'actienaam' => Input::get('actienaam'),
				'omschrijving' => Input::get('omschrijving'),
	    		'korting' => Input::get('korting'),
	    		'producten' => Input::get('producten'),
	    		'actief' => Input::get('actief')
	    	);
        	return Redirect::to_route('new_aanbieding', Input::get('idbedrijf'))->with('form_values', $values)->with_errors($validation);
    	} else {

    		$values = array(
    			'idbedrijf' => Input::get('idbedrijf'),
				'actienaam' => Input::get('actienaam'),
				'omschrijving' => Input::get('omschrijving'),
	    		'korting' => Input::get('korting'),
	    		'actief' => Input::get('actief')
	    	);

	    	$newproducten = Input::get('producten');

	    	$aanbieding = Aanbieding::create($values);
	    	
	    	if(is_array($newproducten)){
    			foreach ($newproducten as $key => $value) {
	    			$productenaanbieding = $aanbieding->producten()->attach($value);
	    		}
    		} else {
    			$productenaanbieding = $aanbieding->producten()->attach($newproducten);
    		}

    		if($aanbieding){
    			return Redirect::to_route('bedrijven')->with('message', 'de aanbieding is aangemaakt');
    		} else {
    			return 'database error';
    		}
    	}
	}

	public function get_show($index){

		$aanbieding = Aanbieding::with(array('producten', 'bedrijf'))->where('idaanbieding', '=', $index)->first();
		if(is_null($aanbieding)){
			return Redirect::to_route('index');
		}

		$edit = $this->check_business_auth($aanbieding->bedrijf->idbedrijf);
		if($aanbieding->actief == 0){
			if(!$edit){ return Redirect::to_route('index'); }
		}

		foreach ($aanbieding->relationships['producten'] as $key => $product) {
			$aanbieding->relationships['producten'][$key] = Product::with('productcategorie')->where('idproduct', '=', $product->idproduct)->first();
		}

		return View::make('aanbieding.show', array('aanbieding' => $aanbieding, 'edit' => $edit));
	}

	public function get_edit($index){
		$aanbieding = Aanbieding::with(array('producten', 'bedrijf'))->where('idaanbieding', '=', $index)->first();
		if(is_null($aanbieding)){
			return Redirect::to_route('index');
		}

		if(!$this->check_business_auth($aanbieding->bedrijf->idbedrijf)){ return Redirect::to_route('index'); }
		$producten = Product::where('idbedrijf', '=', $aanbieding->bedrijf->idbedrijf)->get();

		foreach ($aanbieding->relationships['producten'] as $key => $product) {
			$producten_per_aanbieding[] = $product->idproduct;
		}

		return View::make('aanbieding.edit', array('aanbieding' => $aanbieding, 'producten' => $producten, 'producten_per_aanbieding' => $producten_per_aanbieding));
	}

	public function get_new($idbedrijf){

		if(!$this->check_business_auth($idbedrijf)){ return Redirect::to_route('index'); }

		$bedrijf = Bedrijf::find($idbedrijf)->first();
		$producten = Product::where('idbedrijf', '=', $bedrijf->idbedrijf)->get();

		return View::make('aanbieding.new', array('bedrijf' => $bedrijf, 'producten' => $producten));
	}

	public function put_update($index){
		$aanbieding = Aanbieding::with('bedrijf')->where('idaanbieding', '=', $index)->first();

		if(!$this->check_business_auth($aanbieding->bedrijf->idbedrijf)){ return Redirect::to_route('index'); }

		$validation = Validator::make(Input::all(), $this->form_rules, $this->form_messages);

		if ($validation->fails()) {
			$values = array(
				'actienaam' => Input::get('actienaam'),
				'omschrijving' => Input::get('omschrijving'),
	    		'korting' => Input::get('korting'),
	    		'producten' => Input::get('producten'),
	    		'actief' => Input::get('actief')
	    	);
        	return Redirect::to_route('edit_aanbieding', $index)->with('form_values', $values)->with_errors($validation);
    	} else {

    		$values = array(
				'actienaam' => Input::get('actienaam'),
				'omschrijving' => Input::get('omschrijving'),
	    		'korting' => Input::get('korting'),
	    		'actief' => Input::get('actief')
	    	);

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

    		if($aanbieding){
    			return Redirect::to_route('bedrijven')->with('message', 'de aanbieding is aangepast');
    		} else {
    			return 'database error';
    		}
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

