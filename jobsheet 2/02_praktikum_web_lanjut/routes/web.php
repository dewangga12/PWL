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
    'Selamat Datang';
});

Route::get('/about', function () {
    echo 'Dewangga Putra : 2041720222 : TI-2B';
});

Route::get('/article/{id}', function ($id) {
    return 'Ini merupakan laman artikel dengan id ' . $id;
});
