@layout('layouts.default')

@section('content')
	<h2>Alle Producten van bedrijf {{$bedrijf->bedrijfsnaam}}</h2>

	@forelse ($producten as $product)
		<p>Naam: {{ $product->naam }}</p>
		<p>Categorie: {{ $product->productcategorie->categorie }}</p>
		@forelse ($product->aanbiedingen as $aanbieding)
			<p>Actienaam: {{ $aanbieding->actienaam }}, {{ $aanbieding->korting }}% korting. <a href="{{ URL::to_route('aanbieding', $aanbieding->idaanbieding) }}">Bekijk actie</a></p>
		@empty
			<p>Er zijn geen aanbiedingen voor dit product</p>
		@endforelse

		{{ HTML::link_to_route('product', 'Show', $product->idproduct) }}
	@empty
		<p>Er zijn geen producten</p>
		{{ HTML::link_to_route('new_product', 'Product toevoegen', $product -> idproduct) }}
	@endforelse

@endsection