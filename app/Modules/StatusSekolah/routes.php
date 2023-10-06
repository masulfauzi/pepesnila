<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StatusSekolah\Controllers\StatusSekolahController;

Route::controller(StatusSekolahController::class)->middleware(['web','auth'])->name('statussekolah.')->group(function(){
	Route::get('/statussekolah', 'index')->name('index');
	Route::get('/statussekolah/data', 'data')->name('data.index');
	Route::get('/statussekolah/create', 'create')->name('create');
	Route::post('/statussekolah', 'store')->name('store');
	Route::get('/statussekolah/{statussekolah}', 'show')->name('show');
	Route::get('/statussekolah/{statussekolah}/edit', 'edit')->name('edit');
	Route::patch('/statussekolah/{statussekolah}', 'update')->name('update');
	Route::get('/statussekolah/{statussekolah}/delete', 'destroy')->name('destroy');
});