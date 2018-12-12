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

Auth::routes();

Route::get('/', 'TimelineController@index')->name('timeline');
Route::post('/build', 'TimelineController@store')->name('storeRelease');
Route::get('/build/{build}/{platform?}', 'TimelineController@show')->name('showRelease');


Route::get('/changelog', 'ChangelogController@index')->name('showChangelogs');
Route::get('/changelog/new', 'ChangelogController@create')->name('createChangelogs');
Route::post('/changelog', 'ChangelogController@store')->name('storeChangelogs');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/viv', 'PreviewController@index')->name('viv');

Route::get('/profile', 'ProfileController@index')->name('profile');
