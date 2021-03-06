@layout('layouts.default')

@section('content')
	<h2>Alle Producten</h2>

	@if(!$producten -> results)
		<p>Er zijn geen producten</p>
	@else
		<table>
			<thead>
				<tr>
					<th>Productnaam</th>
					<th>Categorie</th>
					<th>Prijs</th>
					<th>Aanbiedingen</th>
					<th>Kopen?</th>
				</tr>
			</thead>

			@foreach ($producten -> results as $product)
			<tr>
				<td>{{ HTML::link_to_route('product', $product->naam, $product->idproduct) }}</td>
				<td>{{ $product -> productcategorie -> categorie }}</td>
				<td>€{{ $product -> prijs}}</td>
				<td>
				@if($product -> aanbiedingen())
					@foreach($product -> aanbiedingen as $aanbieding)
						{{ $aanbieding -> actienaam }} ({{ $aanbieding -> korting }}% korting) {{ HTML::link_to_route('aanbieding', 'Bekijk actie', $aanbieding->idaanbieding) }}
					@endforeach
				@else
					Er zijn geen aanbiedingen voor dit product
				@endif
				</td>
				<td>{{ HTML::link_to_route('add_product_on_cart', 'Voeg toe', $product -> idproduct) }}</td>
			</tr>
			@endforeach

		</table>
	@endif

@endsection