@layout('layouts.default')

@section('content')
	<h2>Aanbieding toevoegen</h2>

	@if($errors -> has())
	<ul id="form-errors">
		{{ $errors -> first('actienaam', '<li>:message</li>') }}
		{{ $errors -> first('omschrijving', '<li>:message</li>') }}
		{{ $errors -> first('korting', '<li>:message</li>') }}
		{{ $errors -> first('producten', '<li>:message</li>') }}
		{{ $errors -> first('actief', '<li>:message</li>') }}
	</ul>
	@endif

	{{ Form::open('aanbiedingen/create', 'POST') }}

		{{ Form::token() }}

		{{ Form::hidden('bedrijf_id', $bedrijf->idbedrijf) }}

		<p>
			{{ Form::label('actienaam', 'Actienaam') }}
			{{ Form::text('actienaam', Input::old('actienaam')) }}
		</p>

		<p>
			{{ Form::label('omschrijving', 'Omschrijving') }}
			{{ Form::text('omschrijving', Input::old('omschrijving')) }}
		</p>

		<p>
			{{ Form::label('korting', 'Korting') }}
			{{ Form::text('korting', Input::old('korting')) }}
		</p>

		<p>
			@forelse ($producten as $product)

				{{ Form::label('producten', $product->naam) }}
				{{ Form::checkbox('producten[]', $product->idproduct, Input::old('producten')) }}

			@empty

				<p>Er zijn geen producten</p>
				{{ HTML::link_to_route('new_product', 'Product toevoegen', $bedrijf -> idbedrijf) }}

			@endforelse
		</p>

		<p>
			{{ Form::label('actief', 'Direct actief?') }}
			{{ Form::checkbox('actief', 1, Input::old('actief')) }}
		</p>

		{{ Form::submit('Aanbieding toevoegen') }}

	{{ Form::close() }}

@endsection