<?php

class Bedrijf extends Eloquent {
	public static $timestamps = false;

	public static $key = 'idbedrijf';

	public static $table = "bedrijven";

	public function producten(){
		return $this->has_many('product', 'idproduct');
	}

	
}