@layout('layouts.default')

@section('content')
	<h2>Aanbieding</h2>

	<p>Actienaam = {{ $aanbieding->actienaam }}</p>
	<p>Omschrijving = {{ $aanbieding->omschrijving }}</p>
	<p>Korting = {{ $aanbieding->korting }}%</p>
	<p>Actief =
		@if ($aanbieding->actief == 1)
			ja
		@else
			nee
		@endif
	</p>
	<p>Bedrijf = {{ $aanbieding->bedrijf->bedrijfsnaam }}</p>
	<p>Producten:</p>
	<ul>
		@forelse($aanbieding->producten as $product)
			<li>
				<ul>
					<p>Naam = <a href="{{ URL::to_route('product', $product->idproduct) }}">{{ $product->naam }}</a> </p>
					<p>Categerie = {{ $product->productcategorie->categorie }}</p>
					<p>Prijs oud = €{{ $product->prijs }} </p>
					<p>Prijs new = €{{ $product->prijs * ((100-$aanbieding->korting)/100) }}</p>
				</ul>
			</li>
		@empty
			<p>Er zijn geen aanbiedingen</p>
		@endforelse
	</ul>
	@if ($edit)
		<a href="{{ URL::to_route('edit_aanbieding', $aanbieding->idaanbieding) }}">edit aanbieding</a>
		<a href="{{ URL::to_route('del_aanbieding', $aanbieding->idaanbieding) }}">delete aanbieding</a>
	@endif


@endsection