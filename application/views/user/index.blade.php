@layout('master')

@section('header')
	@include('header')
@endsection

@section('container')
	<h2>Login</h2>

	@if (Session::has('loginfail'))
		<p> email and password combination is not correct </p>
	@else

		{{ Form::open('login') }}
			{{ Form::label('email', 'E-Mail Address') }}
			{{ Form::text('email', Session::get('form_values')['email']) }}
			{{ $errors->first('email', '<p>:message</p>') }}
			<br />

			{{ Form::label('password', 'Password') }}
			{{ Form::password('password') }}
			{{ $errors->first('password', '<p>:message</p>') }}
			<br />

			{{ Form::submit('save') }}
		{{ Form::close() }}

	@endif

@endsection

@section('footer')
	@include('footer')
@endsection