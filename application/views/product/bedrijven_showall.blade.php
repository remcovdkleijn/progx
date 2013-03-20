@layout('layouts.default')

@section('content')
	<h2>Alle Producten van bedrijf "{{ $bedrijf -> bedrijfsnaam}}"</h2>

	@if(!$producten -> results)
		<p>Er zijn geen producten.</p>
	@else
		<table>
			<thead>
				<tr>
					<th>Productnaam</th>
					<th>Categorie</th>
					<th>Prijs</th>
					<th>Aanbiedingen</th>
					<th></th>
				</tr>
			</thead>

			@foreach ($producten -> results as $product)
			<tr>
				<td>{{ HTML::link_to_route('product', $product->naam, $product->idproduct) }}</td>
				<td>{{ $product->productcategorie->categorie }}</td>
				<td>€{{ $product -> prijs}}</td>
				<td>
					@forelse($product -> aanbiedingen as $aanbieding)
						{{ $aanbieding -> actienaam }} ({{ $aanbieding -> korting }}% korting) {{ HTML::link_to_route('aanbieding', 'Bekijk actie', $aanbieding->idaanbieding) }}
					@empty
						Er zijn geen aanbiedingen voor dit product
					@endforelse
				</td>
				<td>
					{{ HTML::link_to_route('edit_product', 'Aanpassen', $product -> idproduct) }}
					{{ HTML::link_to_route('delete_product', 'Verwijderen', $product -> idproduct) }}
				</td>
			</tr>
			@endforeach

		</table>
	@endif

@endsection