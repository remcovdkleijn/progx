@layout('master')

@section('header')
	@include('header')
@endsection

@section('container')
	<h2>Registreren Bedrijven</h2>

	{{ Form::open('bedrijf') }}

		{{ Form::label('bedrijfsnaam', 'Bedrijfsnaam') }}
		{{ Form::text('bedrijfsnaam', Session::get('form_values')['bedrijfsnaam']) }}
		{{ $errors->first('bedrijfsnaam', '<p>:message</p>') }}
		<br />

		{{ Form::label('kvk', 'KVK') }}
		{{ Form::text('kvk', Session::get('form_values')['kvk']) }}
		{{ $errors->first('kvk', '<p>:message</p>') }}
		<br />

		{{ Form::label('adres', 'Adres') }}
		{{ Form::text('adres', Session::get('form_values')['adres']) }}
		{{ $errors->first('adres', '<p>:message</p>') }}
		<br />

		{{ Form::label('postcode', 'Postcode') }}
		{{ Form::text('postcode', Session::get('form_values')['postcode']) }}
		{{ $errors->first('postcode', '<p>:message</p>') }}
		<br />

		{{ Form::label('city', 'Stad') }}
		{{ Form::text('city', Session::get('form_values')['city']) }}
		{{ $errors->first('city', '<p>:message</p>') }}
		<br />

		{{ Form::label('land', 'Land') }}
		{{ Form::text('land', Session::get('form_values')['land']) }}
		{{ $errors->first('land', '<p>:message</p>') }}
		<br />

		{{ Form::submit('save') }}
	{{ Form::close() }}

@endsection

@section('footer')
	@include('footer')
@endsection