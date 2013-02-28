@layout('master')

@section('header')
	@include('header')
@endsection

@section('container')
	<h2>bedrijfsgegevens</h2>

	@if (Session::has('message'))
		<p>{{ Session::get('message') }}</p>
	@endif

	@foreach ($bedrijf->attributes as $key => $attribute)
		@if ($key != 'idbedrijf')
			<p>{{$key}} = {{ $attribute }}</p>
		@endif
	@endforeach

	<a href="{{URL::to_route('edit_bedrijf', $bedrijf->idbedrijf)}}">edit</a>

@endsection

@section('footer')
	@include('footer')
@endsection