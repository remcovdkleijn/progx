<?php

class Orders_Controller extends Base_Controller {

	public $restful = true;

	public function get_index() {

		return View::make('orders.index');
	}

	public function get_show($order_id) {

		$order = Order::find($order_id);

		$regels = Orderregel::where('order_id', '=', $order_id) -> get();

		// dd($regels);

		return View::make('orders.show')
			-> with('order', $order)
			-> with('regels', $regels);
	}

}