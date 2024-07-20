<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('category',(App\Http\Controllers\CategoryController::class));
Route::resource('spot',(App\Http\Controllers\SpotController::class));

/**
 * Route yang akan mereturn data ctaegories dalam format json dari datatable
 * yang akan kita panggil pada file index.blade.php (category)
 */
Route::get('data-categories',[App\Http\Controllers\CategoryController::class,'getCategories'])->name('data-categories');
