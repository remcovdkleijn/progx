<?php

class Order extends Basemodel {
	public static $timestamps = false;

	// public static $key = 'order_id';

	public function order_regels() {
		return $this -> has_many('Orderregel');
	}
}