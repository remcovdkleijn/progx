@layout('layouts.default')

@section('content')
	<h2>Alle Producten</h2>

	@forelse ($producten -> results as $product)
		<p>Naam: {{ $product->naam }}</p>
		<p>Categorie: {{ $product->productcategorie->categorie }}</p>
		<p>Bedrijf: {{ $product->bedrijf->bedrijfsnaam }}</p>
		@forelse ($product->aanbiedingen as $aanbieding)
			@if($aanbieding->actief == 1)
				<p>Actienaam: {{ $aanbieding->actienaam }}, {{ $aanbieding->korting }}% korting. <a href="{{ URL::to_route('aanbieding', $aanbieding->idaanbieding) }}">Bekijk actie</a></p>
			@endif
		@empty
			<p>Er zijn geen aanbiedingen voor dit product</p>
		@endforelse

		{{ HTML::link_to_route('product', 'Show', $product->idproduct) }}
	@empty
		<p>Er zijn geen producten</p>
	@endforelse

@endsection