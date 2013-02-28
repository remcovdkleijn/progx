@layout('master')

@section('header')
	@include('header')
@endsection

@section('container')
	<h2>Alle Producten</h2>

	@if (Session::has('message'))
		<p>{{ Session::get('message') }}</p>
	@endif

	@forelse ($producten as $product)
		<p>Naam: {{ $product->naam }}</p>
		<p>Categorie: {{ $product->productcategorie->categorie }}</p>
		<p>Bedrijf: {{ $product->bedrijf->bedrijfsnaam }}</p>

		<a href="{{URL::to_route('product', $product->idproduct) }}">show</a> </p>

		<hr />
	@empty
		<p>Er zijn geen producten</p>
	@endforelse

@endsection

@section('footer')
	@include('footer')
@endsection