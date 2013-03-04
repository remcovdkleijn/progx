@layout('master')

@section('header')
	@include('header')
@endsection

@section('container')

	@if (Session::has('message'))
		<p>{{ Session::get('message') }}</p>
	@endif

	<p>Dit is de maincontainer<p>

	<a href="{{ URL::to_route('all_producten') }}">Alle producten</a>
	<a href="{{ URL::to_route('all_aanbiedingen') }}">Alle aanbiedingen</a>
	
@endsection

@section('footer')
	@include('footer')
@endsection