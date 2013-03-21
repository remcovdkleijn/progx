<?php

class Cart_Controller extends Base_Controller {

	public $restful = true;

	public function get_index() {
		return View::make('cart.index');
	}

	public function get_add($id) {

		$product = Product::find($id);

		$item = array(

			'id' => $id,
			'qty' => 1,
			'price' => $product -> prijs,
			'name' => $product -> naam

		);

		Cartify::cart()->insert($item);

		return Redirect::to_route('cart');
	}

	public function put_update() {

		$items = Input::get('items');

		if( count($items) > 0 )
		{
			foreach($items as $key => $value) {

				$item = array(
					'rowid' => $key,
					'qty' => $value['qty']
				);

				Cartify::cart()->update($item);
			}

			return Redirect::to_route('cart')
				-> with('message', 'Uw aantallen zijn doorgevoerd.');
		}

		return Redirect::to_route('cart');
	}

	public function get_destroy($rowid) {

		Cartify::cart()->remove($rowid);

		return Redirect::to_route('cart')
			-> with('message', 'Het product is verwijderd.');
	}

	public function get_checkout() {

		$this -> validate_cart_contents();

		return View::make('cart.checkout');
	}

	public function post_checkout() {

		$this -> validate_cart_contents();

		$order = Order::create(array(
			'iduser' => Auth::user() -> iduser
		));

		foreach(Cartify::cart() -> contents() as $item) {
			Orderregel::create(array(
				'idproduct' => $item['id'],
				'order_id' => $order -> idorder,
				'price' => $item['price'],
				'qty' =>$item['qty']
			));
		}

		return Redirect::to_route('show_order', $order -> idorder);
	}

	private function validate_cart_contents() {

		foreach(Cartify::cart() -> contents() as $item) {
			$product = Product::find($item['id']);
			$item['price'] = $product -> prijs;
		}
	}

}