@layout('master')

@section('header')
	@include('header')
@endsection

@section('container')

	<h2>Admin area</h2>

	<p>username = {{$name}}<p>
	
@endsection

@section('footer')
	@include('footer')
@endsection