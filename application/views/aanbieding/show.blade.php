@layout('layouts.default')

@section('content')
	<h2>Aanbieding</h2>

	<p>Actienaam = {{ $aanbieding -> actienaam }}</p>
	<p>Omschrijving = {{ $aanbieding->omschrijving }}</p>
	<p>Korting = {{ $aanbieding->korting }}%</p>
	<p>Actief = {{ ($aanbieding -> actief) ? ("Ja") : ("Nee") }}</p>
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
	@if(in_array($aanbieding -> bedrijf, Auth::user() -> bedrijven))
		{{ HTML::link_to_route('edit_aanbieding', 'Aanpassen', $aanbieding -> idaanbieding) }}
		{{ HTML::link_to_route('del_aanbieding', 'Verwijderen', $aanbieding -> idaanbieding) }}
	@endif


@endsection