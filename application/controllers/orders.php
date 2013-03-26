<?php

class Orders_Controller extends Base_Controller {

	public $restful = true;

	public function get_index() {
		$orders = Order::orders_by_user(Auth::user() -> iduser);

		return View::make('orders.index')
			-> with('orders', $orders);
	}

	public function get_show($order_id) {
		if( ! $this -> order_belongs_to_user($order_id)) {
			return Redirect::to_route('index');
		}

		$order = Order::with('orderregels') -> where('id', '=', $order_id) -> first();

		return View::make('orders.show')
			-> with('order', $order);
	}

	private function order_belongs_to_user($order_id) {
		$order = Order::find($order_id);

		if($order -> iduser == Auth::user() -> iduser) {
			return true;
		}

		return false;
	}

}