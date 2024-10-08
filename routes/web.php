<?php

use App\Http\Controllers\absensiController;
use App\Http\Controllers\absensiHarianController;
use App\Http\Controllers\advanceController;
use App\Http\Controllers\bagianController;
use App\Http\Controllers\cutiController;
use App\Http\Controllers\departemenController;
use App\Http\Controllers\fkpController;
use App\Http\Controllers\groupKerjaController;
use App\Http\Controllers\groupOffController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\hutangCutiController;
use App\Http\Controllers\jabatanController;
use App\Http\Controllers\jadwalGroupKerjaController;
use App\Http\Controllers\jamKerjaController;
use App\Http\Controllers\kalkulasiController;
use App\Http\Controllers\karyawanController;
use App\Http\Controllers\karyawanKeluarController;
use App\Http\Controllers\keteranganIjinController;
use App\Http\Controllers\komposisiController;
use App\Http\Controllers\kontrakKaryawanController;
use App\Http\Controllers\liburController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\mesinAbsensiController;
use App\Http\Controllers\overtimeController;
use App\Http\Controllers\perusahaanController;
use App\Http\Controllers\pmkController;
use App\Http\Controllers\potonganController;
use App\Http\Controllers\SPController;
use App\Http\Controllers\tunjanganPotonganController;
use App\Http\Controllers\usersController;
use Illuminate\Support\Facades\Route;

Route::get('/mail', function () {
    return view('mail/emailAbsensi', [
        'title' => 'Dashboard'
    ]);
});


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
    Route::get('/dk/karyawan', [karyawanController::class, 'index'])->name('karyawan');
    Route::get('/dk/karyawan/tableData', [karyawanController::class, 'tableData']);
    // Route::POST('/dk/karyawan/export', [karyawanController::class, 'export']); //sementara
    Route::get('dk/karyawan/addData', [karyawanController::class, 'addData']);
    Route::post('dk/karyawan/storeData', [karyawanController::class, 'storeData']);
    Route::get('dk/karyawan/detail-data/{id}', [karyawanController::class, 'detailData'])->name('detail-data');
    Route::get('dk/karyawan/edit-data/{id}', [karyawanController::class, 'editData'])->name('edit-data');
    Route::get('dk/karyawan/update-data/{id}', [karyawanController::class, 'updateData'])->name('edit-data');
    Route::post('dk/karyawan/updateSalary', [karyawanController::class, 'updateSalary']);


    //komposisi
    Route::get('/dk/komposisi', [komposisiController::class, 'index'])->name('komposisi')->middleware('can:hc');


    //potongan-cuti
    Route::get('psn/potongan-cuti', [potonganController::class, 'index'])->middleware('can:hc');
    Route::get('psn/potongan-cuti/tabelData', [potonganController::class, 'tabelData']);
    Route::post('/psn/potongan-cuti/insert', [potonganController::class, 'insert']);
    Route::post('/psn/potongan-cuti/delete', [potonganController::class, 'delete']);
    Route::post('/psn/potongan-cuti/update', [potonganController::class, 'update']);

    //cuti
    Route::get('psn/cuti', [cutiController::class, 'index']);
    Route::post('psn/cuti/posting-cuti', [cutiController::class, 'postingCuti'])->middleware('can:hc');
    Route::get('psn/cuti/tabel-cuti', [cutiController::class, 'tabelCuti']);
    Route::get('psn/cuti/detail-data', [cutiController::class, 'detailData']);
    Route::get('psn/cuti/detail-cuti', [cutiController::class, 'detailCuti']);
    Route::get('psn/cuti/detail-print', [cutiController::class, 'detailPrint']);
    Route::post('psn/cuti/tambahCuti', [cutiController::class, 'tambahCuti']);
    Route::post('psn/cuti/potongCuti', [cutiController::class, 'potongCuti']);
    Route::get('psn/cuti/listTambah', [cutiController::class, 'listTambah']);
    Route::get('psn/cuti/listPotong', [cutiController::class, 'listPotong']);
    Route::get('psn/cuti/printCuti', [cutiController::class, 'printCuti']);

    //hutangCuti
    Route::get('psn/hutang-cuti', [hutangCutiController::class, 'index']);
    Route::get('psn/hutang-cuti/posting-hutang', [hutangCutiController::class, 'postingHutang'])->middleware('can:hc');
    Route::get('psn/hutang-cuti/tabel-hutang', [hutangCutiController::class, 'tabelHutang']);
    Route::get('psn/hutang-cuti/detail-hutang', [hutangCutiController::class, 'detailHutang']);

    //absensi
    Route::get('psn/absensi', [absensiController::class, 'index']);
    Route::get('psn/absensi/detailData', [absensiController::class, 'detailData']);
    Route::get('psn/absensi/prosesAbsensi', [absensiController::class, 'prosesData']);
    Route::get('psn/absensi/dataIjin', [absensiController::class, 'dataIjin']);
    Route::get('psn/absensi/addStatus', [absensiController::class, 'addStatus']);
    Route::get('psn/absensi/deleteStatus', [absensiController::class, 'deleteStatus']);
    Route::get('psn/absensi/cekRows', [absensiController::class, 'cekRows']);

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
    Route::get('psn/mesinAbsensi-sync/tarikData', [mesinAbsensiController::class, 'tarikDataMesin']);

    //absensi_harian
    Route::get('psn/absensiHarian', [absensiHarianController::class, 'index']);
    Route::get('psn/absensiHarian/list', [absensiHarianController::class, 'list']);
    Route::post('psn/absensiHarian/prosesAbsensi', [absensiHarianController::class, 'prosesAbsensi']);
    Route::get('psn/absensiHarian/updateFull', [absensiHarianController::class, 'updateFull']);
    Route::get('psn/absensiHarian/updateTerlambat', [absensiHarianController::class, 'updateTerlambat']);

    //cetakAbsensi
    Route::get('psn/cetakAbsensi', [absensiHarianController::class, 'cetakAbsensi']);
    Route::get('psn/cetakPerorang', [absensiHarianController::class, 'cetakPerorang']);

    //karyawanKeluar
    Route::get('dk/karyawanKeluar', [karyawanKeluarController::class, 'index'])->middleware('can:hc');
    Route::post('dk/karyawanKeluar/storeData', [karyawanKeluarController::class, 'storeData']);
    Route::get('dk/karyawanKeluar/tabelData', [karyawanKeluarController::class, 'tabelData']);
    Route::post('dk/karyawanKeluar/updateData', [karyawanKeluarController::class, 'updateData']);
    Route::post('dk/karyawanKeluar/delete', [karyawanKeluarController::class, 'delete']);

    //groupOff
    Route::get('dm/groupOff', [groupOffController::class, 'index'])->middleware('can:hc');
    Route::post('dm/groupOff/storeData', [groupOffController::class, 'storeData']);
    Route::get('dm/groupOff/tabelData', [groupOffController::class, 'tabelData']);
    Route::post('dm/groupOff/delete', [groupOffController::class, 'delete']);

    //groupKerja
    Route::get('psn/jadwalGroupKerja', [jadwalGroupKerjaController::class, 'index'])->middleware('can:hc');
    Route::post('psn/jadwalGroupKerja/storeData', [jadwalGroupKerjaController::class, 'storeData']);
    Route::get('psn/jadwalGroupKerja/tabelData', [jadwalGroupKerjaController::class, 'tabelData']);
    Route::post('psn/jadwalGroupKerja/delete', [jadwalGroupKerjaController::class, 'delete']);

    //jadwalGroupKerja
    Route::get('dm/groupKerja', [groupKerjaController::class, 'index'])->middleware('can:hc');
    Route::post('dm/groupKerja/storeData', [groupKerjaController::class, 'storeData']);
    Route::get('dm/groupKerja/tabelData', [groupKerjaController::class, 'tabelData']);
    Route::post('dm/groupKerja/delete', [groupKerjaController::class, 'delete']);

    //karyawanKontrak
    Route::get('psn/kontrak-karyawan', [kontrakKaryawanController::class, 'index'])->middleware('can:hc');
    Route::post('psn/kontrak-karyawan/store', [kontrakKaryawanController::class, 'storeData']);
    Route::get('psn/kontrak-karyawan/tabelData', [kontrakKaryawanController::class, 'tabelData']);
    Route::post('psn/kontrak-karyawan/delete', [kontrakKaryawanController::class, 'delete']);
    Route::post('psn/kontrak-karyawan/update', [kontrakKaryawanController::class, 'update']);

    //sp
    Route::get('psn/sp', [SPController::class, 'index'])->middleware('can:hc');
    Route::post('psn/sp/store', [SPController::class, 'storeData']);
    Route::get('psn/sp/tabelData', [SPController::class, 'tabelData']);
    Route::post('psn/sp/delete', [SPController::class, 'delete']);
    Route::post('psn/sp/update', [SPController::class, 'update']);

    //FKP
    Route::get('psn/fkp', [fkpController::class, 'index'])->middleware('can:hc');
    Route::get('psn/fkp/addData', [fkpController::class, 'addData']);
    Route::post('psn/fkp/store', [fkpController::class, 'storeData']);
    Route::get('psn/fkp/tabelData', [fkpController::class, 'tabelData']);
    Route::post('psn/fkp/delete', [fkpController::class, 'delete']);
    Route::post('psn/fkp/update', [fkpController::class, 'update']);


    //pmk
    Route::get('psn/pmk', [pmkController::class, 'index']);
    Route::get('psn/pmk/tabelData', [pmkController::class, 'tabelData']);
    Route::get('psn/pmk/tabelDataHak', [pmkController::class, 'tabelDataHak']);

    //payroll
    Route::controller(advanceController::class)->group(function () {
        Route::get('pay/advance', 'index');
        Route::post('pay/advance/store', 'store');
        Route::post('pay/advance/delete', 'delete');
        Route::post('pay/advance/update', 'update');
        Route::get('pay/advance/get_id', 'getId');
        Route::get('pay/advance/prosesData', 'prosesData');
        Route::get('pay/advance/tabelData', 'tabelData');
        Route::post('pay/advance/updateStatus', 'updateStatus');
        Route::get('pay/advance/cetakLaporan', 'cetakLaporan');
    })->middleware('can:payroll');

    //payroll Tunjangan / Potongan
    Route::controller(tunjanganPotonganController::class)->group(function () {
        Route::get('pay/tunjangan-potongan', 'index');
        Route::post('pay/tunjangan-potongan/store', 'store');
    })->middleware('can:payroll');


    //kalkulasi
    Route::get('psn/kalkulasi', [kalkulasiController::class, 'index']);
    Route::get('psn/kalkulasi/tabelData', [kalkulasiController::class, 'tabelData']);

    //overtime
    Route::get('pay/overtime', [overtimeController::class, 'index']);
    Route::get('pay/overtime/addData', [overtimeController::class, 'addData']);
    Route::post('pay/overtime/store', [overtimeController::class, 'storeData']);
    Route::post('pay/overtime/storeDetail', [overtimeController::class, 'storeDataDetail']);
    Route::post('pay/overtime/updateDetail', [overtimeController::class, 'updateDataDetail']);
    Route::get('pay/overtime/updateStatus', [overtimeController::class, 'updateStatus']);
    Route::get('pay/overtime/tabelDetail', [overtimeController::class, 'tabelDetail']);
    Route::get('pay/overtime/tabelData', [overtimeController::class, 'tabelData']);
    Route::post('pay/overtime/updateStatusForm', [overtimeController::class, 'updateStatusForm']);
    Route::post('pay/overtime/updateStatusFormHC', [overtimeController::class, 'updateStatusFormHC']);
    Route::post('pay/overtime/updateStatusFormReject', [overtimeController::class, 'updateStatusFormReject']);
    Route::get('pay/overtime/kalkulasi/view', [overtimeController::class, 'kalkulasi']);
    Route::get('pay/overtime/kalkulasi/tabelKalkulasi', [overtimeController::class, 'tabelKalkulasi']);
    Route::get('pay/overtime/kalkulasi/detailKalkulasi', [overtimeController::class, 'detailKalkulasi']);

    Route::get('pay/overtime/detail/{id}', [overtimeController::class, 'detail']);
    Route::get('pay/overtime/cetakLaporan/{id}', [overtimeController::class, 'cetak']);

    //Pengguna
    Route::get('admin/users', [usersController::class, 'index'])->middleware('can:admin');
    Route::post('admin/storeData', [usersController::class, 'store']);
    Route::get('admin/users/tabelAdmin', [usersController::class, 'tabelAdmin']);
});
