@layout('master')

@section('header')
	@include('header')
@endsection

@section('container')
	<h2>Alle aanbiedingen van bedrijf {{ $bedrijf->bedrijfsnaam }}</h2>

	@if (Session::has('message'))
		<p>{{ Session::get('message') }}</p>
	@endif

	@forelse ($aanbiedingen as $aanbieding)

		<p>Actienaam = {{ $aanbieding->actienaam }}</p>
		<p>Omschrijving = {{ $aanbieding->omschrijving }}</p>
		<p>Korting = {{ $aanbieding->korting }}%</p>
		<p>Actief = {{ ($aanbieding->actief) ? ("Ja") : ("Nee") }}</p>
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

		<a href="{{ URL::to_route('aanbieding', $aanbieding->idaanbieding) }}">show aanbieding</a>

		<hr />
	@empty
		<p>Er zijn geen aanbiedingen</p>
	@endforelse

@endsection

@section('footer')
	@include('footer')
@endsection