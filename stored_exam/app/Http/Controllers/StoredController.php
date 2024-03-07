<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class StoredController extends Controller
{
    // ---------- CRUD CABANG ---------------

    public function getCabangbyId($id){
        $cabang = DB::select("CALL getCabang($id)");
        return response()->json($cabang); // output data dalam json

    }
    public function getAllCabang(){
        $allCabang = DB::select("CALL getAllCabang()");
        return response()->json($allCabang); // output data dalam json

    }

    // Nonaktifkan csrftoken jika tidak tidak memiliki/sulit mendapatkan token csrf dari halam html laravel
    // nonaktifkan pada Http/Middleware/Kernel.php line 37
    public function delCabang($cabangId)
    {
    try {
        // Memanggil stored procedure untuk menghapus data berdasarkan ID
        DB::select('CALL delCabang(?)', [$cabangId]);

        return response()->json(['message' => 'User deleted successfully']);
    } catch (\Exception $e) {
        // Tangani kesalahan, misalnya stored procedure tidak berhasil dijalankan
        return response()->json(['message' => 'Failed to delete user'], 500);
    }           
    }

    public function insertCabang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_cabang' => 'required',
            'nama_cabang' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kepala_cabang' => 'required|string|max:255'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => 'isi data cabang dengan benar'], 400);
        }
    
        $currentTime = now('Asia/Jakarta'); // Waktu sekarang
    
        $data = [
            'kode_cabang' => $request->input('kode_cabang'),
            'nama_cabang' => $request->input('nama_cabang'),
            'alamat' => $request->input('alamat'),
            'kepala_cabang' => $request->input('kepala_cabang'),
            'created_at' => $currentTime,
            'updated_at' => $currentTime,
        ];
    
        DB::table('cabang')->insert($data);
    
        return response()->json(['success' => 'Data berhasil'], 201);
    }

    public function updateCabang(Request $request, $id)
    {
        $request->validate([
            'kode_cabang' => 'nullable',
            'nama_cabang' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'kepala_cabang' => 'nullable|string|max:255'
        ]);

        $cabang = DB::table('cabang')->where('id_cabang', $id)->first();

        if ($cabang) {
            $currentTime = now('Asia/Jakarta');

            // Mengambil data yang ada di database
            $existingData = (array) $cabang;

            // Menggabungkan data yang ada dengan data yang baru
            $data = array_merge($existingData, $request->all());

            // Menghapus kunci 'id_cabang' agar tidak ikut terupdate
            unset($data['id_cabang']);

            // Melakukan pembaruan hanya jika ada data yang berubah
            if (!empty(array_diff_assoc($existingData, $data))) {
                $data['updated_at'] = $currentTime;

                DB::table('cabang')->where('id_cabang', $id)->update($data);
                return response()->json(['message' => 'Data berhasil diupdate'], 200);
            } else {
                return response()->json(['message' => 'Tidak ada perubahan data'], 200);
            }
        }

        return response()->json(['error' => 'Data tidak ditemukan'], 404);
    }



    // --------- CRUD Sektor -----------------

    public function getSektorbyId($id){
        $sektor = DB::select("CALL getSektor($id)");
        return response()->json($sektor); // output data dalam json

    }
    public function getAllSektor(){
        $allSektor = DB::select("CALL getAllSektor()");
        return response()->json($allSektor); // output data dalam json

    }

    // Nonaktifkan csrftoken jika tidak tidak memiliki/sulit mendapatkan token csrf dari halam html laravel
    // nonaktifkan pada Http/Middleware/Kernel.php line 37
    public function delSektor($sektorId)
    {
    try {
        // Memanggil stored procedure untuk menghapus data berdasarkan ID
        DB::select('CALL delSektor(?)', [$sektorId]);

        return response()->json(['message' => 'User deleted successfully']);
    } catch (\Exception $e) {
        // Tangani kesalahan, misalnya stored procedure tidak berhasil dijalankan
        return response()->json(['message' => 'Failed to delete user'], 500);
    }           
    }

    public function insertSektor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_cabang' => 'required',    
            'kode_sektor' => 'required',
            'nama_sektor' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kepala_sektor' => 'required|string|max:255',
            'tgl_berdiri' => 'required|date_format:Y-m-d H:i:s'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => 'isi data sektor dengan benar'], 400);
        }
    
        $currentTime = now('Asia/Jakarta'); // Waktu sekarang
    
        $data = [
            'id_cabang' => $request->input('id_cabang'),
            'kode_sektor' => $request->input('kode_sektor'),
            'nama_sektor' => $request->input('nama_sektor'),
            'alamat' => $request->input('alamat'),
            'kepala_sektor' => $request->input('kepala_sektor'),
            'tgl_berdiri' => $request->input('tgl_berdiri'),
            'created_at' => $currentTime,
            'updated_at' => $currentTime,
        ];
    
        DB::table('sektor')->insert($data);
    
        return response()->json(['success' => 'Data berhasil di input'], 201);
    }

    public function updateSektor(Request $request, $id)
    {
        $request->validate([
            'id_cabang' => 'nullable',    
            'kode_sektor' => 'nullable',
            'nama_sektor' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'kepala_sektor' => 'nullable|string|max:255',
            'tgl_berdiri' => 'nullable|date_format:Y-m-d H:i:s'
        ]);

        $sektor = DB::table('sektor')->where('id_sektor', $id)->first();

        if ($sektor) {
            $currentTime = now('Asia/Jakarta');

            // Mengambil data yang ada di database
            $existingData = (array) $sektor;

            // Menggabungkan data yang ada dengan data yang baru
            $data = array_merge($existingData, $request->all());

            // Menghapus kunci 'id_sektor' agar tidak ikut terupdate
            unset($data['id_sektor']);

            // Melakukan pembaruan hanya jika ada data yang berubah
            if (!empty(array_diff_assoc($existingData, $data))) {
                $data['updated_at'] = $currentTime;

                DB::table('sektor')->where('id_sektor', $id)->update($data);
                return response()->json(['message' => 'Data berhasil diupdate'], 200);
            } else {
                return response()->json(['message' => 'Tidak ada perubahan data'], 200);
            }
        }

        return response()->json(['error' => 'Data tidak ditemukan'], 404);
    }


    // ------------- CRUD Jenis Kegiatan ------------------

    public function getJenisbyId($id){
        $jenis = DB::select("CALL getJenis($id)");
        return response()->json($jenis); // output data dalam json

    }
    public function getAllJenis(){
        $allJenis = DB::select("CALL getAllJenis()");
        return response()->json($allJenis); // output data dalam json

    }

    // Nonaktifkan csrftoken jika tidak tidak memiliki/sulit mendapatkan token csrf dari halam html laravel
    // nonaktifkan pada Http/Middleware/Kernel.php line 37
    public function delJenis($jenisId)
    {
    try {
        // Memanggil stored procedure untuk menghapus data berdasarkan ID
        DB::select('CALL delJenis(?)', [$jenisId]);

        return response()->json(['message' => 'User deleted successfully']);
    } catch (\Exception $e) {
        // Tangani kesalahan, misalnya stored procedure tidak berhasil dijalankan
        return response()->json(['message' => 'Failed to delete user'], 500);
    }           
    }

    public function insertJenis(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jenis_kegiatan' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'id_sektor' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => 'isi data jenis kegiatan dengan benar'], 400);
        }
    
        $currentTime = now('Asia/Jakarta'); // Waktu sekarang
    
        $data = [
            'nama_jenis_kegiatan' => $request->input('nama_jenis_kegiatan'),
            'keterangan' => $request->input('keterangan'),
            'id_sektor' => $request->input('id_sektor'),
            'created_at' => $currentTime,
            'updated_at' => $currentTime,
        ];
    
        DB::table('jenis_kegiatan')->insert($data);
    
        return response()->json(['success' => 'Data berhasil di input'], 201);
    }

    public function updateJenis(Request $request, $id)
    {
        $request->validate([
            'nama_jenis_kegiatan' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'id_sektor' => 'nullable'
        ]);

        $jenis = DB::table('jenis_kegiatan')->where('id_jenis_kegiatan', $id)->first();

        if ($jenis) {
            $currentTime = now('Asia/Jakarta');

            // Mengambil data yang ada di database
            $existingData = (array) $jenis;

            // Menggabungkan data yang ada dengan data yang baru
            $data = array_merge($existingData, $request->all());

            // Menghapus kunci 'id_jenis_kegiatan' agar tidak ikut terupdate
            unset($data['id_jenis_kegiatan']);

            // Melakukan pembaruan hanya jika ada data yang berubah
            if (!empty(array_diff_assoc($existingData, $data))) {
                $data['updated_at'] = $currentTime;

                DB::table('jenis_kegiatan')->where('id_jenis_kegiatan', $id)->update($data);
                return response()->json(['message' => 'Data berhasil diupdate'], 200);
            } else {
                return response()->json(['message' => 'Tidak ada perubahan data'], 200);
            }
        }

        return response()->json(['error' => 'Data tidak ditemukan'], 404);
    }


    // ------------------- CRUD Waktu Kegiatan --------------------

    public function getWaktubyId($id){
        $waktu = DB::select("CALL getWaktu($id)");
        return response()->json($waktu); // output data dalam json

    }
    public function getAllWaktu(){
        $allWaktu = DB::select("CALL getAllWaktu()");
        return response()->json($allWaktu); // output data dalam json

    }

    // Nonaktifkan csrftoken jika tidak tidak memiliki/sulit mendapatkan token csrf dari halam html laravel
    // nonaktifkan pada Http/Middleware/Kernel.php line 37
    public function delWaktu($waktuId)
    {
    try {
        // Memanggil stored procedure untuk menghapus data berdasarkan ID
        DB::select('CALL delWaktu(?)', [$waktuId]);

        return response()->json(['message' => 'User deleted successfully']);
    } catch (\Exception $e) {
        // Tangani kesalahan, misalnya stored procedure tidak berhasil dijalankan
        return response()->json(['message' => 'Failed to delete user'], 500);
    }           
    }

    public function insertWaktu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_jenis_kegiatan' => 'required',
            'nama_kegiatan' => 'required|string|max:255',
            'lokasi_kegiatan' => 'required|string|max:255',
            'waktu_kegiatan' => 'required|date_format:Y-m-d H:i:s',
            'keterangan' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => 'isi data waktu kegiatan dengan benar'], 400);
        }
    
        $currentTime = now('Asia/Jakarta'); // Waktu sekarang
    
        $data = [
            'id_jenis_kegiatan' => $request->input('id_jenis_kegiatan'),
            'nama_kegiatan' => $request->input('nama_kegiatan'),
            'lokasi_kegiatan' => $request->input('lokasi_kegiatan'),
            'waktu_kegiatan' => $request->input('waktu_kegiatan'),
            'keterangan' => $request->input('keterangan'),
            'created_at' => $currentTime,
            'updated_at' => $currentTime,
        ];
    
        DB::table('waktu_kegiatan')->insert($data);
    
        return response()->json(['success' => 'Data berhasil di input'], 201);
    }

    public function updateWaktu(Request $request, $id)
    {
        $request->validate([
            'id_jenis_kegiatan' => 'nullable',
            'nama_kegiatan' => 'nullable|string|max:255',
            'lokasi_kegiatan' => 'nullable|string|max:255',
            'waktu_kegiatan' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $jenis = DB::table('waktu_kegiatan')->where('id_waktu_kegiatan', $id)->first();

        if ($jenis) {
            $currentTime = now('Asia/Jakarta');

            // Mengambil data yang ada di database
            $existingData = (array) $jenis;

            // Menggabungkan data yang ada dengan data yang baru
            $data = array_merge($existingData, $request->all());

            // Menghapus kunci 'id_waktu_kegiatan' agar tidak ikut terupdate
            unset($data['id_waktu_kegiatan']);
            
            // Melakukan pembaruan hanya jika ada data yang berubah
            if (!empty(array_diff_assoc($existingData, $data))) {
                $data['updated_at'] = $currentTime;

                DB::table('waktu_kegiatan')->where('id_waktu_kegiatan', $id)->update($data);
                return response()->json(['message' => 'Data berhasil diupdate'], 200);
            } else {
                return response()->json(['message' => 'Tidak ada perubahan data'], 200);
            }
        }
        return response()->json(['error' => 'Data tidak ditemukan'], 404);
    }


}
