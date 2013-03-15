@layout('layouts.default')

@section('content')
	<h2>Gebruikers</h2>

	@if( ! $users -> results)
		<p>Geen gebruikers gevonden.</p>
	@else
		<ul id="users-list">
			@foreach($users -> results as $user)
				<li>{{ $user -> email }}</li>
			@endforeach
		</ul>

		{{ $users -> links() }}
	@endif
@endsection