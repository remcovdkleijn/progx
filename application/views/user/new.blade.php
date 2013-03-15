@layout('layouts.default')

@section('content')
	<h2>Registreren</h2>

	{{ Form::open('user/register') }}

		<h3>Account</h3>
		<p>
			{{ Form::label('email', 'Je e-mailadres:') }}
			{{ Form::text('email', Input::old('email')) }}
			{{ $errors->first('email', '<p>:message</p>') }}
		</p>

		<p>
			{{ Form::label('password', 'Nieuw wachtwoord:') }}
			{{ Form::password('password') }}
			{{ $errors->first('password', '<p>:message</p>') }}
		</p>

		<p>
			{{ Form::label('password_confirmation', 'Herhaal wachtwoord:') }}
			{{ Form::password('password_confirmation') }}
			{{ $errors->first('password_confirmation', '<p>:message</p>') }}
		</p>
		<p>&nbsp;</p>

		<h3>Persoonsgegevens</h3>
		<p>
			{{ Form::label('voornaam', 'Voornaam:') }}
			{{ Form::text('voornaam', Input::old('voornaam')) }}
			{{ $errors->first('voornaam', '<p>:message</p>') }}
		</p>

		<p>
			{{ Form::label('achternaam', 'Achternaam:') }}
			{{ Form::text('achternaam', Input::old('achternaam')) }}
			{{ $errors->first('achternaam', '<p>:message</p>') }}
		</p>

		<p>
			{{ Form::label('adres', 'Adres:') }}
			{{ Form::text('adres', Input::old('adres')) }}
			{{ $errors->first('adres', '<p>:message</p>') }}
		</p>

		<p>
			{{ Form::label('postcode', 'Postcode:') }}
			{{ Form::text('postcode', Input::old('postcode')) }}
			{{ $errors->first('postcode', '<p>:message</p>') }}
		</p>

		<p>
			{{ Form::label('city', 'Woonplaats:') }}
			{{ Form::text('city', Input::old('city')) }}
			{{ $errors->first('city', '<p>:message</p>') }}
		</p>

		<p>
			{{ Form::label('land', 'Land:') }}
			{{ Form::text('land', Input::old('land')) }}
			{{ $errors->first('land', '<p>:message</p>') }}
		</p>

		{{ Form::submit('Registreren') }}
	{{ Form::close() }}

@endsection