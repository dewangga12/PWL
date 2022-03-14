<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ContactUsController;

// Home 
Route::get('/', HomeController::class);

// Products
Route::prefix('category')->group(function (){
    Route::get('/marbel-edu', [CategoryController::class, 'marbeledu']);
    Route::get('/marbel-kids', [CategoryController::class, 'marbelkids']);
    Route::get('/riri-story', [CategoryController::class, 'riristory']);
    Route::get('/kolak-songs', [CategoryController::class, 'kolaksongs']);
});

// News
Route::get('/news/{param?}', NewsController::class);

// Programs
Route::prefix('program')->group(function (){
    Route::get('/karir', [ProgramController::class, 'karir']);
    Route::get('/magang', [ProgramController::class, 'magang']);
    Route::get('/kunjungan', [ProgramController::class, 'kunjungan']);
});

// About Us
Route::get('/about-us', AboutUsController::class);

// Contact Us
Route::resource('/contact-us', ContactUsController::class);