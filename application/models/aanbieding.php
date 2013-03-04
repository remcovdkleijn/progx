<?php

class Aanbieding extends Eloquent {
	public static $timestamps = false;

	public static $key = 'idaanbieding';

	public static $table = "aanbiedingen";

	public function producten(){
         return $this->has_many_and_belongs_to('Product', 'product_per_aanbieding');
    }

    public function bedrijf(){
		return $this->belongs_to('Bedrijf', 'idbedrijf');
	}
	
}