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

Route::get('/', 'HomeController@index')->name('home');

Route::post('subscriber', 'SubscriberController@store')->name('subscriber.store');

Route::get('post/{slug}', 'PostController@details')->name('post.details');
Route::get('posts', 'PostController@index')->name('post.index');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::post('favorite/{post}/add', 'FavoriteController@add')->name('post.favorite');

    Route::post('comment/{post}', 'CommentController@store')->name('comment.store');
});
    
Route::name('admin.')
    ->prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        Route::get('settings', 'SettingsController@index')->name('settings');
        Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
        Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');

        Route::resource('tag', 'TagController');
        Route::resource('category', 'CategoryController');
        Route::resource('post', 'PostController');

        Route::get('pending/post', 'PostController@pending')->name('post.pending');
        Route::put('post/{id}/approve', 'PostController@approve')->name('post.approve');

        Route::get('subscriber', 'SubscriberController@index')->name('subscriber.index');
        Route::delete('subscriber/{id}', 'SubscriberController@destroy')->name('subscriber.destroy');
        
        Route::get('favorite', 'FavoriteController@index')->name('favorite.index');
    });

Route::name('author.')
    ->prefix('author')
    ->namespace('Author')
    ->middleware(['auth', 'author'])
    ->group(function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        Route::get('settings', 'SettingsController@index')->name('settings');
        Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
        Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');

        Route::resource('post', 'PostController');

        Route::get('favorite', 'FavoriteController@index')->name('favorite.index');
    });
