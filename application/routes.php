<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::get('board/(:any)', array(
	'as' => 'board',
	'uses' => 'board@index'
));

Route::post('post', array(
	'uses' => 'post@index'
));

Route::get('manage', array(
	'as' => 'manage',
	'uses' => 'manage@index'
));

Route::get('manage/login', array(
	'as' => 'login',
	'uses' => 'manage@login'
));

Route::post('manage/login', array(
	'uses' => 'manage@login'
));

Route::get('/(:any)', function($board) {
	return Redirect::to_route('board', array($board));
});

/* admin routes */

Route::group(array('before' => 'auth'), function() {
	Route::get('manage/logout', array(
		'as' => 'logout',
		'uses' => 'manage@logout'
	));
});



/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
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


/*
|--------------------------------------------------------------------------
| Assets
|--------------------------------------------------------------------------
*/

View::composer('manage/index', function($view)
{
	Asset::add('manage-css','css/manage.css');
});

View::composer('base', function($view)
{
	Asset::add('jquery','js/vendor/jquery.min.js');
	Asset::add('main-js','js/main.js');

	Asset::add('bootstrap','css/vendor/bootstrap.min.css');
	// Asset::add('bootstrap-responsive','css/vendor/bootstrap-responsive.min.css');
	Asset::add('main-css','css/main.css');
});

