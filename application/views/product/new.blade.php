@layout('master')

@section('header')
	@include('header')
@endsection

@section('container')
	<h2>Registreren Bedrijven</h2>

	{{ Form::open('producten') }}

		{{ Form::hidden('idbedrijf', $bedrijfsid)}}

		{{ Form::label('naam', 'Naam') }}
		{{ Form::text('naam', Session::get('form_values')['naam']) }}
		{{ $errors->first('naam', '<p>:message</p>') }}
		<br />

		{{ Form::label('omschrijving', 'Omschrijving') }}
		{{ Form::text('omschrijving', Session::get('form_values')['omschrijving']) }}
		{{ $errors->first('omschrijving', '<p>:message</p>') }}
		<br />

		{{ Form::label('categorie', 'Categorie') }}
		{{ Form::select('categorie', $categorieen, Session::get('form_values')['categorie']) }}
		{{ $errors->first('categorie', '<p>:message</p>') }}
		<a href="#">Nieuwe categorie</a>
		<br />

		{{ Form::label('hoeveelheid', 'Hoeveelheid') }}
		{{ Form::text('hoeveelheid', Session::get('form_values')['hoeveelheid']) }}
		{{ $errors->first('hoeveelheid', '<p>:message</p>') }}
		<br />

		{{ Form::label('prijs', 'Prijs') }}
		{{ Form::text('prijs', Session::get('form_values')['prijs']) }}
		{{ $errors->first('prijs', '<p>:message</p>') }}
		<br />

		{{ Form::submit('save') }}
	{{ Form::close() }}

@endsection

@section('footer')
	@include('footer')
@endsection