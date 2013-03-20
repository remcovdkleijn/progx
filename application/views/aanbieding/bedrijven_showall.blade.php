@layout('layouts.default')

@section('content')
	<h2>Alle aanbiedingen van bedrijf "{{ $bedrijf -> bedrijfsnaam}}"</h2>

	@if(!$aanbiedingen)
		<p>Er zijn geen aanbiedingen.</p>
	@else
		<table>
			<thead>
				<tr>
					<th>Naam van de actie</th>
					<th>Omschrijving</th>
					<th>Korting</th>
					<th>Actief?</th>
					<th>Producten</th>
					<th></th>
				</tr>
			</thead>

			@foreach ($aanbiedingen as $aanbieding)
			<tr>
				<td>{{ HTML::link_to_route('aanbieding', $aanbieding -> actienaam, $aanbieding -> idaanbieding) }}</td>
				<td>{{ $aanbieding -> omschrijving }}</td>
				<td>{{ $aanbieding -> korting }}</td>
				<td>{{ ($aanbieding -> actief) ? ("Ja") : ("Nee") }}</td>
				<td>
					@if(!$aanbieding -> producten())
					<ul>
						@foreach($aanbieding -> producten() as $product)
							<li>
								<ul>
									<p>{{ HTML::link_to_route('product', $product->naam, $product -> idproduct) }}</p>
									<p>({{ $product -> productcategorie -> categorie }})</p>
									<p>Oude prijs: €{{ $product -> prijs }}</p>
									<p>Nieuwe prijs: €<?php echo round($product->prijs * ((100-$aanbieding->korting)/100), 2); ?></p>
								</ul>
							</li>
						@endforeach
					@else
						<p>Er zijn geen producten</p>
					@endif
					</ul>
				</td>
				<td>
					{{ HTML::link_to_route('edit_aanbieding', 'Aanpassen', $aanbieding -> idaanbieding) }}
					{{ HTML::link_to_route('delete_aanbieding', 'Verwijderen', $aanbieding -> idaanbieding) }}
				</td>
			</tr>
			@endforeach

		</table>
	@endif

@endsection