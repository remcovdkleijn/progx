@layout('layouts.default')

@section('content')
	<h2>Product gegevens</h2>

	<table>
		<tr>
			<td>Productnaam:</td>
			<td>{{ $product->naam }}</td>
		</tr>
		<tr>
			<td>Omschrijving:</td>
			<td>{{ $product->omschrijving }}</td>
		</tr>
		<tr>
			<td>Categorie:</td>
			<td>{{ $product->productcategorie->categorie }}</td>
		</tr>
		<tr>
			<td>Hoeveelheid:</td>
			<td>{{ $product -> hoeveelheid }}</td>
		</tr>
		<tr>
			<td>Prijs:</td>
			<td>€{{ $product -> prijs }}</td>
		</tr>
		<tr>
			<td>Bedrijf:</td>
			<td>{{ $product -> bedrijf -> bedrijfsnaam }}</td>
		</tr>
		<tr>
			<td>Aanbieding?</td>
			<td>
				@forelse($product -> aanbiedingen as $aanbieding)
					{{ $aanbieding -> actienaam }} ({{ $aanbieding -> korting }}% korting) {{ HTML::link_to_route('aanbieding', 'Bekijk actie', $aanbieding->idaanbieding) }}
				@empty
					Er zijn geen aanbiedingen voor dit product
				@endforelse
			</td>
		</tr>
		<tr>
			<td>Kopen?</td>
			<td>{{ HTML::link_to_route('add_product_on_cart', 'Ik koop dit product!', $product -> idproduct) }}</td>
		</tr>
	</table>

	@if ( Auth::check() && count(Auth::user() -> bedrijven) > 0 )
		<a href="{{URL::to_route('edit_product', $product->idproduct)}}">Edit product</a>
		<a href="{{URL::to_route('del_product', $product->idproduct) }}">Delete product</a>
	@endif

@endsection