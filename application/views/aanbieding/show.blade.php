@layout('layouts.default')

@section('content')
	<h2>Aanbieding</h2>

	<table>
		<tr>
			<td>Actienaam:</td>
			<td>{{ $aanbieding -> actienaam }}</td>
		</tr>
		<tr>
			<td>Omschrijving:</td>
			<td>{{ $aanbieding->omschrijving }}</td>
		</tr>
		<tr>
			<td>Korting:</td>
			<td>{{ $aanbieding->korting }}</td>
		</tr>
		<tr>
			<td>Producten:</td>
			<td>
				<ul>

					@forelse($aanbieding->producten as $product)
						<li>
							<ul>
								<p>Naam = <a href="{{ URL::to_route('product', $product->idproduct) }}">{{ $product->naam }}</a> </p>
								<p>Categerie = {{ $product->productcategorie->categorie }}</p>
								<p>Prijs oud = €{{ $product->prijs }} </p>
								<p>Prijs new = €{{ $product->prijs * ((100-$aanbieding->korting)/100) }}</p>
							</ul>
						</li>
					@empty
						<p>Deze aanbieding bevat geen producten.</p>
					@endforelse

				</ul>
			</td>
		</tr>
	</table>

	@if(in_array($aanbieding -> bedrijf, Auth::user() -> bedrijven))
		{{ HTML::link_to_route('edit_aanbieding', 'Aanpassen', $aanbieding -> idaanbieding) }}
		{{ HTML::link_to_route('del_aanbieding', 'Verwijderen', $aanbieding -> idaanbieding) }}
	@endif

@endsection