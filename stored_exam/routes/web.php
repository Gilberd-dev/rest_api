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

// endpoint Anggota
Route::get("anggota/{id}", [StoredController::class, "getAnggotabyId"]);
Route::get("anggota", [StoredController::class, "getAllAnggota"]);
Route::delete("delanggota/{id}",[StoredController::class,"delAnggota"]);
Route::post("postanggota", [StoredController::class, "insertAnggota"]);
Route::put("updateanggota/{id}", [StoredController::class, "updateAnggota"]);

// endpoint Jabatan
Route::get("jabatan/{id}", [StoredController::class, "getjabatanbyId"]);
Route::get("jabatan", [StoredController::class, "getAlljabatan"]);
Route::delete("deljabatan/{id}",[StoredController::class,"deljabatan"]);
Route::post("postjabatan", [StoredController::class, "insertjabatan"]);
Route::put("updatejabatan/{id}", [StoredController::class, "updatejabatan"]);

// endpoint Detail Pindah
Route::get("detail_pindah/{id}", [StoredController::class, "getdetail_pindahbyId"]);
Route::get("detail_pindah", [StoredController::class, "getAlldetail_pindah"]);
Route::delete("deldetail_pindah/{id}",[StoredController::class,"deldetail_pindah"]);
Route::post("postdetail_pindah", [StoredController::class, "insertdetail_pindah"]);
Route::put("updatedetail_pindah/{id}", [StoredController::class, "updatedetail_pindah"]);

// endpoint Head Pindah
Route::get("head_pindah/{id}", [StoredController::class, "gethead_pindahbyId"]);
Route::get("head_pindah", [StoredController::class, "getAllhead_pindah"]);
Route::delete("delhead_pindah/{id}",[StoredController::class,"delhead_pindah"]);
Route::post("posthead_pindah", [StoredController::class, "inserthead_pindah"]);
Route::put("updatehead_pindah/{id}", [StoredController::class, "updatehead_pindah"]);

// endpoint Registrasi
Route::get("registrasi/{id}", [StoredController::class, "getregistrasibyId"]);
Route::get("registrasih", [StoredController::class, "getAllregistrasi"]);
Route::delete("registrasi/{id}",[StoredController::class,"delregistrasi"]);
Route::post("registrasi", [StoredController::class, "insertregistrasi"]);
Route::put("registrasi/{id}", [StoredController::class, "updateregistrasi"]);