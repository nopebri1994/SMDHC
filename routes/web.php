<?php

use App\Http\Controllers\absensiController;
use App\Http\Controllers\absensiHarianController;
use App\Http\Controllers\bagianController;
use App\Http\Controllers\cutiController;
use App\Http\Controllers\departemenController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\hutangCutiController;
use App\Http\Controllers\jabatanController;
use App\Http\Controllers\jamKerjaController;
use App\Http\Controllers\karyawanController;
use App\Http\Controllers\keteranganIjinController;
use App\Http\Controllers\liburController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\mesinAbsensiController;
use App\Http\Controllers\perusahaanController;
use App\Http\Controllers\potonganController;
use App\Http\Controllers\usersController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home', [
//         'title' => 'Dashboard'
//     ]);
// });


//login
Route::get('/login', [loginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login/prosesLogin', [loginController::class, 'login']);
Route::get('/login/logout', [loginController::class, 'logout']);

Route::middleware('auth')->group(function () {

    //home
    Route::get('/', [homeController::class, 'index']);

    //keterangan-ijin
    Route::get('/dm/keterangan-ijin', [keteranganIjinController::class, 'index'])->middleware('can:hc');
    Route::post('/dm/keterangan-ijin/insert', [keteranganIjinController::class, 'insert']);
    Route::get('/dm/keterangan-ijin/tabelData', [keteranganIjinController::class, 'tabelData']);
    Route::post('/dm/keterangan-ijin/delete', [keteranganIjinController::class, 'delete']);
    Route::post('/dm/keterangan-ijin/update', [keteranganIjinController::class, 'update']);

    //departemen
    Route::get('/dm/departemen', [departemenController::class, 'index'])->middleware('can:hc');
    Route::get('/dm/departemen/tabelData', [departemenController::class, 'tabelData']);
    Route::post('/dm/departemen/insert', [departemenController::class, 'insert']);
    Route::post('/dm/departemen/delete', [departemenController::class, 'delete']);
    Route::post('/dm/departemen/update', [departemenController::class, 'update']);
    Route::get('/dm/departemen/selectDepartemen', [departemenController::class, 'selectDepartemen']);

    //perusahaan
    Route::get('/dm/perusahaan', [perusahaanController::class, 'index'])->middleware('can:hc');
    Route::get('/dm/perusahaan/tabelData', [perusahaanController::class, 'tabelData']);
    Route::post('/dm/perusahaan/insert', [perusahaanController::class, 'insert']);
    Route::post('/dm/perusahaan/delete', [perusahaanController::class, 'delete']);
    Route::post('/dm/perusahaan/update', [perusahaanController::class, 'update']);

    //bagian
    Route::get('/dm/bagian', [bagianController::class, 'index'])->middleware('can:hc');
    Route::get('/dm/bagian/tabelData', [bagianController::class, 'tabelData']);
    Route::post('/dm/bagian/insert', [bagianController::class, 'insert']);
    Route::post('/dm/bagian/delete', [bagianController::class, 'delete']);
    Route::post('/dm/bagian/update', [bagianController::class, 'update']);
    Route::get('/dm/bagian/selectBagian', [bagianController::class, 'selectBagian']);


    //jabatan
    Route::get('/dm/jabatan', [jabatanController::class, 'index'])->middleware('can:hc');
    Route::get('/dm/jabatan/tabelData', [jabatanController::class, 'tabelData']);
    Route::post('/dm/jabatan/insert', [jabatanController::class, 'insert']);
    Route::post('/dm/jabatan/delete', [jabatanController::class, 'delete']);
    Route::post('/dm/jabatan/update', [jabatanController::class, 'update']);
    ROute::get('/dm/jabatan/detailJabatan', [jabatanController::class, 'detailJabatan']);

    //jam-kerja
    Route::get('dm/jam-kerja', [jamKerjaController::class, 'index'])->middleware('can:hc');
    Route::get('dm/jam-kerja/tabelData', [jamKerjaController::class, 'tabelData']);
    Route::post('/dm/jam-kerja/insert', [jamKerjaController::class, 'insert']);
    Route::post('/dm/jam-kerja/delete', [jamKerjaController::class, 'delete']);
    Route::post('dm/jam-kerja/update', [jamKerjaController::class, 'update']);

    //karyawan
    Route::get('/dk/karyawan', [karyawanController::class, 'index']);
    // Route::POST('/dk/karyawan/export', [karyawanController::class, 'export']); //sementara
    Route::get('dk/karyawan/addData', [karyawanController::class, 'addData']);
    Route::post('dk/karyawan/storeData', [karyawanController::class, 'storeData']);
    Route::get('dk/karyawan/detail-data/{id}', [karyawanController::class, 'detailData'])->name('detail-data');
    Route::get('dk/karyawan/edit-data/{id}', [karyawanController::class, 'editData'])->name('edit-data');
    Route::get('dk/karyawan/update-data/{id}', [karyawanController::class, 'updateData'])->name('edit-data');

    //potongan-cuti
    Route::get('psn/potongan-cuti', [potonganController::class, 'index'])->middleware('can:hc');
    Route::get('psn/potongan-cuti/tabelData', [potonganController::class, 'tabelData']);
    Route::post('/psn/potongan-cuti/insert', [potonganController::class, 'insert']);
    Route::post('/psn/potongan-cuti/delete', [potonganController::class, 'delete']);
    Route::post('/psn/potongan-cuti/update', [potonganController::class, 'update']);

    //cuti
    Route::get('psn/cuti', [cutiController::class, 'index']);
    Route::get('psn/cuti/posting-cuti', [cutiController::class, 'postingCuti'])->middleware('can:hc');
    Route::get('psn/cuti/tabel-cuti', [cutiController::class, 'tabelCuti']);
    Route::get('psn/cuti/detail-data', [cutiController::class, 'detailData']);
    Route::get('psn/cuti/detail-cuti', [cutiController::class, 'detailCuti']);

    //hutangCuti
    Route::get('psn/hutang-cuti', [hutangCutiController::class, 'index']);
    Route::get('psn/hutang-cuti/posting-hutang', [hutangCutiController::class, 'postingHutang']);
    Route::get('psn/hutang-cuti/tabel-hutang', [hutangCutiController::class, 'tabelHutang']);
    Route::get('psn/hutang-cuti/detail-hutang', [hutangCutiController::class, 'detailHutang']);

    //absensi
    Route::get('psn/absensi', [absensiController::class, 'index']);
    Route::get('psn/absensi/detailData', [absensiController::class, 'detailData']);
    Route::get('psn/absensi/prosesAbsensi', [absensiController::class, 'prosesData']);
    Route::get('psn/absensi/dataIjin', [absensiController::class, 'dataIjin']);
    Route::get('psn/absensi/addStatus', [absensiController::class, 'addStatus']);
    Route::get('psn/absensi/deleteStatus', [absensiController::class, 'deleteStatus']);


    //libur
    Route::get('dm/libur', [liburController::class, 'index'])->middleware('can:hc');
    Route::get('dm/libur/tabelData', [liburController::class, 'tabelData']);
    Route::post('dm/libur/insert', [liburController::class, 'insert']);
    Route::post('dm/libur/delete', [liburController::class, 'delete']);
    Route::post('dm/libur/update', [liburController::class, 'update']);

    //mesin_absen
    Route::get('dm/mesinAbsensi', [mesinAbsensiController::class, 'index'])->middleware('can:hc');
    Route::get('dm/mesinAbsensi/tabelData', [mesinAbsensiController::class, 'tabelData']);
    Route::post('dm/mesinAbsensi/insert', [mesinAbsensiController::class, 'insert']);
    Route::post('dm/mesinAbsensi/delete', [mesinAbsensiController::class, 'delete']);
    Route::post('dm/mesinAbsensi/update', [mesinAbsensiController::class, 'update']);

    //connectMesin/Tarik Data
    Route::get('psn/mesinAbsensi-sync', [mesinAbsensiController::class, 'sync']);
    Route::get('psn/mesinAbsensi-sync/connect', [mesinAbsensiController::class, 'connect']);
    Route::post('psn/mesinAbsensi-sync/tarikData', [mesinAbsensiController::class, 'tarikDataMesin']);

    //absensi_harian
    Route::get('psn/absensiHarian', [absensiHarianController::class, 'index']);
    Route::post('psn/absensiHarian/list', [absensiHarianController::class, 'list']);
    Route::post('psn/absensiHarian/prosesAbsensi', [absensiHarianController::class, 'prosesAbsensi']);

    //Pengguna
    Route::get('admin/users', [usersController::class, 'index'])->middleware('can:admin');
    Route::post('admin/storeData', [usersController::class, 'store']);
});
