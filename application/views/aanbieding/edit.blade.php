@layout('layouts.default')

@section('content')
	<h2>Aanbieding aanpassen</h2>

	@if($errors -> has())
	<ul id="form-errors">
		{{ $errors -> first('actienaam', '<li>:message</li>') }}
		{{ $errors -> first('omschrijving', '<li>:message</li>') }}
		{{ $errors -> first('korting', '<li>:message</li>') }}
		{{ $errors -> first('producten', '<li>:message</li>') }}
		{{ $errors -> first('actief', '<li>:message</li>') }}
	</ul>
	@endif

	{{ Form::open('aanbiedingen/update', 'PUT') }}

		{{ Form::token() }}

		{{ Form::hidden('aanbieding_id', $aanbieding -> idaanbieding) }}
		{{ Form::hidden('bedrijf_id', $aanbieding -> bedrijf -> idbedrijf) }}

		<p>
			{{ Form::label('actienaam', 'Actienaam') }}
			{{ Form::text('actienaam', Input::old('actienaam', $aanbieding -> actienaam)) }}
		</p>

		<p>
			{{ Form::label('omschrijving', 'Omschrijving') }}
			{{ Form::text('omschrijving', Input::old('omschrijving', $aanbieding -> omschrijving)) }}
		</p>

		<p>
			{{ Form::label('korting', 'Korting') }}
			{{ Form::text('korting', Input::old('korting', $aanbieding -> korting)) }}
		</p>

		@forelse ($producten as $product)

			{{ Form::label('producten', $product->naam) }}

			@if(in_array($product, $aanbieding -> producten))
				{{ Form::checkbox('producten', 1, false) }}
			@else
				{{ Form::checkbox('producten', 0, true) }}
			@endif

		@empty
			<p>Er zijn geen producten</p>
			{{ HTML::link_to_route('new_product', 'Product aanmaken', $aanbieding->bedrijf->idbedrijf) }}
		@endforelse

		<p>
			{{ Form::label('actief', 'Actief') }}
			@if($aanbieding -> actief == 0)
				{{ Form::checkbox('actief', 1, false) }}
			@elseif($aanbieding -> actief == 1)
				{{ Form::checkbox('actief', 0, true) }}
			@endif
		</p>

		{{ Form::submit('Aanbieding opslaan') }}

	{{ Form::close() }}

@endsection