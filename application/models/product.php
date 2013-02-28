<?php

class Product extends Eloquent {
	public static $timestamps = false;

	public static $key = 'idproduct';

	public static $table = "producten";

	public function productcategorie(){
		return $this->belongs_to('Productcategorie', 'idproduct_categorie');
	}

	public function bedrijf(){
		return $this->belongs_to('Bedrijf', 'idbedrijf');
	}

	
}