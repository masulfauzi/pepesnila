<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StatusAjuan\Controllers\StatusAjuanController;

Route::controller(StatusAjuanController::class)->middleware(['web','auth'])->name('statusajuan.')->group(function(){
	Route::get('/statusajuan', 'index')->name('index');
	Route::get('/statusajuan/data', 'data')->name('data.index');
	Route::get('/statusajuan/create', 'create')->name('create');
	Route::post('/statusajuan', 'store')->name('store');
	Route::get('/statusajuan/{statusajuan}', 'show')->name('show');
	Route::get('/statusajuan/{statusajuan}/edit', 'edit')->name('edit');
	Route::patch('/statusajuan/{statusajuan}', 'update')->name('update');
	Route::get('/statusajuan/{statusajuan}/delete', 'destroy')->name('destroy');
});