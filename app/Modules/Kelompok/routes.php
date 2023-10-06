<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Kelompok\Controllers\KelompokController;

Route::controller(KelompokController::class)->middleware(['web','auth'])->name('kelompok.')->group(function(){
	Route::get('/kelompok', 'index')->name('index');
	Route::get('/kelompok/data', 'data')->name('data.index');
	Route::get('/kelompok/create', 'create')->name('create');
	Route::post('/kelompok', 'store')->name('store');
	Route::get('/kelompok/{kelompok}', 'show')->name('show');
	Route::get('/kelompok/{kelompok}/edit', 'edit')->name('edit');
	Route::patch('/kelompok/{kelompok}', 'update')->name('update');
	Route::get('/kelompok/{kelompok}/delete', 'destroy')->name('destroy');
});