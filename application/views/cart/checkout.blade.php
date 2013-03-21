@layout('layouts.default')

@section('content')

<div id="checkout">
	{{ Form::open('cart/checkout', 'POST') }}

	{{ Form::token() }}

	<h2>Eindbedrag</h2>
	<span class="final_amount">€ {{ Cartify::cart() -> total() }}</span>

	<div class="submit">

		{{ Form::submit('Bestelling plaatsen') }}

	</div>

	{{ Form::close() }}

</div>

@endsection