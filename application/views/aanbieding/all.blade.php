@layout('layouts.default')

@section('content')
	<h2>Alle aanbiedingen</h2>

	@forelse ($aanbiedingen as $aanbieding)

		<p>Actienaam = {{ $aanbieding->actienaam }}</p>
		<p>Omschrijving = {{ $aanbieding->omschrijving }}</p>
		<p>Korting = {{ $aanbieding->korting }}%</p>
		<p>Bedrijf = {{ $aanbieding->bedrijf->bedrijfsnaam }}</p>
		<p>Producten:</p>
		<ul>
			@forelse($aanbieding->producten as $product)
				<li>
					<ul>
						<p>Naam = <a href="{{ URL::to_route('product', $product->idproduct) }}">{{ $product->naam }}</a> </p>
						<p>Categerie = {{ $product->productcategorie->categorie }}</p>
						<p>Prijs oud = €{{ $product->prijs }} </p>
						<p>Prijs new = €<?php echo round($product->prijs * ((100-$aanbieding->korting)/100), 2); ?></p>
					</ul>
				</li>
			@empty
				<p>Er zijn geen aanbiedingen</p>
			@endforelse
		</ul>

		<a href="{{ URL::to_route('aanbieding', $aanbieding->idaanbieding) }}">show aanbieding</a>

		<hr />
	@empty
		<p>Er zijn geen aanbiedingen</p>
	@endforelse

@endsection