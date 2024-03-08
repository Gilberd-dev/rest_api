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

        // ------------- CRUD Anggota ------------------

        public function getAnggotabyId($id){
            $Anggota = DB::select("CALL getAnggota($id)");
            return response()->json($Anggota); // output data dalam json
    
        }
        public function getAllAnggota(){
            $allAnggota = DB::select("CALL getAllAnggota()");
            return response()->json($allAnggota); // output data dalam json
    
        }
    
        // Nonaktifkan csrftoken jika tidak tidak memiliki/sulit mendapatkan token csrf dari halam html laravel
        // nonaktifkan pada Http/Middleware/Kernel.php line 37
        public function delAnggota($AnggotaId)
        {
        try {
            // Memanggil stored procedure untuk menghapus data berdasarkan ID
            DB::select('CALL delAnggota(?)', [$AnggotaId]);
    
            return response()->json(['message' => 'User deleted successfully']);
        } catch (\Exception $e) {
            // Tangani kesalahan, misalnya stored procedure tidak berhasil dijalankan
            return response()->json(['message' => 'Failed to delete user'], 500);
        }           
        }
    
        public function insertAnggota(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'nama_lengkap' => 'required|string|max:255',
                'id_registrasi' => 'required',
                'NIK' => 'required',
                'pekerjaan' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
                'id_hub_keluarga' => 'required',
                'id_status' => 'required',
                'id_sektor' => 'required',
                'alamat' => 'required|string|max:255',
                'no_hp' => 'required',
                'foto_anggota' => 'required|string|max:255',
            ]);
        
            if ($validator->fails()) {
                return response()->json(['error' => 'isi data anggota dengan benar'], 400);
            }
        
            $currentTime = now('Asia/Jakarta'); // Waktu sekarang
        
            $data = [
                'nama_lengkap' => $request->input('nama_lengkap'),
                'id_registrasi' => $request->input('id_registrasi'),
                'NIK' => $request->input('NIK'),
                'pekerjaan' => $request->input('pekerjaan'),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'id_hub_keluarga' => $request->input('id_hub_keluarga'),
                'id_status' => $request->input('id_status'),
                'id_sektor' => $request->input('id_sektor'),
                'alamat' => $request->input('alamat'),
                'no_hp' => $request->input('no_hp'),
                'foto_anggota' => $request->input('foto_anggota'),
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ];
        
            DB::table('anggota')->insert($data);
        
            return response()->json(['success' => 'Data berhasil di input'], 201);
        }
    
        public function updateanggota(Request $request, $id)
        {
            $request->validate([
                'nama_lengkap' => 'nullable|string|max:255',
                'id_registrasi' => 'nullable',
                'NIK' => 'nullable',
                'pekerjaan' => 'nullable|string|max:255',
                'tempat_lahir' => 'nullable|string|max:255',
                'jenis_kelamin' => 'nullable|string|in:Laki-laki,Perempuan',
                'id_hub_keluarga' => 'nullable',
                'id_status' => 'nullable',
                'id_sektor' => 'nullable',
                'alamat' => 'nullable|string|max:255',
                'no_hp' => 'nullable',
                'foto_anggota' => 'nullable|string|max:255',
            ]);
    
            $jenis = DB::table('anggota')->where('id_anggota', $id)->first();
    
            if ($jenis) {
                $currentTime = now('Asia/Jakarta');
    
                // Mengambil data yang ada di database
                $existingData = (array) $jenis;
    
                // Menggabungkan data yang ada dengan data yang baru
                $data = array_merge($existingData, $request->all());
    
                // Menghapus kunci 'id_waktu_kegiatan' agar tidak ikut terupdate
                unset($data['id_anggota']);
                
                // Melakukan pembaruan hanya jika ada data yang berubah
                if (!empty(array_diff_assoc($existingData, $data))) {
                    $data['updated_at'] = $currentTime;
    
                    DB::table('anggota')->where('id_anggota', $id)->update($data);
                    return response()->json(['message' => 'Data berhasil diupdate'], 200);
                } else {
                    return response()->json(['message' => 'Tidak ada perubahan data'], 200);
                }
            }
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
            
        }



  // ------------- CRUD Jabatan ------------------

  public function getjabatanbyId($id){
    $jabatan = DB::select("CALL getjabatan($id)");
    return response()->json($jabatan); // output data dalam json

}
public function getAlljabatan(){
    $alljabatan = DB::select("CALL getAlljabatan()");
    return response()->json($alljabatan); // output data dalam json
}

// Nonaktifkan csrftoken jika tidak tidak memiliki/sulit mendapatkan token csrf dari halam html laravel
// nonaktifkan pada Http/Middleware/Kernel.php line 37
public function deljabatan($jabatanId)
{
try {
    // Memanggil stored procedure untuk menghapus data berdasarkan ID
    DB::select('CALL deljabatan(?)', [$jabatanId]);

    return response()->json(['message' => 'User deleted successfully']);
} catch (\Exception $e) {
    // Tangani kesalahan, misalnya stored procedure tidak berhasil dijalankan
    return response()->json(['message' => 'Failed to delete user'], 500);
}           
}

public function insertjabatan(Request $request)
{
    $validator = Validator::make($request->all(), [
        'id_anggota' => 'required',
        'nama_jabatan' => 'required|string|max:255',
        'tgl_pengukuhan' => 'required|string|max:255',
        'akhir_jabatan' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => 'isi data jabatan dengan benar'], 400);
    }

    $currentTime = now('Asia/Jakarta'); // Waktu sekarang

    $data = [
        'id_anggota' => $request->input('id_anggota'),
        'nama_jabatan' => $request->input('nama_jabatan'),
        'tgl_pengukuhan' => $request->input('tgl_pengukuhan'),
        'akhir_jabatan' => $request->input('akhir_jabatan'),
        'created_at' => $currentTime,
        'updated_at' => $currentTime,
    ];

    DB::table('jabatan')->insert($data);

    return response()->json(['success' => 'Data berhasil di input'], 201);
}

public function updatejabatan(Request $request, $id)
{
    $request->validate([
        'id_anggota' => 'nullable',
        'nama_jabatan' => 'nullable|string|max:255',
        'tgl_pengukuhan' => 'nullable|string|max:255',
        'akhir_jabatan' => 'nullable|string|max:255',
    ]);

    $jenis = DB::table('jabatan')->where('id_jabatan', $id)->first();

    if ($jenis) {
        $currentTime = now('Asia/Jakarta');

        // Mengambil data yang ada di database
        $existingData = (array) $jenis;

        // Menggabungkan data yang ada dengan data yang baru
        $data = array_merge($existingData, $request->all());

        // Menghapus kunci 'id_waktu_kegiatan' agar tidak ikut terupdate
        unset($data['id_jabatan']);
        
        // Melakukan pembaruan hanya jika ada data yang berubah
        if (!empty(array_diff_assoc($existingData, $data))) {
            $data['updated_at'] = $currentTime;

            DB::table('jabatan')->where('id_jabatan', $id)->update($data);
            return response()->json(['message' => 'Data berhasil diupdate'], 200);
        } else {
            return response()->json(['message' => 'Tidak ada perubahan data'], 200);
        }
    }
    return response()->json(['error' => 'Data tidak ditemukan'], 404);
}



  // ------------- CRUD Detail Pindah ------------------

  public function getdetail_pindahbyId($id){
    $detail_pindah = DB::select("CALL getdetail_pindah($id)");
    return response()->json($detail_pindah); // output data dalam json

}
public function getAlldetail_pindah(){
    $alldetail_pindah = DB::select("CALL getAlldetail_pindah()");
    return response()->json($alldetail_pindah); // output data dalam json
}

// Nonaktifkan csrftoken jika tidak tidak memiliki/sulit mendapatkan token csrf dari halam html laravel
// nonaktifkan pada Http/Middleware/Kernel.php line 37
public function deldetail_pindah($detail_pindahId)
{
try {
    // Memanggil stored procedure untuk menghapus data berdasarkan ID
    DB::select('CALL deldetail_pindah(?)', [$detail_pindahId]);

    return response()->json(['message' => 'User deleted successfully']);
} catch (\Exception $e) {
    // Tangani kesalahan, misalnya stored procedure tidak berhasil dijalankan
    return response()->json(['message' => 'Failed to delete user'], 500);
}           
}

public function insertdetail_pindah(Request $request)
{
    $validator = Validator::make($request->all(), [
        'keterangan' => 'required|string|max:255',
        'id_anggota' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => 'isi data detail pindah dengan benar'], 400);
    }

    $currentTime = now('Asia/Jakarta'); // Waktu sekarang

    $data = [
        'keterangan' => $request->input('keterangan'),
        'id_anggota' => $request->input('id_anggota'),
        'created_at' => $currentTime,
        'updated_at' => $currentTime,
    ];

    DB::table('detail_pindah')->insert($data);

    return response()->json(['success' => 'Data berhasil di input'], 201);
}

public function updatedetail_pindah(Request $request, $id)
{
    $request->validate([
        'keterangan' => 'nullable|string|max:255',
        'id_anggota' => 'nullable',
    ]);

    $jenis = DB::table('detail_pindah')->where('id_det_red_pindah', $id)->first();

    if ($jenis) {
        $currentTime = now('Asia/Jakarta');

        // Mengambil data yang ada di database
        $existingData = (array) $jenis;

        // Menggabungkan data yang ada dengan data yang baru
        $data = array_merge($existingData, $request->all());

        // Menghapus kunci 'id_waktu_kegiatan' agar tidak ikut terupdate
        unset($data['id_det_red_pindah']);
        
        // Melakukan pembaruan hanya jika ada data yang berubah
        if (!empty(array_diff_assoc($existingData, $data))) {
            $data['updated_at'] = $currentTime;

            DB::table('detail_pindah')->where('id_det_reg_pindah', $id)->update($data);
            return response()->json(['message' => 'Data berhasil diupdate'], 200);
        } else {
            return response()->json(['message' => 'Tidak ada perubahan data'], 200);
        }
    }
    return response()->json(['error' => 'Data tidak ditemukan'], 404);
}


  // ------------- CRUD Head Pindah ------------------

  public function gethead_pindahbyId($id){
    $head_pindah = DB::select("CALL gethead_pindah($id)");
    return response()->json($head_pindah); // output data dalam json

}
public function getAllhead_pindah(){
    $allhead_pindah = DB::select("CALL getAllhead_pindah()");
    return response()->json($allhead_pindah); // output data dalam json
}

// Nonaktifkan csrftoken jika tidak tidak memiliki/sulit mendapatkan token csrf dari halam html laravel
// nonaktifkan pada Http/Middleware/Kernel.php line 37
public function delhead_pindah($head_pindahId)
{
try {
    // Memanggil stored procedure untuk menghapus data berdasarkan ID
    DB::select('CALL delhead_pindah(?)', [$head_pindahId]);

    return response()->json(['message' => 'User deleted successfully']);
} catch (\Exception $e) {
    // Tangani kesalahan, misalnya stored procedure tidak berhasil dijalankan
    return response()->json(['message' => 'Failed to delete user'], 500);
}           
}

public function inserthead_pindah(Request $request)
{
    $validator = Validator::make($request->all(), [
        'id_registrasi' => 'required',
        'id_anggota' => 'required',
        'no_surat_pindah' => 'required|string|max:255',
        'tgl_pindah' => 'required|string|max:255',
        'id_jabatan' => 'required',
        'id_sektor_tujuan' => 'required',
        'keterangan' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => 'isi data head pindah dengan benar'], 400);
    }

    $currentTime = now('Asia/Jakarta'); // Waktu sekarang

    $data = [
        'id_registrasi' => $request->input('id_registrasi'),
        'id_anggota' => $request->input('id_anggota'),
        'no_surat_pindah' => $request->input('no_surat_pindah'),
        'tgl_pindah' =>$request->input('tgl_pindah'),
        'id_jabatan' => $request->input('id_jabatan'),
        'id_sektor_tujuan' => $request->input('id_sektor_tujuan'),
        'keterangan' => $request->input ('keterangan'),
        'created_at' => $currentTime,
        'updated_at' => $currentTime,
    ];

    DB::table('head_pindah')->insert($data);

    return response()->json(['success' => 'Data berhasil di input'], 201);
}

public function updatehead_pindah(Request $request, $id)
{
    $request->validate([
        'id_registrasi' => 'nullable',
        'id_anggota' => 'nullable',
        'no_surat_pindah' => 'nullable|string|max:255',
        'tgl_pindah' => 'nullable|string|max:255',
        'id_jabatan' => 'nullable',
        'id_sektor_tujuan' => 'nullable',
        'keterangan' => 'nullable|string|max:255',
    ]);

    $jenis = DB::table('head_pindah')->where('id_head_red_pindah', $id)->first();

    if ($jenis) {
        $currentTime = now('Asia/Jakarta');

        // Mengambil data yang ada di database
        $existingData = (array) $jenis;

        // Menggabungkan data yang ada dengan data yang baru
        $data = array_merge($existingData, $request->all());

        // Menghapus kunci 'id_waktu_kegiatan' agar tidak ikut terupdate
        unset($data['id_head_red_pindah']);
        
        // Melakukan pembaruan hanya jika ada data yang berubah
        if (!empty(array_diff_assoc($existingData, $data))) {
            $data['updated_at'] = $currentTime;

            DB::table('head_pindah')->where('id_head_reg_pindah', $id)->update($data);
            return response()->json(['message' => 'Data berhasil diupdate'], 200);
        } else {
            return response()->json(['message' => 'Tidak ada perubahan data'], 200);
        }
    }
    return response()->json(['error' => 'Data tidak ditemukan'], 404);
}


// ------------- CRUD Registrasi ------------------

public function getregistrasibyId($id){
    $registrasi = DB::select("CALL getregistrasi($id)");
    return response()->json($registrasi); // output data dalam json

}
public function getAllregistrasi(){
    $allregistrasi = DB::select("CALL getAllregistrasi()");
    return response()->json($allregistrasi); // output data dalam json
}

// Nonaktifkan csrftoken jika tidak tidak memiliki/sulit mendapatkan token csrf dari halam html laravel
// nonaktifkan pada Http/Middleware/Kernel.php line 37
public function delregistrasi($registrasiId)
{
try {
    // Memanggil stored procedure untuk menghapus data berdasarkan ID
    DB::select('CALL delregistrasi(?)', [$registrasiId]);

    return response()->json(['message' => 'User deleted successfully']);
} catch (\Exception $e) {
    // Tangani kesalahan, misalnya stored procedure tidak berhasil dijalankan
    return response()->json(['message' => 'Failed to delete user'], 500);
}           
}

public function insertregistrasi(Request $request)
{
    $validator = Validator::make($request->all(), [
        'no_registrasi' => 'required',
        'tgl_registrasi' => 'required|string|max:255',
        'id_sektor' => 'required',
        'id_status_registrasi' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => 'isi data head pindah dengan benar'], 400);
    }

    $currentTime = now('Asia/Jakarta'); // Waktu sekarang

    $data = [
        'no_registrasi' => $request->input('no_registrasi'),
        'tgl_registrasi' => $request->input('tgl_registrasi'),
        'id_sektor' => $request->input('id_sektor'),
        'id_status_registrasi' =>$request->input('id_status_registrasi'),
        'created_at' => $currentTime,
        'updated_at' => $currentTime,
    ];

    DB::table('registrasi')->insert($data);

    return response()->json(['success' => 'Data berhasil di input'], 201);
}

public function updateregistrasi(Request $request, $id)
{
    $request->validate([
        'no_registrasi' => 'nullable',
        'tgl_registrasi' => 'nullable|string|max:255',
        'id_sektor' => 'nullable',
        'id_status_registrasi' => 'nullable',
    ]);

    $jenis = DB::table('registrasi')->where('id_registrasi', $id)->first();

    if ($jenis) {
        $currentTime = now('Asia/Jakarta');

        // Mengambil data yang ada di database
        $existingData = (array) $jenis;

        // Menggabungkan data yang ada dengan data yang baru
        $data = array_merge($existingData, $request->all());

        // Menghapus kunci 'id_waktu_kegiatan' agar tidak ikut terupdate
        unset($data['id_registrasi']);
        
        // Melakukan pembaruan hanya jika ada data yang berubah
        if (!empty(array_diff_assoc($existingData, $data))) {
            $data['updated_at'] = $currentTime;

            DB::table('registrasi')->where('id_registrasi', $id)->update($data);
            return response()->json(['message' => 'Data berhasil diupdate'], 200);
        } else {
            return response()->json(['message' => 'Tidak ada perubahan data'], 200);
        }
    }
    return response()->json(['error' => 'Data tidak ditemukan'], 404);
}





    
}

