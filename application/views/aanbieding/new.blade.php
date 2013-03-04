@layout('master')

@section('header')
	@include('header')
@endsection

@section('container')
	<h2>new aanbieding</h2>

	{{ Form::open('aanbiedingen') }}

		{{ Form::hidden('idbedrijf', $bedrijf->idbedrijf) }}

		{{ Form::label('actienaam', 'Actienaam') }}
		{{ Form::text('actienaam', Session::get('form_values')['actienaam']) }}
		{{ $errors->first('actienaam', '<p>:message</p>') }}
		<br />

		{{ Form::label('omschrijving', 'Omschrijving') }}
		{{ Form::text('omschrijving', Session::get('form_values')['omschrijving']) }}
		{{ $errors->first('omschrijving', '<p>:message</p>') }}
		<br />

		{{ Form::label('korting', 'Korting') }}
		{{ Form::text('korting', Session::get('form_values')['korting']) }}
		{{ $errors->first('korting', '<p>:message</p>') }}
		<br />

		@forelse ($producten as $product)

			{{ Form::label('producten', $product->naam) }}

			<?php 
			if(Session::has('form_values') && !is_null(Session::get('form_values')['producten']) && in_array($product->idproduct, Session::get('form_values')['producten'])){
				echo Form::checkbox('producten[]', $product->idproduct, true);
			} else {
				echo Form::checkbox('producten[]', $product->idproduct);
			}
			?>
			
		@empty
			<p>Er zijn geen producten</p>
			<a href="{{ URL::to_route('new_product', $bedrijf->idbedrijf) }}">New Product</a>
		@endforelse
		{{ $errors->first('producten', '<p>:message</p>') }}
		<br />

		{{ Form::label('actief', 'Actief') }}
		{{ Form::label('actief', 'ja') }}
		@if (Session::get('form_values')['actief'] == 1)
			{{ Form::radio('actief', '1', true) }}
		@else
			{{ Form::radio('actief', '1') }}
		@endif
		{{ Form::label('actief', 'nee') }}
		@if (Session::get('form_values')['actief'] == 0)
			{{ Form::radio('actief', '0', true) }}
		@else
			{{ Form::radio('actief', '0') }}
		@endif
		{{ $errors->first('actief', '<p>:message</p>') }}
		<br />

		{{ Form::submit('save') }}
	{{ Form::close() }}

@endsection

@section('footer')
	@include('footer')
@endsection