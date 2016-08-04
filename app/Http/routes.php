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

// Page routes
Route::get('/', 'PagesController@home');
Route::get('categories/{slug}', 'PagesController@category');
Route::get('products/{slug}', 'PagesController@product');
Route::get('/cart', 'PagesController@cart');
Route::get('/checkout', 'PagesController@checkout');
Route::post('/checkout', 'CheckoutController@doCheckout');

Route::post('/contact', 'ContactFormController@handleMessage');

Route::get('api/products/{product}/images', 'ProductImagesController@index');

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

//Shopping cart routes
Route::get('cart/index', 'ShoppingCartController@index');
Route::get('cart/summary', 'ShoppingCartController@summary');
Route::post('cart/add', 'ShoppingCartController@add');
Route::patch('cart/update', 'ShoppingCartController@update');
Route::delete('cart/remove', 'ShoppingCartController@remove');

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

        Route::get('categories', 'CategoriesController@index');
        Route::get('categories/{category}', 'CategoriesController@show');
        Route::post('categories', 'CategoriesController@store');
        Route::get('categories/{category}/edit', 'CategoriesController@edit');
        Route::post('categories/{category}', 'CategoriesController@update');
        Route::delete('categories/{category}', 'CategoriesController@delete');

        Route::post('categories/{category}/images', 'CategoryImagesController@store');

        Route::get('products', 'ProductsSearchController@index');
        Route::get('products/app', 'ProductsSearchController@showApp');

        Route::get('products/{product}', 'ProductsController@show');
        Route::post('categories/{category}/products', 'ProductsController@store');
        Route::get('products/{product}/edit', 'ProductsController@edit');
        Route::post('products/{product}', 'ProductsController@update');
        Route::delete('products/{product}', 'ProductsController@delete');

        Route::post('products/{product}/images', 'ProductImagesController@store');
        Route::post('products/{product}/availability', 'ProductsController@setAvailability');
        Route::post('products/{product}/promote', 'ProductsController@setPromoted');

        Route::get('products/{product}/gallery', 'ProductGalleriesController@showGalleryPage');
        Route::get('products/{product}/gallery/images', 'ProductGalleriesController@index');
        Route::post('products/{product}/gallery/images', 'ProductGalleriesController@store');

        Route::delete('products/galleries/images/{media}', 'ProductGalleriesController@deleteImage');

        Route::get('orders', 'OrdersController@index');
        Route::get('orders/archived', 'OrdersController@archivesIndex');
        Route::get('orders/{order}', 'OrdersController@show');
        Route::delete('orders/{order}', 'OrdersController@delete');
        Route::post('orders/{order}/archive', 'OrdersController@current');
    });

});

