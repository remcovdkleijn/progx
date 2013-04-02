<?php

class Aanbieding extends Basemodel {
	public static $timestamps = false;

	public static $rules = array(
		'actienaam' => 'required',
		//'omschrijving' => '',
		'korting' => 'required|numeric',
		'producten' => 'required'
		//'actief' => 'required'
	);

	public static $key = 'idaanbieding';

	public static $table = "aanbiedingen";

	public function producten(){
		return $this->has_many_and_belongs_to('Product', 'product_per_aanbieding');
	}

	public function bedrijf(){
		return $this->belongs_to('Bedrijf', 'idbedrijf');
	}

	public static function get_all_active() {
		return static::where('actief', '=', TRUE) -> get();
	}

	public static function get_all_belonging_to_bedrijf($bedrijfid) {
		return static::where('idbedrijf', '=', $bedrijfid) -> get();
	}

}