<?php

Route::get('/', function() {
	return view('front');
});

Route::get('/movies', 'Front\PostController@index');
Route::get('/movie/{post}', 'Front\PostController@show');
Route::get('/video/{video}', 'Front\VideoController@stream');
Route::get('/video/{video}/checkSlug', 'Front\VideoController@checkSlug');
Route::get('/plans', 'StripeController@plans');
Route::get('/settings', 'Front\UserController@index');
Route::post('/post/{post}/updateViews', 'Front\PostController@updateViews');
Route::post('/settings/account', 'Front\UserController@updateAccount');

Route::prefix('admin')->middleware('admin')->group(function() {
	Route::get('/', 'PostController@index');
	Route::post('/videos/thumbnail/{video}', 'VideoController@thumbnail');
	Route::get('/posts/search', 'PostController@search');
	Route::resource('posts', 'PostController');
	Route::resource('videos', 'VideoController');
	Route::patch('/videos/{video}/preview', 'VideoController@setPreview');
	Route::patch('/videos/{video}/clearPreview', 'VideoController@clearPreview');
	Route::resource('images', 'ImageController');
	//
	Route::get('/factory', function() {
		factory('App\Video', 20)->create()->each(function($video) {
			factory('App\Image')->create([
				'post_id' => $video->post->id,
				'is_thumbnail' => 1
			]);
			factory('App\Image')->create(['post_id' => $video->post->id]);
			factory('App\Image')->create(['video_id' => $video->id]);
		});
	});
	//
});

Auth::routes();
