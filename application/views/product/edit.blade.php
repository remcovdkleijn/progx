@layout('master')

@section('header')
	@include('header')
@endsection

@section('container')
	<h2>Edit product</h2>

	@if (Session::has('message'))
		<p>{{ Session::get('message') }}</p>
	@endif

	{{ Form::open('producten/' . $product->idproduct, 'PUT') }}

		{{ Form::label('naam', 'Naam') }}
		@if(Session::has('form_values'))
			{{ Form::text('naam', Session::get('form_values')['naam']) }}
		@else
			{{ Form::text('naam', $product->naam) }}
		@endif
		{{ $errors->first('naam', '<p>:message</p>') }}
		<br />

		{{ Form::label('omschrijving', 'omschrijving') }}
		@if(Session::has('form_values'))
			{{ Form::text('omschrijving', Session::get('form_values')['omschrijving']) }}
		@else
			{{ Form::text('omschrijving', $product->omschrijving) }}
		@endif
		{{ $errors->first('omschrijving', '<p>:message</p>') }}
		<br />

		{{ Form::label('categorie', 'Categorie') }}
		@if(Session::has('form_values'))
			{{ Form::select('categorie', $categorieen, Session::get('form_values')['categorie']) }}
		@else
			{{ Form::select('categorie', $categorieen, $product->productcategorie->categorie) }}
		@endif
		{{ $errors->first('categorie', '<p>:message</p>') }}
		<br />

		{{ Form::label('hoeveelheid', 'Hoeveelheid') }}
		@if(Session::has('form_values'))
			{{ Form::text('hoeveelheid', Session::get('form_values')['hoeveelheid']) }}
		@else
			{{ Form::text('hoeveelheid', $product->hoeveelheid) }}
		@endif
		{{ $errors->first('hoeveelheid', '<p>:message</p>') }}
		<br />

		{{ Form::label('prijs', 'Prijs') }}
		@if(Session::has('form_values'))
			{{ Form::text('prijs', Session::get('form_values')['prijs']) }}
		@else
			{{ Form::text('prijs', $product->prijs) }}
		@endif
		{{ $errors->first('prijs', '<p>:message</p>') }}
		<br />

		{{ Form::submit('save') }}
	{{ Form::close() }}

@endsection

@section('footer')
	@include('footer')
@endsection