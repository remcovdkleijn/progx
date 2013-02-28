@layout('master')

@section('header')
	@include('header')
@endsection

@section('container')
	<h2>Product gegevens</h2>

	<p>Naam: {{ $product->naam }}</p>
	<p>Omschrijving: {{ $product->omschrijving }}</p>
	<p>Categorie: {{ $product->productcategorie->categorie }}</p>
	<p>Hoeveelheid: {{ $product->hoeveelheid }}</p>
	<p>Prijs: {{ $product->prijs }}</p>
	<p>Bedrijf: {{ $product->bedrijf->bedrijfsnaam }} </p>

	@if ( Session::has('logintype') && Session::get('logintype') == 'bedrijf' && $get == true)
		<a href="{{URL::to_route('edit_product', $product->idproduct)}}">edit</a>
	@endif

@endsection

@section('footer')
	@include('footer')
@endsection