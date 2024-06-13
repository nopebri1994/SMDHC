<?php

use App\Http\Controllers\bagianController;
use App\Http\Controllers\departemenController;
use App\Http\Controllers\jabatanController;
use App\Http\Controllers\jamKerjaController;
use App\Http\Controllers\karyawanController;
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
Route::get('/dm/departemen/selectDepartemen', [departemenController::class, 'selectDepartemen']);

//perusahaan
Route::get('/dm/perusahaan', [perusahaanController::class, 'index']);
Route::get('/dm/perusahaan/tabelData', [perusahaanController::class, 'tabelData']);
Route::post('/dm/perusahaan/insert', [perusahaanController::class, 'insert']);
Route::post('/dm/perusahaan/delete', [perusahaanController::class, 'delete']);
Route::post('/dm/perusahaan/update', [perusahaanController::class, 'update']);

//bagian
Route::get('/dm/bagian', [bagianController::class, 'index']);
Route::get('/dm/bagian/tabelData', [bagianController::class, 'tabelData']);
Route::post('/dm/bagian/insert', [bagianController::class, 'insert']);
Route::post('/dm/bagian/delete', [bagianController::class, 'delete']);
Route::post('/dm/bagian/update', [bagianController::class, 'update']);
Route::get('/dm/bagian/selectBagian', [bagianController::class, 'selectBagian']);


//jabatan
Route::get('/dm/jabatan', [jabatanController::class, 'index']);
Route::get('/dm/jabatan/tabelData', [jabatanController::class, 'tabelData']);
Route::post('/dm/jabatan/insert', [jabatanController::class, 'insert']);
Route::post('/dm/jabatan/delete', [jabatanController::class, 'delete']);
Route::post('/dm/jabatan/update', [jabatanController::class, 'update']);
ROute::get('/dm/jabatan/detailJabatan', [jabatanController::class, 'detailJabatan']);

//jam-kerja
Route::get('dm/jam-kerja', [jamKerjaController::class, 'index']);
Route::get('dm/jam-kerja/tabelData', [jamKerjaController::class, 'tabelData']);
Route::post('/dm/jam-kerja/insert', [jamKerjaController::class, 'insert']);
Route::post('/dm/jam-kerja/delete', [jamKerjaController::class, 'delete']);
Route::post('dm/jam-kerja/update', [jamKerjaController::class, 'update']);

//karyawan
Route::get('/dk/karyawan', [karyawanController::class, 'index']);
Route::get('dk/karyawan/addData', [karyawanController::class, 'addData']);
Route::get('dk/karyawan/storeData', [karyawanController::class, 'storeData']);
