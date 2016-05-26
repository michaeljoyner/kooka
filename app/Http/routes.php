<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes...
Route::get('admin/login', 'Auth\AuthController@showLoginForm');
Route::post('admin/login', 'Auth\AuthController@login');
Route::get('admin/logout', 'Auth\AuthController@logout');

// Registration Routes...
Route::post('admin/users/register', 'Auth\AuthController@register');

// Password Reset Routes...
Route::get('admin/password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('admin/password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('admin/password/reset', 'Auth\PasswordController@reset');

Route::get('admin/users/password/reset', 'Auth\PasswordController@showLoggedInUserPasswordReset');
Route::post('admin/users/password/reset', 'Auth\PasswordController@loggedInUserReset');


Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', 'PagesController@dashboard');

        Route::get('users', 'UsersController@index');
        Route::get('users/{user}/edit', 'UsersController@edit');
        Route::post('users/{user}', 'UsersController@update');
        Route::delete('users/{user}', 'UsersController@delete');

        Route::get('blog/posts', 'BlogPostsController@index');
        Route::get('blog/posts/create', 'BlogPostsController@create');
        Route::post('blog/posts', 'BlogPostsController@store');
        Route::get('blog/posts/{post}/edit', 'BlogPostsController@edit');
        Route::post('blog/posts/{post}', 'BlogPostsController@update');
        Route::delete('blog/posts/{post}', 'BlogPostsController@delete');

        Route::post('blog/posts/{post}/images', 'BlogPostImagesController@store');
        Route::post('blog/posts/{post}/publish', 'BlogPostsController@publish');
    });

});

