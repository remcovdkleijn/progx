@layout('layouts.default')

@section('content')

<table>
	<thead>
		<tr>
			<th>Product</th>
			<th>Aantal</th>
			<th>Prijs</th>
		</tr>
	</thead>
	<tbody>

		@foreach($regels as $regel)
		<tr>
			<td>{{ HTML::link_to_route('producten', $regel -> product() -> naam, $regel -> product() -> idproduct) }}</td>
			<td>{{ $regel -> qty }}</td>
			<td>€ {{ $regel -> price }}</td>
		</tr>
		@endforeach
	</tbody>
</table>

@endsection