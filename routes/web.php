<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('posts', 'PostController@index')->name('posts.index');
Route::get('posts/create', 'PostController@create')->name('posts.create');
Route::post('posts/create', 'PostController@store')->name('posts.store');
Route::get('posts/{post:slug}/edit', 'PostController@edit')->name('posts.edit');
Route::put('posts/{post:slug}/edit', 'PostController@update')->name('posts.update');
Route::delete('posts/{post:slug}/delete', 'PostController@destroy')->name('posts.delete');
Route::get('posts/{post:slug}', 'PostController@show')->name('post.show');

Route::get('categories/{category:slug}', 'CategoryController@show')->name('categories.show');

Route::get('tags/{tag:slug}', 'TagController@show')->name('tags.show');

Route::get('search/posts', 'SearchController@posts')->name('search.posts');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
