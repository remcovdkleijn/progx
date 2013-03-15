@layout('layouts.default')

@section('content')
	<h2>Edit bedrijf</h2>

	{{ Form::open('bedrijf/update', 'PUT') }}

		{{ Form::token() }}

		{{ Form::hidden('bedrijf_id', $bedrijf -> idbedrijf) }}

		{{ Form::label('bedrijfsnaam', 'Bedrijfsnaam') }}
		@if(Session::has('form_values'))
			{{ Form::text('bedrijfsnaam', Session::get('form_values')['bedrijfsnaam']) }}
		@else
			{{ Form::text('bedrijfsnaam', $bedrijf->bedrijfsnaam) }}
		@endif
		{{ $errors->first('bedrijfsnaam', '<p>:message</p>') }}
		<br />

		{{ Form::label('kvk', 'KVK') }}
		@if(Session::has('form_values'))
			{{ Form::text('kvk', Session::get('form_values')['kvk']) }}
		@else
			{{ Form::text('kvk', $bedrijf->kvk) }}
		@endif
		{{ $errors->first('kvk', '<p>:message</p>') }}
		<br />

		{{ Form::label('adres', 'Adres') }}
		@if(Session::has('form_values'))
			{{ Form::text('adres', Session::get('form_values')['adres']) }}
		@else
			{{ Form::text('adres', $bedrijf->adres) }}
		@endif
		{{ $errors->first('adres', '<p>:message</p>') }}
		<br />

		{{ Form::label('postcode', 'Postcode') }}
		@if(Session::has('form_values'))
			{{ Form::text('postcode', Session::get('form_values')['postcode']) }}
		@else
			{{ Form::text('postcode', $bedrijf->postcode) }}
		@endif
		{{ $errors->first('postcode', '<p>:message</p>') }}
		<br />

		{{ Form::label('city', 'Stad') }}
		@if(Session::has('form_values'))
			{{ Form::text('city', Session::get('form_values')['city']) }}
		@else
			{{ Form::text('city', $bedrijf->city) }}
		@endif
		{{ $errors->first('city', '<p>:message</p>') }}
		<br />

		{{ Form::label('land', 'Land') }}
		@if(Session::has('form_values'))
			{{ Form::text('land', Session::get('form_values')['land']) }}
		@else
			{{ Form::text('land', $bedrijf->land) }}
		@endif
		{{ $errors->first('land', '<p>:message</p>') }}
		<br />

		{{ Form::submit('save') }}
	{{ Form::close() }}

@endsection