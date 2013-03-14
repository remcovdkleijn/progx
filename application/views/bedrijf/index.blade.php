@layout('master')

@section('header')
	@include('header')
@endsection

@section('container')
	<h2>Alle bedrijven</h2>

	@if (Session::has('message'))
		<p>{{ Session::get('message') }}</p>
	@endif

	@forelse ($bedrijven as $bedrijf)
		<p>
			{{ $bedrijf->bedrijfsnaam }}
			<a href="{{URL::to_route('bedrijf', $bedrijf->idbedrijf) }}">show</a>
			<a href="{{URL::to_route('ontkoppelbedrijf', $bedrijf->idbedrijf) }}">ontkoppelen</a>
			<a href="{{URL::to_route('new_product', $bedrijf->idbedrijf) }}">new product</a>
			<a href="{{URL::to_route('producten', $bedrijf->idbedrijf) }}">show producten</a>
			<a href="{{URL::to_route('new_aanbieding', $bedrijf->idbedrijf)}}">new aanbieding</a>
			<a href="{{URL::to_route('aanbiedingen', $bedrijf->idbedrijf)}}">show aanbiedingen</a>
		</p>
	@empty
		<p>Er zijn geen bedrijven</p>
	@endforelse

@endsection

@section('footer')
	@include('footer')
@endsection