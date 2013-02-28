<?php

class Producten_Controller extends Base_Controller {

	public $restful = true;

	public $form_rules = array(
		'naam' => 'required',
		//'omschrijving' => '',
		'categorie' => 'required|not_in:categorie',
		'hoeveelheid' => 'required|numeric',
		'prijs' => 'required|numeric',
	);

	public $form_messages = array(
		'required' => 'The :attribute field is required.',
		'numeric' => 'The :attribute field may containt only numbers.',
		'not_in' => 'Please select a :attribute'
	);

	public function get_all(){
		$producten = Product::with(array('productcategorie', 'bedrijf'))->get();
		return View::make('product.all', array('producten' => $producten));
	}

	public function get_index($index){
		// alle producten laten zien

		if(!$this->check_business_auth($index)){ return Redirect::to_route('index'); }

		$bedrijf = Bedrijf::where('idbedrijf', '=', $index)->first();

		$producten = Product::with('productcategorie')->where('idbedrijf', '=', $index);

		if(is_null($producten)){
			$producten = array();
		} else {
			$producten = $producten->get();
		}

		return View::make('product.index', array('producten' => $producten, 'bedrijf' => $bedrijf));
	}

	public function post_create(){
		// create new product

		if(!$this->check_business_auth(Input::get('idbedrijf'))){ return Redirect::to_route('index'); }

		$validation = Validator::make(Input::all(), $this->form_rules, $this->form_messages);

		if ($validation->fails()) {
			$values = array(
				'naam' => Input::get('naam'),
				'omschrijving' => Input::get('omschrijving'),
	    		'categorie' => Input::get('categorie'),
	    		'hoeveelheid' => Input::get('hoeveelheid'),
	    		'prijs' => Input::get('prijs'),
	    	);
        	return Redirect::to_route('new_product', Input::get('idbedrijf'))->with('form_values', $values)->with_errors($validation);
    	} else {

    		$values = array(
    			'idproduct_categorie' => Productcategorie::where('categorie', '=', Input::get('categorie'))->first()->idproduct_categorie,
    			'idbedrijf' => Input::get('idbedrijf'),
				'naam' => Input::get('naam'),
				'omschrijving' => Input::get('omschrijving'),
	    		'hoeveelheid' => Input::get('hoeveelheid'),
	    		'prijs' => Input::get('prijs'),
	    	);

    		$product = Product::create($values);
    		if($product){
    			return Redirect::to_route('bedrijven')->with('message', 'the product had been created');
    		} else {
    			return 'database error';
    		}
    	}
	}

	public function get_show($index){
		// show 1 product
		$product = Product::with(array('productcategorie', 'bedrijf'))->where('idproduct', '=', $index)->first();

		$get = $this->check_business_auth($product->bedrijf->idbedrijf);

		return View::make('product.show', array('product' => $product, 'get' => $get));
	}

	public function get_edit($index){
		// form edit product
		$product = Product::with('productcategorie')->where('idproduct', '=', $index)->first();

		if(!$this->check_business_auth($product->idbedrijf)){ return Redirect::to_route('index'); }

		$product_categorieen = Productcategorie::all();
		foreach ($product_categorieen as $key => $value) {
			$selectArray[$value->categorie] = $value->categorie;
		}

		return View::make('product.edit', array('product' => $product, 'categorieen' => $selectArray));
	}

	public function get_new($bedrijfsid){
		// form new product

		if(!$this->check_business_auth($bedrijfsid)){ return Redirect::to_route('index'); }

		$product_categorieen = Productcategorie::all();

		$selectArray['categorie'] = '-categorie-';
		foreach ($product_categorieen as $key => $value) {
			$selectArray[$value->categorie] = $value->categorie;
		}

		return View::make('product.new', array('bedrijfsid' => $bedrijfsid, 'categorieen' => $selectArray));
	}

	public function put_update($index){
		// update product

		$validation = Validator::make(Input::all(), $this->form_rules, $this->form_messages);

		if ($validation->fails()) {
			$values = array(
				'naam' => Input::get('naam'),
				'omschrijving' => Input::get('omschrijving'),
	    		'categorie' => Input::get('categorie'),
	    		'hoeveelheid' => Input::get('hoeveelheid'),
	    		'prijs' => Input::get('prijs'),
	    	);
        	return Redirect::to_route('edit_product', $index)->with('form_values', $values)->with_errors($validation);
    	} else {

    		$values = array(
    			'idproduct_categorie' => Productcategorie::where('categorie', '=', Input::get('categorie'))->first()->idproduct_categorie,
				'naam' => Input::get('naam'),
				'omschrijving' => Input::get('omschrijving'),
	    		'hoeveelheid' => Input::get('hoeveelheid'),
	    		'prijs' => Input::get('prijs'),
	    	);

    		$product = Product::find($index);
    		if(!$this->check_business_auth($product->idbedrijf)){ return Redirect::to_route('index'); }
    		$product->fill($values);
    		$product->save();
    		if($product){
    			return Redirect::to_route('bedrijven')->with('message', 'the product had been edited');
    		} else {
    			return 'database error';
    		}
    	}
		
	}

	public function get_destroy($index){
		// delete product
		$product = Product::find($index);
		if(!$this->check_business_auth($product->idbedrijf)){ return Redirect::to_route('index'); }
		$product->delete();
		return Redirect::to_route('bedrijven')->with('message', 'the product had been deleted');
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