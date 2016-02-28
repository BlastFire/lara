<?php

// Route::get('/', function () {
//     return view('grizmin.index');
// });

// Route::get('articles', 'ArticlesController@index');
// Route::get('articles/create', 'ArticlesController@create');
// Route::get('articles/{id}', 'ArticlesController@show');
// Route::post('articles', 'ArticlesController@store');

//tutorial1 from laracast
//Route::resource('articles', 'ArticlesController');

//Main route
Route:get('/', function() {
	return Redirect::to('posts');	
});

//Route to the posts
Route::get('posts', "PostsController@index");
Route::get('post/create', ['middleware' => 'auth', 'uses' => 'PostsController@create']);
Route::get('post/{id}', ['as' => 'postEdit', 'uses' => 'PostsController@show']); //named to route for redirects in controller
Route::post('post', ['middleware' => 'auth', 'uses' => 'PostsController@store']);

//Route to the comments per post
Route::get('post/{id}/comment', ['middleware' => 'auth', 'as' => 'addCommentRoute', 'uses' => "CommentsController@index"]); //pokaji formata
Route::post('post/{id}/comment', ['middleware' => 'auth', 'uses' => 'CommentsController@store']); //submitni formata
Route::get('post/{id}/comment/{comment_parent_id}', ['middleware' => 'auth', 'as' => 'addChildCommentRoute', 'uses' => 'CommentsController@index']);
Route::post('post/{id}/comment/{comment_parent_id}', ['middleware' => 'auth', 'uses' => 'CommentsController@childStore']);

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//Admin
Route::get('admin', function() {
	return "TO CREATE";
});

//Ajax api for post voting
Route::get('post_counter/{post_id}/{increment}', 'ApiController@manipulatePostCounter');

//Testing api
Route::get('testview', 'CrownController@testview');
