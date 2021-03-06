<?php

// Route::get('/', function() {
// 	return view('front');
// })->middleware('guest');
Route::get('/', 'Front\PostController@index');
Route::get('/movies', 'Front\PostController@index');
Route::get('/movie/{post}', 'Front\PostController@show');
Route::get('/video/{video}', 'Front\VideoController@stream');
Route::get('/video/{video}/checkSlug', 'Front\VideoController@checkSlug');
Route::get('/plans', 'StripeController@plans');
Route::get('/settings', 'Front\UserController@index');
Route::get('/settings/card', 'Front\UserController@card');
Route::get('/settings/cancel', 'Front\UserController@cancel');
Route::get('/settings/subscription', 'Front\UserController@changePlan');
Route::get('/settings/invoices', 'Front\UserController@invoices');
Route::post('/settings/account', 'Front\UserController@updateAccount');
Route::post('/post/{post}/updateViews', 'Front\PostController@updateViews');
Route::post('/ppv/{postId}', 'Front\PpvController@store');
Route::post('/user/instance', 'Front\UserController@createInstance');
Route::delete('/user/delete', 'Front\UserController@delete');

Route::prefix('admin')->middleware('admin')->group(function() {
	Route::get('/', 'PostController@index');
	Route::get('/users', 'UserController@index');
	Route::post('/videos/thumbnail/{video}', 'VideoController@thumbnail');
	Route::get('/posts/search', 'PostController@search');
	Route::resource('posts', 'PostController');
	Route::resource('videos', 'VideoController');
	Route::put('/sd/{post}', 'PostController@sd');
	Route::patch('/videos/{video}/preview', 'VideoController@setPreview');
	Route::patch('/videos/{video}/clearPreview', 'VideoController@clearPreview');
	Route::resource('images', 'ImageController');
});

// auth
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('join', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('join', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
