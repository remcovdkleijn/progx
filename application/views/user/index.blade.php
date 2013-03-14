@layout('layouts.default')

@section('content')
	<h2>Login</h2>

	{{ $errors->first('password', '<p>:message</p>') }}

	{{ Form::open('login') }}

		{{ Form::token() }}

		{{ Form::label('email', 'E-Mail Address') }}
		{{ Form::text('email', Session::get('form_values')['email']) }}
		{{ $errors->first('email', '<p>:message</p>') }}
		<br />

		{{ Form::label('password', 'Password') }}
		{{ Form::password('password') }}
		<br />

		{{ Form::submit('save') }}
	{{ Form::close() }}

@endsection