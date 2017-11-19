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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', 'Auth\LoginController@redirectToProvider')->name('login');

Route::get('loginfacebook', 'Auth\LoginController@redirectToProvider');
Route::get('fbcallback', 'Auth\LoginController@handleProviderCallback');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/splash', 'AppSplashController@index')->name('splash');

//Apps
Route::get('/fbapp', 'AppControllers\SampleAppController@index');