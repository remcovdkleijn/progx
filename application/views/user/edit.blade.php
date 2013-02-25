@layout('master')

@section('header')
	@include('header')
@endsection

@section('container')
<h2>Registreren</h2>

	@if (Session::has('message'))
		<p>{{ Session::get('message') }}</p>
	@endif

	{{ Form::open('users/edit', 'PUT') }}

		<p> Your email address: {{ $userdata->email }} </p>

		{{ Form::label('name', 'Naam') }}
		@if(Session::has('form_values'))
			{{ Form::text('name', Session::get('form_values')['name']) }}
		@else
			{{ Form::text('name', $name) }}
		@endif
		{{ $errors->first('name', '<p>:message</p>') }}
		<br />

		{{ Form::submit('save') }}
	{{ Form::close() }}

@endsection

@section('footer')
	@include('footer')
@endsection