<?php

use Illuminate\Support\Facades\Route;
// INCLUDO L'OGGETTO DI  CLASSE AUTH
use Illuminate\Support\Facades\Auth;

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
// ROTTE PUBBLICHE
Route::get('/', 'WelcomeController@index')->name('homePagePublic');
Route::get('show{slug}', 'WelcomeController@show')->name('showPagePublic');


// ROTTE SOTTO AUTENTICAZIONE
Auth::routes();

// CREO GRUPPO DI ROTTE PROTETTE DA AUTENTICAZIONE
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function() {
        Route::resource('posts', 'PostController');

    }
);
