<?php

class Order extends Basemodel {
	public static $table = "orders";

	public static $key = "id";

	public function orderregels() {
		return $this -> has_many('orderregel', 'order_id');
	}

	public function user(){
		return $this -> belongs_to('User', 'iduser');
	}

	public static function orders_by_user($user_id) {
		return static::where('iduser', '=', $user_id) -> get();
	}
}