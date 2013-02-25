<?php

Route::get('/', array('as' => 'index', 'uses' => 'home@index'));

// user Resource
Route::get('login', array('as' => 'login', 'uses' => 'users@index')); // form login
Route::get('users/(:any)', array('as' => 'user', 'uses' => 'users@show')); // profile not niet gemaakt
Route::get('users/new', array('as' => 'new_user', 'uses' => 'users@new')); // form register
Route::get('users/edit', array('as' => 'edit_user', 'uses' => 'users@edit')); // form edit
Route::post('users', 'users@create'); // POST register
Route::put('users/edit', 'users@update'); // POST/PUT update
Route::delete('users/(:any)', 'users@destroy'); // niet gerbuikt
Route::post('login', array('as' => 'login_post', 'uses' => 'users@login')); // POST login
Route::get('logout', array('as' => 'logout', 'before' => 'auth', 'uses' => 'users@logout')); // lohout

Route::get('admin', array('as' => 'admin', 'before' => 'auth', function(){
	$user = Auth::user();
	return View::make('home.admin', array('name' => $user->name));
}));

// Route::get('/', function(){

// 	// $user = User::find(1);
// 	// $user->password = Hash::make('lollol');
// 	// $user->save();

// 	$credentials = array(
// 		'username' => 'remcovdkleijn@gmail.com', //Input::get('email')
// 		'password' => 'lollol' //Input::get('password')
// 	);

// 	if(Auth::attempt($credentials)){
// 		return Redirect::to('admin');
// 	}

// 	return 'no account';
// });

// Route::get('login', function(){
// 	return 'login the user with a form';
// });

// Route::get('logout', function(){
// 	Auth::logout();
// 	//redisrect to login form
// 	return 'logged out';
// });



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