@layout('layouts.default')

@section('content')
	<h2>bedrijfsgegevens</h2>

	@foreach ($bedrijf->attributes as $key => $attribute)
		@if ($key != 'idbedrijf')
			<p>{{$key}} = {{ $attribute }}</p>
		@endif
	@endforeach

	<a href="{{URL::to_route('edit_bedrijf', $bedrijf->idbedrijf)}}">edit</a>

@endsection