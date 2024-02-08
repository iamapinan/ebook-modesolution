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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/view/{id}', 'ViewController@index')->name('view');
Route::get('/privacy', 'PublicPageController@privacy')->name('privacy');

Auth::routes(['verify' => true]);
Route::get('/upload', 'UploadController@index')->middleware('verified')->name('upload');
Route::get('/home', 'HomeController@index')->middleware('verified')->name('home');
Route::get('/report', 'HomeController@index')->middleware('verified')->name('report');
Route::get('/banner', 'bannerController@index')->middleware('verified')->name('banner');
Route::get('/robot', 'HomeController@robot')->middleware('verified')->name('robot');
Route::get('/group_files', 'HomeController@group_files')->middleware('verified')->name('group_files');
Route::get('/users', 'UserController@index')->middleware('verified')->name('users');
Route::get('/book', 'bookController@index')->middleware('verified')->name('book');
Route::get('/recommend/{id}', 'bookController@recommend')->middleware('verified')->name('recommend');
Route::get('/un_recommend/{id}', 'bookController@un_recommend')->middleware('verified')->name('un_recommend');
Route::get('/shelf/{id}', 'ShelfController@index')->name('shelf');
Route::get('/books', 'bookController@index')->middleware('verified')->name('books');
Route::get('/profile', 'UserController@profile')->middleware('verified')->name('profile');
Route::get('/search', 'bookController@search')->middleware('verified')->name('search');
Route::get('/delete/{id}', 'bookController@delete')->middleware('verified')->name('delete');
// Route::get('/register', function () {
// 	redirect('/');
// })->name('register');
Route::prefix('login')->group(function () {
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('login.provider');
    Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.provider.callback');
});

// Post request
Route::post('/upload', 'UploadController@upload')->middleware('verified')->name('handleUpload');
Route::post('/banner', 'bannerController@upload')->middleware('verified')->name('upload_banner');
Route::post('/user/{id}', 'UserController@update')->middleware('verified')->name('update_profile');
