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

	public function get_destroy($rowid) {

		Cartify::cart()->remove($rowid);

		return Redirect::to_route('cart')
			-> with('message', 'Het product is verwijderd.');
	}

}