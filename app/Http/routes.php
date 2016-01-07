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
Route::get('/', 'WelcomeController@index');

//Route to the posts
Route::get('posts', "PostsController@index");
Route::get('post/create', "PostsController@create");
Route::get('post/{id}', ['as' => 'postEdit', 'uses' => 'PostsController@show']); //named to route for redirects in controller
Route::post('post', 'PostsController@store');

//Route to the comments per post
Route::get('post/{id}/comment', ['as' => 'addCommentRoute', 'uses' => "CommentsController@index"]); //pokaji formata
Route::post('post/{id}/comment', "CommentsController@store"); //submitni formata
Route::get('post/{id}/comment/{comment_parent_id}', ['as' => 'addChildCommentRoute', 'uses' => "CommentsController@index"]);
Route::post('post/{id}/comment/{comment_parent_id}', "CommentsController@childStore");

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');