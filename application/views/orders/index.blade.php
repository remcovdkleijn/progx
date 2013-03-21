@layout('layouts.default')

@section('content')

<table>
	<thead>
		<tr>
			<th>Besteldatum</th>
			<th>Totaalprijs</th>
			<th>Tonen</th>
		</tr>
	</thead>
	<tbody>

		@foreach($orders as $order)
		<tr>
			<td>{{ $order -> created_at }}</td>
			<td>€ {{ $order -> totaal_prijs }}</td>
			<td>{{ HTML::link_to_route('show_order', 'Toon bestelling', $order -> id) }}</td>
		</tr>
		@endforeach

	</tbody>
</table>

@endsection