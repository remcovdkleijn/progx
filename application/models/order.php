<?php

class Order extends Basemodel {
	public static $timestamps = false;

	public static $key = 'idorder';

	public function order_regels() {
		return $this -> has_many('Order_regel');
	}
}