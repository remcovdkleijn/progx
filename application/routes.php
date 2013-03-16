<?php


//Home route
Route::get('/', array('as' => 'index', 'uses' => 'home@index'));

// user Resource
Route::get('login', 											array('as' => 'login', 						'uses' => 'users@login'																						));		// form login
Route::get('logout', 											array('as' => 'logout', 					'uses' => 'users@logout'																					)); 	// logout
Route::get('register', 										array('as' => 'register_user',		'uses' => 'users@new'																							));		// form register
Route::get('user/(:num)', 								array('as' => 'show_user',				'uses' => 'users@show'																						));		// eventueel profile pagina ~
Route::get('user/(:num)/edit', 						array('as' => 'edit_user', 				'uses' => 'users@edit'																						));		// form edit
Route::get('user/all', 										array('as' => 'showall_user', 		'uses' => 'users@index'																						));
Route::post('login', 											array('as' => 'login_post', 			'uses' => 'users@login', 					'before' => 'csrf'							));		// POST login
Route::post('register', 									array('as' => 'register_user', 		'uses' => 'users@create', 				'before' => 'csrf'							));		// POST register
Route::put('user/update', 								array( 														'uses' => 'users@update', 				'before' => 'csrf'							)); 	// POST/PUT update
Route::delete('user/(:num)', 							array(														'uses' => 'users@destroy'																					)); 	// niet gebruikt ~

// bedrijf Resource
Route::get('bedrijf', 										array('as' => 'bedrijven', 				'uses' => 'bedrijven@index',			'before' => 'auth_bedrijf'			));		// show alle bedrijven van user
Route::get('bedrijf/new', 								array('as' => 'new_bedrijf', 			'uses' => 'bedrijven@new'																					)); 	// form new bedrijf
Route::get('bedrijf/(:num)', 							array('as' => 'bedrijf', 					'uses' => 'bedrijven@show', 			'before' => 'auth_bedrijf'			)); 	// show 1 bedrijf
Route::get('bedrijf/(:num)/edit', 				array('as' => 'edit_bedrijf', 		'uses' => 'bedrijven@edit', 			'before' => 'auth_bedrijf'			)); 	// form edit
Route::get('bedrijf/(:num)/ontkoppel', 		array('as' => 'ontkoppelbedrijf',	'uses' => 'bedrijven@ontkoppel', 	'before' => 'auth_bedrijf'			)); 	// ontkoppelen bedrijf van user
Route::post('bedrijf/create', 						array(														'uses' => 'bedrijven@create',			'before' => 'csrf|auth_bedrijf'	)); 	// POST register
Route::put('bedrijf/update', 							array(														'uses' => 'bedrijven@update', 		'before' => 'csrf|auth_bedrijf'	)); 	// POST/PUT update

// product Resource
Route::get('producten', 									array('as' => 'all_producten', 		'uses' => 'producten@index'																				));
Route::get('producten/new', 							array('as' => 'new_product', 			'uses' => 'producten@new', 				'before' => 'auth_bedrijf'			));		// any = idbedrijf
Route::get('producten/(:num)', 						array('as' => 'product', 					'uses' => 'producten@show', 			'before' => 'auth_bedrijf'			)); 	// any = idbedrijf
Route::get('producten/(:num)/edit', 			array('as' => 'edit_product', 		'uses' => 'producten@edit', 			'before' => 'auth_bedrijf'			));		// any = idproduct
Route::get('producten/(:num)/delete', 		array('as' => 'del_product', 			'uses' => 'producten@destroy', 		'before' => 'auth_bedrijf'			));		// any = idproduct
Route::post('producten/create', 					array(														'uses' => 'producten@create', 		'before' => 'csrf|auth_bedrijf'	));
Route::put('producten/update', 						array(														'uses' => 'producten@update', 		'before' => 'csrf|auth_bedrijf'	));		// any = idproduct

// aanbiedingen Resource
Route::get('aanbiedingen', 								array('as' => 'all_aanbiedingen', 'uses' => 'aanbiedingen@index'																		));		// alle aanbiedingen
Route::get('aanbiedingen/new', 						array('as' => 'new_aanbieding', 	'uses' => 'aanbiedingen@new', 		'before' => 'auth_bedrijf'			));		// any = idbedrijf; form new aanbieding
Route::get('aanbiedingen/(:num)', 				array('as' => 'aanbieding', 			'uses' => 'aanbiedingen@show'																			));		// 1 aanbieding
Route::get('aanbiedingen/(:num)/edit', 		array('as' => 'edit_aanbieding', 	'uses' => 'aanbiedingen@edit', 		'before' => 'auth_bedrijf'			));		// any = idaanbieding; edit form
Route::get('aanbiedingen/(:num)/delete', 	array('as' => 'del_aanbieding', 	'uses' => 'aanbiedingen@destroy',	'before' => 'auth_bedrijf'			));
Route::post('aanbiedingen/create', 				array(														'uses' => 'aanbiedingen@create', 	'before' => 'csrf|auth_bedrijf'	));
Route::put('aanbiedingen/update', 				array(														'uses' => 'aanbiedingen@update', 	'before' => 'csrf|auth_bedrijf'	));		// any = idaanbieding; put/post update


/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Route::get('/', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});

Route::filter('auth_admin', function()
{
	if ( ! Auth::user() -> is_admin) return Redirect::to('index');
});

Route::filter('auth_bedrijf', function()
{
	if ( ! ( Auth::check() || Auth::user() -> bedrijven)) {
		return Redirect::to_route('index');
	}
});