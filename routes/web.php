<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('site.layouts');
});

Auth::routes();

// frontend 
Route::get('/get-active-top-categories', 'Admin\CategoryController@activeTopCategory');
Route::get('/get-all-posts', 'Admin\PostController@getAllPost');
Route::get('/get-post/{slug}', 'Admin\PostController@getPost');
Route::get('/get-post-by-category/{slug}', 'Admin\PostController@getCategoryPost');

Route::middleware(['auth'])->group(function () {
Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/{anypath}', 'HomeController@index')->where('path','.*');
// category 
Route::post('/add-Category', 'Admin\CategoryController@store');
Route::get('/get-categories', 'Admin\CategoryController@index');
Route::get('/remove-category/{id}', 'Admin\CategoryController@destroy');
Route::get('/category-edit/{id}', 'Admin\CategoryController@edit');
Route::post('/category-update', 'Admin\CategoryController@update');
Route::post('/category/remove-items', 'Admin\CategoryController@removeItems');
Route::post('/category/change-status', 'Admin\CategoryController@changeStatus');
Route::get('/get-active-categories', 'Admin\CategoryController@activeCategory');


// post 
Route::post('/add-post', 'Admin\PostController@store');
Route::get('/get-posts', 'Admin\PostController@index');
Route::get('/remove-post/{id}', 'Admin\PostController@destroy');
Route::get('/post-edit/{id}', 'Admin\PostController@edit');
Route::post('/post-update', 'Admin\PostController@update');
Route::post('/post/remove-items', 'Admin\PostController@removeItems');
Route::post('/post/change-status', 'Admin\PostController@changeStatus');
});

