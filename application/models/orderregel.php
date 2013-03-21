<?php

class Orderregel extends Basemodel {

	public static $timestamps = false;

	public static $table = "order_regels";

	public static $key = "id";

	public function product(){
		return $this -> belongs_to('Product', 'idproduct');
	}

	public function order(){
		return $this -> belongs_to('Order', 'id');
	}

}