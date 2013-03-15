@layout('layouts.default')

@section('content')
	<h2>new aanbieding</h2>

	{{ Form::open('aanbiedingen') }}

		{{ Form::token() }}

		{{ Form::hidden('idbedrijf', $bedrijf->idbedrijf) }}

		{{ Form::label('actienaam', 'Actienaam') }}
		{{ Form::text('actienaam', Input::old('actienaam')) }}
		{{ $errors->first('actienaam', '<p>:message</p>') }}
		<br />

		{{ Form::label('omschrijving', 'Omschrijving') }}
		{{ Form::text('omschrijving', Input::old('omschrijving')) }}
		{{ $errors->first('omschrijving', '<p>:message</p>') }}
		<br />

		{{ Form::label('korting', 'Korting') }}
		{{ Form::text('korting', Input::old('korting')) }}
		{{ $errors->first('korting', '<p>:message</p>') }}
		<br />

		@forelse ($producten as $product)

			{{ Form::label('producten', $product->naam) }}
			{{ Form::checkbox('producten[]', $product->idproduct, Input::old('producten')) }}

		@empty
			<p>Er zijn geen producten</p>
			<a href="{{ URL::to_route('new_product', $bedrijf->idbedrijf) }}">New Product</a>
		@endforelse
		{{ $errors->first('producten', '<p>:message</p>') }}
		<br />

		{{ Form::label('actief', 'Direct actief?') }}
		{{ Form::checkbox('actief', 1, Input::old('actief')) }}
		{{ $errors->first('actief', '<p>:message</p>') }}
		<br />

		{{ Form::submit('save') }}
	{{ Form::close() }}

@endsection