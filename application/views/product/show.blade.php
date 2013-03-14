@layout('layouts.default')

@section('content')
	<h2>Product gegevens</h2>

	<p>Naam: {{ $product->naam }}</p>
	<p>Omschrijving: {{ $product->omschrijving }}</p>
	<p>Categorie: {{ $product->productcategorie->categorie }}</p>
	<p>Hoeveelheid: {{ $product->hoeveelheid }}</p>
	<p>Prijs: {{ $product->prijs }}</p>
	<p>Bedrijf: {{ $product->bedrijf->bedrijfsnaam }} </p>
	@forelse ($product->aanbiedingen as $aanbieding)
		@if($aanbieding->actief == 1)
			<p>Actienaam: {{ $aanbieding->actienaam }}, {{ $aanbieding->korting }}% korting. <a href="{{ URL::to_route('aanbieding', $aanbieding->idaanbieding) }}">Bekijk actie</a></p>
		@endif
	@empty
		<p>Er zijn geen aanbiedingen voor dit product</p>
	@endforelse

	@if ( Session::has('logintype') && Session::get('logintype') == 'bedrijf' && $get == true)
		<a href="{{URL::to_route('edit_product', $product->idproduct)}}">edit</a>
		<a href="{{URL::to_route('del_product', $product->idproduct) }}">delete</a>
	@endif

@endsection