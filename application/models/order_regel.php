<?php

class Order_regel extends Basemodel {

	public static $timestamps = false;

	public static $table = "orders_regels";

	public function product(){
		return $this -> belongs_to('Product', 'idproduct');
	}

	public function order(){
		return $this -> belongs_to('Order', 'idproduct');
	}

}