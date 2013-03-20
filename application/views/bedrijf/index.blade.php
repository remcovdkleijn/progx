@layout('layouts.default')

@section('content')
	<h2>Alle bedrijven</h2>

	@forelse ($bedrijven as $bedrijf)
		<p>
			{{ $bedrijf->bedrijfsnaam }}
			{{ HTML::link_to_route('bedrijf', 'Toon', $bedrijf -> idbedrijf) }} -
			{{ HTML::link_to_route('ontkoppelbedrijf', 'Ontkoppelen', $bedrijf -> idbedrijf) }} -
			{{ HTML::link_to_route('new_product', 'Nieuw product', $bedrijf -> idbedrijf) }} -
			{{ HTML::link_to_route('all_products_from_bedrijf', 'Producten', $bedrijf -> idbedrijf) }} -
			{{ HTML::link_to_route('new_aanbieding', 'Nieuwe aanbieding', $bedrijf -> idbedrijf) }} -
			{{ HTML::link_to_route('all_aanbiedingen_from_bedrijf', 'Aanbiedingen', $bedrijf->idbedrijf) }}
		</p>
	@empty
		<p>Er zijn geen bedrijven</p>
	@endforelse

@endsection