@layout('layouts.default')

@section('content')
	<h2>Bedrijfsgegevens van "{{ $bedrijf -> bedrijfsnaam }}"</h2>

	<table>
		<tr>
			<td>KvK #</td>
			<td>{{ $bedrijf -> kvk }}</td>
		</tr>
		<tr>
			<td>Adres</td>
			<td>{{ $bedrijf -> adres }}</td>
		</tr>
		<tr>
			<td>Postcode</td>
			<td>{{ $bedrijf -> postcode }}</td>
		</tr>
		<tr>
			<td>Stad</td>
			<td>{{ $bedrijf -> city }}</td>
		</tr>
		<tr>
			<td>Land</td>
			<td>{{ $bedrijf -> land }}</td>
		</tr>
	</table>
	<br />

	{{ HTML::link_to_route('edit_bedrijf', 'Gegevens aanpassen', $bedrijf -> idbedrijf) }}

@endsection