<h1>Progx - laravel example</h1>
<nav>
	<ul>
		<li><a href="{{ URL::to_route('index') }}"> Home </a></li>
		@if (Auth::guest())
			<li><a href="{{ URL::to_route('new_user') }}"> Register </a></li>
			<li><a href="{{ URL::to_route('login') }}"> Login </a></li>
		@else
			<li><a href="{{ URL::to_route('admin') }}"> Admin area </a></li>
			<li><a href="{{ URL::to_route('edit_user') }}">Edit account</a></li>
			<li><a href="{{ URL::to_route('logout') }}"> Logout </a></li>
		@endif
	</ul>
<nav>
