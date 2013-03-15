@layout('layouts.default')

@section('content')
	<h2>Mijn gegevens</h2>

	{{ Form::open('users/update', 'PUT') }}

		<p> Jouw e-mailadres: {{ $user->email }} </p>

		<p>
			{{ Form::label('voornaam', 'Voornaam:') }}
			{{ Form::text('voornaam', $user->voornaam) }}
			{{ $errors->first('voornaam', '<p>:message</p>') }}
		</p>

		<p>
			{{ Form::label('achternaam', 'Achternaam:') }}
			{{ Form::text('achternaam', $user->achternaam) }}
			{{ $errors->first('achternaam', '<p>:message</p>') }}
		</p>

		<p>
			{{ Form::label('adres', 'Adres:') }}
			{{ Form::text('adres', $user->adres) }}
			{{ $errors->first('adres', '<p>:message</p>') }}
		</p>

		<p>
			{{ Form::label('postcode', 'Postcode:') }}
			{{ Form::text('postcode', $user->postcode) }}
			{{ $errors->first('postcode', '<p>:message</p>') }}
		</p>

		<p>
			{{ Form::label('city', 'Woonplaats:') }}
			{{ Form::text('city', $user->city) }}
			{{ $errors->first('city', '<p>:message</p>') }}
		</p>

		<p>
			{{ Form::label('land', 'Land:') }}
			{{ Form::text('land', $user->land) }}
			{{ $errors->first('land', '<p>:message</p>') }}
		</p>

		{{ Form::submit('Wijzigingen opslaan') }}
	{{ Form::close() }}

@endsection