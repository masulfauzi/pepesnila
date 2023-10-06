<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Alumni\Controllers\AlumniController;

Route::controller(AlumniController::class)->middleware(['web','auth'])->name('alumni.')->group(function(){
	// route custom
	Route::get('/alumni/{alumni}/upload', 'upload')->name('upload.index');
	Route::post('/alumni/{alumni}/aksi_upload', 'aksi_upload')->name('aksi_upload.store');



	Route::get('/alumni', 'index')->name('index');
	Route::get('/alumni/data', 'data')->name('data.index');
	Route::get('/alumni/create', 'create')->name('create');
	Route::post('/alumni', 'store')->name('store');
	Route::get('/alumni/{alumni}', 'show')->name('show');
	Route::get('/alumni/{alumni}/edit', 'edit')->name('edit');
	Route::patch('/alumni/{alumni}', 'update')->name('update');
	Route::get('/alumni/{alumni}/delete', 'destroy')->name('destroy');
});