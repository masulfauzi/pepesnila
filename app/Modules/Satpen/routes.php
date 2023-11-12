<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Satpen\Controllers\SatpenController;

Route::controller(SatpenController::class)->middleware(['web','auth'])->name('satpen.')->group(function(){
	Route::get('/kop_surat', 'kop_surat')->name('kop.index');
	Route::post('/kop_surat', 'simpan_kop_surat')->name('kop.update');
	Route::get('/contoh_surat/{satpen}', 'contoh_surat')->name('contoh_surat.index');
	
	
	
	
	Route::get('/satpen', 'index')->name('index');
	Route::get('/satpen/data', 'data')->name('data.index');
	Route::get('/satpen/create', 'create')->name('create');
	Route::post('/satpen', 'store')->name('store');
	Route::get('/satpen/{satpen}', 'show')->name('show');
	Route::get('/satpen/{satpen}/edit', 'edit')->name('edit');
	Route::patch('/satpen/{satpen}', 'update')->name('update');
	Route::get('/satpen/{satpen}/delete', 'destroy')->name('destroy');
});