<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Ajuan\Controllers\AjuanController;

Route::controller(AjuanController::class)->middleware(['web','auth'])->name('ajuan.')->group(function(){
	// route custom
	Route::get('/ajuan/upload/{ajuan}', 'uploads')->name('upload.index');
	Route::post('/ajuan/{ajuan}/aksi_upload', 'aksi_upload')->name('aksi_upload.store');
	Route::get('/ajuan/admin', 'index_admin')->name('admin.index');
	Route::get('/ajuan_verval', 'ajuan_verval')->name('admin_verval.index');
	Route::get('/ajuan_ditolak', 'ajuan_ditolak')->name('admin_ditolak.index');
	Route::get('/admin/ajuan/{ajuan}', 'detail_ajuan')->name('admin_lihat.show');
	Route::get('/admin/ajuan/{ajuan}/{status}', 'ubah_status_ajuan')->name('admin_ubah_status.show');
	Route::post('/ajuan/tolak/', 'tolak_ajuan')->name('tolak_ajuan.store');

	
	// route bawaan
	Route::get('/ajuan', 'index')->name('index');
	Route::get('/ajuan/data', 'data')->name('data.index');
	Route::get('/ajuan/create', 'create')->name('create');
	Route::post('/ajuan', 'store')->name('store');
	Route::get('/ajuan/{ajuan}', 'show')->name('show');
	Route::get('/ajuan/{ajuan}/edit', 'edit')->name('edit');
	Route::patch('/ajuan/{ajuan}', 'update')->name('update');
	Route::get('/ajuan/{ajuan}/delete', 'destroy')->name('destroy');

	
});