<?php

use App\Http\Controllers\StoredController;
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
    return view('welcome');
});

// endpoint Cabang
Route::get("cabang/{id}", [StoredController::class, "getCabangbyId"]);
Route::get("cabang", [StoredController::class, "getAllCabang"]);
Route::delete("delcabang/{id}",[StoredController::class,"delCabang"]);
Route::post("postcabang", [StoredController::class, "insertCabang"]);
Route::put("updatecabang/{id}", [StoredController::class, "updateCabang"]);

// endpoint Sektor
Route::get("sektor/{id}", [StoredController::class, "getSektorbyId"]);
Route::get("sektor", [StoredController::class, "getAllSektor"]);
Route::delete("delsektor/{id}",[StoredController::class,"delSektor"]);
Route::post("postsektor", [StoredController::class, "insertSektor"]);
Route::put("updatesektor/{id}", [StoredController::class, "updateSektor"]);

// endpoint Jenis Kegiatan
Route::get("jenis/{id}", [StoredController::class, "getJenisbyId"]);
Route::get("jenis", [StoredController::class, "getAllJenis"]);
Route::delete("deljenis/{id}",[StoredController::class,"delJenis"]);
Route::post("postjenis", [StoredController::class, "insertJenis"]);
Route::put("updatejenis/{id}", [StoredController::class, "updateJenis"]);

// endpoint Waktu Kegiatan
Route::get("waktu/{id}", [StoredController::class, "getWaktubyId"]);
Route::get("waktu", [StoredController::class, "getAllWaktu"]);
Route::delete("delwaktu/{id}",[StoredController::class,"delWaktu"]);
Route::post("postwaktu", [StoredController::class, "insertWaktu"]);
Route::put("updatewaktu/{id}", [StoredController::class, "updateWaktu"]);