<?php

class Productcategorie extends Eloquent {
	public static $timestamps = false;

	public static $key = 'idproduct_categorie';

	public static $table = "product_categorieen";

	public function producten(){
		return $this->has_many('product', 'idproduct');
	}

	
}