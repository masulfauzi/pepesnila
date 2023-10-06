<?php

use Illuminate\Support\Facades\Route;
use App\Modules\JenisAjuan\Controllers\JenisAjuanController;

Route::controller(JenisAjuanController::class)->middleware(['web','auth'])->name('jenisajuan.')->group(function(){
	Route::get('/jenisajuan', 'index')->name('index');
	Route::get('/jenisajuan/data', 'data')->name('data.index');
	Route::get('/jenisajuan/create', 'create')->name('create');
	Route::post('/jenisajuan', 'store')->name('store');
	Route::get('/jenisajuan/{jenisajuan}', 'show')->name('show');
	Route::get('/jenisajuan/{jenisajuan}/edit', 'edit')->name('edit');
	Route::patch('/jenisajuan/{jenisajuan}', 'update')->name('update');
	Route::get('/jenisajuan/{jenisajuan}/delete', 'destroy')->name('destroy');
});