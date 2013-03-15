<?php

class Producten_Controller extends Base_Controller {

	public $restful = true;

	public function get_index() {

		$producten = Product::paginate(10);

		return View::make('product.index')
		-> with('producten', $producten);
	}

	public function get_show($product_id) {

		$product = Product::find($product_id);

		return View::make('product.show')
		-> with('product', $product);
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

	public function get_edit($product_id){
		// form edit product
		$product = Product::find($product_id);

		if(!$this->check_business_auth($product->idbedrijf)){ return Redirect::to_route('index'); }

		$product_categorieen = Productcategorie::all();
		foreach ($product_categorieen as $key => $value) {
			$selectArray[$value->categorie] = $value->categorie;
		}

		return View::make('product.edit', array('product' => $product, 'categorieen' => $selectArray));
	}

	public function get_all_per_bedrijf($index){ // aanbiedingen weergeven
		// alle producten laten zien

		if(!$this->check_business_auth($index)){ return Redirect::to_route('index'); }

		$bedrijf = Bedrijf::where('idbedrijf', '=', $index)->first();

		$producten = Product::with(array('productcategorie', 'aanbiedingen'))->where('idbedrijf', '=', $index);

		if(is_null($producten)){
			$producten = array();
		} else {
			$producten = $producten->get();
		}

		return View::make('product.index', array('producten' => $producten, 'bedrijf' => $bedrijf));
	}

	public function post_create(){

		if(!$this->check_business_auth(Input::get('idbedrijf'))){ return Redirect::to_route('index'); }

		$validation = Product::validation(Input::all());

		if ($validation->passes()) {

			$product = Product::create(array(
				'idproduct_categorie' => Productcategorie::where('categorie', '=', Input::get('categorie'))->first()->idproduct_categorie,
				'idbedrijf' => Input::get('idbedrijf'),
				'naam' => Input::get('naam'),
				'omschrijving' => Input::get('omschrijving'),
				'hoeveelheid' => Input::get('hoeveelheid'),
				'prijs' => Input::get('prijs'),
			));

			return Redirect::to_route('bedrijven')
			->with('message', 'Product is opgeslagen!');
		} else {
			return Redirect::to_route('new_product')
			-> with_input()
			-> with_errors($validation);
		}
	}

	public function put_update(){

		$id = Input::get('product_id');

		$validation = Product::validate(Input::all());

		if ($validation -> passes()) {

			if(!$this->check_business_auth($product->idbedrijf)){ return Redirect::to_route('index'); }

			Product::update($id, array(
				'idproduct_categorie' => Productcategorie::where('categorie', '=', Input::get('categorie'))->first()->idproduct_categorie,
				'naam' => Input::get('naam'),
				'omschrijving' => Input::get('omschrijving'),
				'hoeveelheid' => Input::get('hoeveelheid'),
				'prijs' => Input::get('prijs')
			));

			return Redirect::to_route('bedrijven')->with('message', 'the product had been edited');
		} else {
			return Redirect::to_route('edit_product', $id)
			-> with_input()
			-> with_errors($validation);
		}
	}

	public function get_destroy($index){
		// delete product
		$product = Product::with('aanbiedingen')->where('idproduct', '=', $index)->first();
		if(is_null($product)){
			return Redirect::to_route('index');
		}
		if(!$this->check_business_auth($product->idbedrijf)){ return Redirect::to_route('index'); }

		//dd(count($product->aanbiedingen));

		if(count($product->aanbiedingen) != 0){
			return Redirect::to_route('product', $product->idproduct)->with('message', 'het product kan niet verwijderd worden omdat er nog aanbiedingen zijn van dit product');
		}

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

		return FALSE;
	}
}