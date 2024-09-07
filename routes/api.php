<?php

use App\Http\Controllers\API\apiKaryawanController;
use App\Http\Controllers\API\apiLoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(apiLoginController::class)->group(function () {
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('karyawan', apiKaryawanController::class);
});


/*
'headers' => [
    'Accept' => 'application/json',
    'Authorization' => 'Bearer '.$accessToken,
]   
*/
