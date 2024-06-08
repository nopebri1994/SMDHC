<?php

use App\Http\Controllers\departemenController;
use App\Http\Controllers\keteranganIjinController;
use App\Http\Controllers\perusahaanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'title' => 'Dashboard'
    ]);
});

//keterangan-ijin
Route::get('/dm/keterangan-ijin', [keteranganIjinController::class, 'index']);
Route::post('/dm/keterangan-ijin/insert', [keteranganIjinController::class, 'insert']);
Route::get('/dm/keterangan-ijin/tabelData', [keteranganIjinController::class, 'tabelData']);
Route::post('/dm/keterangan-ijin/delete', [keteranganIjinController::class, 'delete']);
Route::post('/dm/keterangan-ijin/update', [keteranganIjinController::class, 'update']);


//departemen
Route::get('/dm/departemen', [departemenController::class, 'index']);
Route::get('/dm/departemen/tabelData', [departemenController::class, 'tabelData']);
Route::post('/dm/departemen/insert', [departemenController::class, 'insert']);
Route::post('/dm/departemen/delete', [departemenController::class, 'delete']);
Route::post('/dm/departemen/update', [departemenController::class, 'update']);

//perusahaan
Route::get('/dm/perusahaan', [perusahaanController::class, 'index']);
Route::get('/dm/perusahaan/tabelData', [perusahaanController::class, 'tabelData']);
Route::post('/dm/perusahaan/insert', [perusahaanController::class, 'insert']);
Route::post('/dm/perusahaan/delete', [perusahaanController::class, 'delete']);
Route::post('/dm/perusahaan/update', [perusahaanController::class, 'update']);
