@layout('layouts.default')

@section('content')
	<h2>Registreren</h2>

	{{ Form::open('users/new') }}

		<h3>Account</h3>
		<p>
			{{ Form::label('email', 'Je e-mailadres:') }}
			{{ Form::text('email', Session::get('form_values')['email']) }}
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
			{{ Form::text('voornaam', Session::get('form_values')['voornaam']) }}
			{{ $errors->first('voornaam', '<p>:message</p>') }}
		</p>

		<p>
			{{ Form::label('achternaam', 'Achternaam:') }}
			{{ Form::text('achternaam', Session::get('form_values')['achternaam']) }}
			{{ $errors->first('achternaam', '<p>:message</p>') }}
		</p>

		<p>
			{{ Form::label('adres', 'Adres:') }}
			{{ Form::text('adres', Session::get('form_values')['adres']) }}
			{{ $errors->first('adres', '<p>:message</p>') }}
		</p>

		<p>
			{{ Form::label('postcode', 'Postcode:') }}
			{{ Form::text('postcode', Session::get('form_values')['postcode']) }}
			{{ $errors->first('postcode', '<p>:message</p>') }}
		</p>

		<p>
			{{ Form::label('city', 'Woonplaats:') }}
			{{ Form::text('city', Session::get('form_values')['city']) }}
			{{ $errors->first('city', '<p>:message</p>') }}
		</p>

		<p>
			{{ Form::label('land', 'Land:') }}
			{{ Form::text('land', Session::get('form_values')['land']) }}
			{{ $errors->first('land', '<p>:message</p>') }}
		</p>

		{{ Form::submit('Registreren') }}
	{{ Form::close() }}

@endsection