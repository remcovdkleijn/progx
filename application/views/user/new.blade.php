@layout('master')

@section('header')
	@include('header')
@endsection

@section('container')
<h2>Registreren</h2>

	{{ Form::open('users') }}
		{{ Form::label('email', 'E-Mail Address') }}
		{{ Form::text('email', Session::get('form_values')['email']) }}
		{{ $errors->first('email', '<p>:message</p>') }}
		<br />

		{{ Form::label('name', 'Naam') }}
		{{ Form::text('name', Session::get('form_values')['name']) }}
		{{ $errors->first('name', '<p>:message</p>') }}
		<br />

		{{ Form::label('password', 'Password') }}
		{{ Form::password('password') }}
		{{ $errors->first('password', '<p>:message</p>') }}
		<br />

		{{ Form::label('password_confirmation', 'Password controller') }}
		{{ Form::password('password_confirmation') }}
		{{ $errors->first('password_confirmation', '<p>:message</p>') }}
		<br />

		{{ Form::submit('save') }}
	{{ Form::close() }}

@endsection

@section('footer')
	@include('footer')
@endsection