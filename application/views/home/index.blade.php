@layout('layouts.default')

@section('content')

	<p>Dit is de maincontainer<p>

	<a href="{{ URL::to_route('all_producten') }}">Alle producten</a>
	<a href="{{ URL::to_route('all_aanbiedingen') }}">Alle aanbiedingen</a>

@endsection