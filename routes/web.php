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
})->name('home');

Auth::routes();

/* Route::group([
    'as'=>'admin.',
    'prefix'=>'admin',
    'namespace'=>'Admin',
    'middleware'=>['auth', 'admin']], function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    });

Route::group([
    'as'=>'author.',
    'prefix'=>'author',
    'namespace'=>'Author',
    'middleware'=>['auth', 'author']], function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    }); */
    

// this is the newer style in laravel 6
Route::name('admin.')
    ->prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::resource('tag', 'TagController');
    });

Route::name('author.')
    ->prefix('author')
    ->namespace('Author')
    ->middleware(['auth', 'author'])
    ->group(function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    });
