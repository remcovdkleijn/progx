@layout('master')

@section('header')
	@include('header')
@endsection

@section('container')
	<h2>Alle Producten van bedrijf {{$bedrijf->bedrijfsnaam}}</h2>

	@if (Session::has('message'))
		<p>{{ Session::get('message') }}</p>
	@endif

	@forelse ($producten as $product)
		<p>Naam: {{ $product->naam }}</p>
		<p>Categorie: {{ $product->productcategorie->categorie }}</p>

		<a href="{{URL::to_route('product', $product->idproduct) }}">show</a> <a href="{{URL::to_route('del_product', $product->idproduct) }}">delete</a></p>

		<hr />
	@empty
		<p>Er zijn geen producten</p>
		<a href="{{ URL::to_route('new_product', $bedrijf->idbedrijf) }}">New Product</a>
	@endforelse

@endsection

@section('footer')
	@include('footer')
@endsection