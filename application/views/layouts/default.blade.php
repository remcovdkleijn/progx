<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>Progx - example</title>
	{{ HTML::style('css/main.css') }}
</head>
<body>

	<header id="header">
		<div class="container">
			{{ HTML::link('/', 'Laravel Test') }}
		</div>
	</header>

	<nav id="main_nav">
		<div class="container">
			<ul>
				<li>{{ HTML::link_to_route('index', 'Home') }}</li>
				@if( ! Auth::check())
				<li>{{ HTML::link_to_route('register_user', 'Registreren') }}</li>
				<li>{{ HTML::link_to_route('login', 'Inloggen') }}</li>
				@else
					<li>{{ HTML::link_to_route('edit_user', 'Mijn profiel', Auth::user() -> iduser) }}</li>
					<li>{{ HTML::link_to_route('logout', 'Uitloggen') }}</li>
					@if (count(Auth::user() -> bedrijven) > 0)
						<li>{{ HTML::link_to_route('bedrijven', 'Mijn bedrijven') }}</li>
					@endif
					@if(Auth::user() -> is_admin)
						<li>{{ HTML::link_to_route('showall_user', 'Gebruikers') }}
					@endif
					<li>{{ HTML::link_to_route('cart', 'Winkelwagen (0)') }}</li>
				@endif
			</ul>
		</div>
	</nav>

	<div class="container">
		<div id="content">
			@if(Session::has('message'))
				<p id="message">{{ Session::get('message') }}</p>
			@endif

			@yield('content')
		</div>

		<footer id="footer">
			&copy; Remco, Niels &amp; Rob - PROGX {{ date('Y') }}
		</footer>
	</div>
</body>
</html>