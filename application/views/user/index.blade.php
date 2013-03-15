@layout('layouts.default')

@section('content')
	<h2>Gebruikers</h2>

	@if( ! $users -> results)
		<p>Geen gebruikers gevonden.</p>
	@else
		<ul id="users-list">
			@foreach($users -> results as $user)
				<li>{{ $user -> email }} - {{ HTML::link_to_route('edit_user', 'Edit', $user -> iduser) }}</li>
			@endforeach
		</ul>

		{{ $users -> links() }}
	@endif
@endsection