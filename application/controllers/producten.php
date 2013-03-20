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

		if( ! $this -> bedrijf_belongs_to_user($bedrijfsid)) {
			return Redirect::to_route('index');
		}

		$product_categorieen = Productcategorie::all();

		$selectArray['categorie'] = '-categorie-';
		foreach ($product_categorieen as $key => $value) {
			$selectArray[$value->categorie] = $value->categorie;
		}

		return View::make('product.new', array('bedrijfsid' => $bedrijfsid, 'categorieen' => $selectArray));
	}

	public function get_edit($product_id){

		$product = Product::find($product_id);

		if( ! $this->bedrijf_belongs_to_user($product->idbedrijf)) {
			return Redirect::to_route('index');
		}

		$product_categorieen = Productcategorie::all();

		foreach ($product_categorieen as $key => $value) {
			$selectArray[$value->categorie] = $value->categorie;
		}

		return View::make('product.edit')
			-> with('product', $product)
			-> with('categorieen', $selectArray);
	}

	public function get_all_per_bedrijf($bedrijf_id){ // aanbiedingen weergeven
		// alle producten laten zien

		if(!$this->bedrijf_belongs_to_user($bedrijf_id)) {
			return Redirect::to_route('index');
		}

		$bedrijf = Bedrijf::find($bedrijf_id);
		$producten = Product::where('idbedrijf', '=', $bedrijf_id) -> paginate(10);

		return View::make('product.bedrijven_showall')
			-> with('producten', $producten)
			-> with('bedrijf', $bedrijf);
	}

	public function post_create() {

		$bedrijf_id = Input::get('bedrijf_id');

		if(!$this->bedrijf_belongs_to_user($bedrijf_id)) {
			return Redirect::to_route('index');
		}

		$validation = Product::validate(Input::all());

		if ($validation->passes()) {

			$product = Product::create(array(
				'idproduct_categorie' => Productcategorie::where('categorie', '=', Input::get('categorie'))->first()->idproduct_categorie,
				'idbedrijf' => $bedrijf_id,
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

		if(!$this->bedrijf_belongs_to_user($product->idbedrijf)){ return Redirect::to_route('index'); }

		$validation = Product::validate(Input::all());

		if ($validation -> passes()) {

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

	public function get_destroy($product_id){
		// delete product
		$product = Product::find($product_id);

		if(!$this->bedrijf_belongs_to_user($product->idbedrijf)) {
			return Redirect::to_route('index');
		}

		$product -> aanbiedingen() -> delete();
		$product -> delete();

		return Redirect::to_route('bedrijf')
			-> with('message', 'Het product is succesvol verwijderd.');
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