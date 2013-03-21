@layout('layouts.default')

@section('content')



	@foreach($test->orderregels as $orderregel)

		{{$orderregel->price}}

		{{$orderregel->product->naam}}
		{{$orderregel->product->prijs}}

	@endforeach


	{{ Form::open('cart/update', 'PUT') }}

		{{ Form::token() }}

		<table>
			<thead>
				<th>Product</th>
				<th>Aantal</th>
				<th>Prijs</th>
				<th></th>
			</thead>
			@foreach(Cartify::cart()->contents() as $item)

			<tr>
				<td>{{ $item['name'] }}</td>
				<td>{{ Form::text("items[".$item['rowid']."][qty]", $item['qty']) }}</td>
				<td>€ {{ ($item['price'] * $item['qty'])  }}</td>
				<td>{{ HTML::link_to_route('delete_from_cart', 'Verwijderen', $item['rowid']) }}</td>
			</tr>

			@endforeach

			<tr>
				<td></td>
				<td>Totaal</td>
				<td>€ {{ Cartify::cart()->total() }}</td>
				<td></td>
			</tr>

		</table>

		{{ Form::submit('Update hoeveelheden') }}

	{{ Form::close() }}

	{{ HTML::link_to_route('checkout_cart', 'Betalen') }}

@endsection