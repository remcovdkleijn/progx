@layout('layouts.default')

@section('content')
	<h2>Login</h2>

	{{ $errors->first('password', '<p>:message</p>') }}

	{{ Form::open('Inloggen') }}

		{{ Form::token() }}

		<p>
			{{ Form::label('email', 'E-mailadres:') }}
			{{ Form::text('email', Session::get('form_values')['email']) }}
			{{ $errors->first('email', '<p>:message</p>') }}
		</p>

		<p>
			{{ Form::label('password', 'Wachtwoord:') }}
			{{ Form::password('password') }}
		</p>

		{{ Form::submit('Aanmelden') }}
	{{ Form::close() }}

@endsection