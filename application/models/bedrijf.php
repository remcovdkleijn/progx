<?php

class Bedrijf extends Eloquent {
	public static $timestamps = false;

	public static $key = 'idbedrijf';

	public static $table = "bedrijven";

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