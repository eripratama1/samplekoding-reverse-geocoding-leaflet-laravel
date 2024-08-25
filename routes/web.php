<?php

use Illuminate\Support\Facades\Route;

/** Ganti view untuk halaman index dengan file home.blade */
Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * Route baru untuk kategori dan detailSpot
 */
Route::get('/categories', [App\Http\Controllers\HomeController::class, 'categories'])->name('categories');
Route::get('/category/{slug}', [App\Http\Controllers\HomeController::class, 'categorySpot'])->name('categorySpot');
Route::get('/detail-spot/{slug}', [App\Http\Controllers\HomeController::class, 'detailSpot'])->name('detailSpot');

Route::resource('category',(App\Http\Controllers\CategoryController::class));
Route::resource('spot',(App\Http\Controllers\SpotController::class));

/**
 * Route yang akan mereturn data categories dalam format json dari datatable
 * yang akan kita panggil pada file index.blade.php (category)
 */
Route::get('data-categories',[App\Http\Controllers\CategoryController::class,'getCategories'])->name('data-categories');
Route::get('data-spots',[App\Http\Controllers\SpotController::class,'getSpots'])->name('data-spots');
