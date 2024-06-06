<?php

use App\Http\Controllers\keteranganIjinController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home',[
        'title'=>'Dashboard'
    ]);
});

Route::get('/keterangan-ijin',[keteranganIjinController::class, 'index' ]);
Route::get('/keterangan-ijin/insert',[keteranganIjinController::class,'insert']);
Route::get('/keterangan-ijin/tabelData',[keteranganIjinController::class,'tabelData']);

