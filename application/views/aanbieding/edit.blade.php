@layout('master')

@section('header')
	@include('header')
@endsection

@section('container')
	<h2>new aanbieding</h2>

	{{ Form::open('aanbiedingen/' . $aanbieding->idaanbieding, 'PUT') }}

		{{ Form::hidden('idbedrijf', $aanbieding->bedrijf->idbedrijf) }}

		{{ Form::label('actienaam', 'Actienaam') }}
		@if(Session::has('form_values'))
			{{ Form::text('actienaam', Session::get('form_values')['actienaam']) }}
		@else
			{{ Form::text('actienaam', $aanbieding->actienaam) }}
		@endif
		{{ $errors->first('actienaam', '<p>:message</p>') }}
		<br />

		{{ Form::label('omschrijving', 'Omschrijving') }}
		@if(Session::has('form_values'))
			{{ Form::text('omschrijving', Session::get('form_values')['omschrijving']) }}
		@else
			{{ Form::text('omschrijving', $aanbieding->omschrijving) }}
		@endif
		{{ $errors->first('omschrijving', '<p>:message</p>') }}
		<br />

		{{ Form::label('korting', 'Korting') }}
		@if(Session::has('form_values'))
			{{ Form::text('korting', Session::get('form_values')['korting']) }}
		@else
			{{ Form::text('korting', $aanbieding->korting) }}
		@endif
		{{ $errors->first('korting', '<p>:message</p>') }}
		<br />

		@forelse ($producten as $product)

			{{ Form::label('producten', $product->naam) }}

			<?php
			if(Session::has('form_values')){
				if(!is_null(Session::get('form_values')['producten']) && in_array($product->idproduct, Session::get('form_values')['producten'])){
					echo Form::checkbox('producten[]', $product->idproduct, true);
				} else {
					echo Form::checkbox('producten[]', $product->idproduct);
				}

			} else {
				if(in_array($product->idproduct, $producten_per_aanbieding)) {
					echo Form::checkbox('producten[]', $product->idproduct, true);
				} else {
					echo Form::checkbox('producten[]', $product->idproduct);
				}
			}
			?>

		@empty
			<p>Er zijn geen producten</p>
			<a href="{{ URL::to_route('new_product', $aanbieding->bedrijf->idbedrijf) }}">New Product</a>
		@endforelse
		{{ $errors->first('producten', '<p>:message</p>') }}
		<br />

		{{ Form::label('actief', 'Actief') }}
		@if($aanbieding -> actief == 0)
			{{ Form::checkbox('actief', 1, false) }}
		@elseif($aanbieding -> actief == 1)
			{{ Form::checkbox('actief', 0, true) }}
		@endif

		{{ $errors->first('actief', '<p>:message</p>') }}
		<br />

		{{ Form::submit('save') }}
	{{ Form::close() }}

@endsection

@section('footer')
	@include('footer')
@endsection