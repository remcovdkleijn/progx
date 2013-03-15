<?php

class Bedrijf extends Basemodel {
	public static $timestamps = false;

	public static $key = 'idbedrijf';

	public static $table = "bedrijven";

	public static $rules = array(
		'bedrijfsnaam' => 'required',
		'kvk' => 'required',
		'adres' => 'required',
		'postcode' => 'required',
		'city' => 'required',
		'land' => 'required'
	);

	public function users(){
         return $this->has_many_and_belongs_to('User', 'users_per_bedrijf');
    }

	public function producten(){
		return $this->has_many('product', 'idproduct');
	}

	public function aanbiedingen(){
		return $this->has_many('aanbieding', 'idaanbieding');
	}


}