<?php

class Orderregel extends Basemodel {

	public static $timestamps = false;

	public static $table = "order_regels";

	// public static $key = "orders_regels_id";

	public function product(){
		return $this -> belongs_to('Product', 'idproduct');
	}

	public function order(){
		return $this -> belongs_to('Order', 'order_id');
	}

}