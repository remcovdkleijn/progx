<?php

class Product extends Basemodel {
	public static $timestamps = false;

	public static $key = 'idproduct';

	public static $table = "producten";

	public static $rules = array(
		'naam' => 'required',
		//'omschrijving' => '',
		'categorie' => 'required|not_in:categorie',
		'hoeveelheid' => 'required|numeric',
		'prijs' => 'required|numeric'
	);

	public function productcategorie(){
		return $this->belongs_to('Productcategorie', 'idproduct_categorie');
	}

	public function bedrijf(){
		return $this->belongs_to('Bedrijf', 'idbedrijf');
	}

	public function aanbiedingen(){
		return $this->has_many_and_belongs_to('Aanbieding', 'product_per_aanbieding');
	}

	public function order_regels() {
		return $this -> has_many('Orderregel', 'product_id');
	}


}