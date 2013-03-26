@layout('layouts.default')

@section('content')
	<h2>Wijzig bedrijf</h2>

	{{ Form::open('bedrijf/update', 'PUT') }}

		{{ Form::token() }}

		{{ Form::hidden('bedrijf_id', $bedrijf -> idbedrijf) }}

		{{ Form::label('bedrijfsnaam', 'Bedrijfsnaam') }}
		@if(Session::has('form_values'))
			{{ Form::text('bedrijfsnaam', Input::old('bedrijfsnaam')) }}
		@else
			{{ Form::text('bedrijfsnaam', $bedrijf->bedrijfsnaam) }}
		@endif
		{{ $errors->first('bedrijfsnaam', '<p>:message</p>') }}
		<br />

		{{ Form::label('kvk', 'KVK') }}
		@if(Session::has('form_values'))
			{{ Form::text('kvk', Input::old('kvk')) }}
		@else
			{{ Form::text('kvk', $bedrijf->kvk) }}
		@endif
		{{ $errors->first('kvk', '<p>:message</p>') }}
		<br />

		{{ Form::label('adres', 'Adres') }}
		@if(Session::has('form_values'))
			{{ Form::text('adres', Input::old('adres')) }}
		@else
			{{ Form::text('adres', $bedrijf->adres) }}
		@endif
		{{ $errors->first('adres', '<p>:message</p>') }}
		<br />

		{{ Form::label('postcode', 'Postcode') }}
		@if(Session::has('form_values'))
			{{ Form::text('postcode', Input::old('postcode')) }}
		@else
			{{ Form::text('postcode', $bedrijf->postcode) }}
		@endif
		{{ $errors->first('postcode', '<p>:message</p>') }}
		<br />

		{{ Form::label('city', 'Stad') }}
		@if(Session::has('form_values'))
			{{ Form::text('city', Input::old('city')) }}
		@else
			{{ Form::text('city', $bedrijf->city) }}
		@endif
		{{ $errors->first('city', '<p>:message</p>') }}
		<br />

		{{ Form::label('land', 'Land') }}
		@if(Session::has('form_values'))
			{{ Form::text('land', Input::old('land')) }}
		@else
			{{ Form::text('land', $bedrijf->land) }}
		@endif
		{{ $errors->first('land', '<p>:message</p>') }}
		<br />

		{{ Form::submit('Gegevens wijzigen') }}
	{{ Form::close() }}

@endsection