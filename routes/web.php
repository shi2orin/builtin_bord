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
Route::group(['middleware' => ['guest']], function () {
    Route::namespace('Auth')->group(function () {
        Route::get('/login', 'LoginController@loginView')->name('loginView');
        Route::post('/login/post', 'LoginController@loginPost')->name('loginPost');
        Route::get('/register', 'RegisterController@registerView')->name('registerView');
        Route::post('/register/post', 'RegisterController@registerPost')->name('registerPost');
        Route::get('/register/confirmed', 'RegisterController@registerConfirmed')->name('registerConfirmed');
    });
});

Route::group(['middleware' => 'auth'], function () {
    Route::namespace('Authenticated')->group(function () {
        Route::get('/top', 'LoginController@top')->name('top.show');
        Route::get('/logout', 'LoginController@logout');
    });
});


// フレームワークの認証機能削除
