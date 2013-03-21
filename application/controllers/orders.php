<?php

class Orders_Controller extends Base_Controller {

	public $restful = true;

	public function get_index() {

		return View::make('orders.index');
	}

	public function get_show($order_id) {

		Order::find($order_id);

		return View::make('orders.show')
			-> with('order', $order);
	}