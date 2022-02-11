<?php

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

Route::get('/', 'ImageController@album')->name('album');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/album', 'ImageController@index');
Route::post('/album', 'ImageController@store')->name('album.store');
Route::get('/albums/{id}', 'ImageController@show');
Route::post('/albums/delete', 'ImageController@destroy')->name('image.delete');

Route::post('/album/image', 'ImageController@addimage')->name('album.addimage');

Route::post('/album/cover/image', 'ImageController@addcoverimage')->name('add.cover');

/*IMAGE RESIZE*/
Route::get('/upload','ImageController@upload');
Route::post('/upload','ImageController@postUpload')->name('upload');
/*....*/