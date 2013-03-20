@layout('layouts.default')

@section('content')
	<h2>Product aanpassen</h2>

	@if($errors -> has())
	<ul id="form-errors">
		{{ $errors -> first('naam', '<li>:message</li>') }}
		{{ $errors -> first('omschrijving', '<li>:message</li>') }}
		{{ $errors -> first('categorie', '<li>:message</li>') }}
		{{ $errors -> first('hoeveelheid', '<li>:message</li>') }}
		{{ $errors -> first('prijs', '<li>:message</li>') }}
	</ul>
	@endif

	{{ Form::open('producten/update', 'PUT') }}

		{{ Form::token() }}

		{{ Form::hidden('bedrijf_id', $product -> bedrijf -> bedrijfsid) }}

		<p>
			{{ Form::label('naam', 'Naam') }}
			{{ Form::text('naam', Input::old('naam', $product -> naam)) }}
		</p>

		<p>
			{{ Form::label('omschrijving', 'Omschrijving') }}
			{{ Form::text('omschrijving', Input::old('omschrijving', $product -> omschrijving)) }}
		</p>

		<p>
			{{ Form::label('categorie', 'Categorie') }}
			{{ Form::select('categorie', $categorieen, Input::old('categorie', $product -> categorie)) }}
			<a href="#">Nieuwe categorie</a>
		</p>

		<p>
			{{ Form::label('hoeveelheid', 'Hoeveelheid') }}
			{{ Form::text('hoeveelheid', Input::old('hoeveelheid', $product -> hoeveelheid)) }}
		</p>

		<p>
			{{ Form::label('prijs', 'Prijs') }}
			{{ Form::text('prijs', Input::old('prijs', $product -> prijs)) }}
		</p>

		{{ Form::submit('Toevoegen') }}

	{{ Form::close() }}

@endsection