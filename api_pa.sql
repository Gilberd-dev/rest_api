
-- Cabang

CREATE PROCEDURE getCabang(IN cabangId INT)
SELECT * FROM cabang WHERE id_cabang = cabangId;

CREATE PROCEDURE getAllCabang()
SELECT * FROM cabang

CREATE PROCEDURE delCabang(IN cabangId INT)
DELETE FROM cabang WHERE id_cabang = cabangId 

-- Sektor

CREATE PROCEDURE getSektor(IN sektorId INT)
SELECT * FROM sektor WHERE id_sektor = sektorId;

CREATE PROCEDURE getAllSektor()
SELECT * FROM sektor

CREATE PROCEDURE delSektor(IN sektorId INT)
DELETE FROM sektor WHERE id_sektor = sektorId 

-- Jenis Kegiatan

CREATE PROCEDURE getJenis(IN jenisId INT)
SELECT * FROM jenis_kegiatan WHERE id_jenis_kegiatan = jenisId;

CREATE PROCEDURE getAllJenis()
SELECT * FROM jenis_kegiatan

CREATE PROCEDURE delJenis(IN jenisId INT)
DELETE FROM jenis_kegiatan WHERE id_jenis_kegiatan = jenisId 


-- Waktu Kegiatan


CREATE PROCEDURE getWaktu(IN waktuId INT)
SELECT * FROM waktu_kegiatan WHERE id_waktu_kegiatan = waktuId;

CREATE PROCEDURE getAllWaktu()
SELECT * FROM waktu_kegiatan

CREATE PROCEDURE delWaktu(IN waktuId INT)
DELETE FROM waktu_kegiatan WHERE id_waktu_kegiatan = waktuId 


ALTER TABLE `waktu_kegiatan` ADD  FOREIGN KEY (`id_jenis_kegiatan`) REFERENCES `jenis_kegiatan`(`id_jenis_kegiatan`)


-- Anggota

CREATE PROCEDURE getAnggota(IN AnggotaId INT)
SELECT * FROM anggota WHERE id_anggota = AnggotaId;

CREATE PROCEDURE getAllAnggota()
SELECT * FROM anggota

CREATE PROCEDURE delAnggota(IN AnggotaId INT)
DELETE FROM anggota WHERE id_anggota = AnggotaId 



-- Jabatan

CREATE PROCEDURE getjabatan(IN jabatanId INT)
SELECT * FROM jabatan WHERE id_jabatan = jabatanId;

CREATE PROCEDURE getAlljabatan()
SELECT * FROM jabatan

CREATE PROCEDURE deljabatan(IN jabatanId INT)
DELETE FROM jabatan WHERE id_jabatan = jabatanId 


-- Detail Pindah

CREATE PROCEDURE getdetail_pindah(IN detail_pindahId INT)
SELECT * FROM detail_pindah WHERE _id_det_red_pindah = detail_pindahId;

CREATE PROCEDURE getAlldetail_pindah()
SELECT * FROM detail_pindah

CREATE PROCEDURE deldetail_pindah(IN detail_pindahId INT)
DELETE FROM detail_pindah WHERE id_det_red_pindah= detail_pindahId 


-- Detail Head Pindah

CREATE PROCEDURE gethead_pindah(IN head_pindahId INT)
SELECT * FROM head_pindah WHERE id_head_red_pindah = head_pindahId;

CREATE PROCEDURE getAllhead_pindah()
SELECT * FROM head_pindah

CREATE PROCEDURE delhead_pindah(IN head_pindahId INT)
DELETE FROM head_pindah WHERE id_head_red_pindah= head_pindahId 

-- Detail Registrasi

CREATE PROCEDURE getregistrasi(IN registrasiId INT)
SELECT * FROM registrasi WHERE id_registrasi = registrasiId;

CREATE PROCEDURE getAllregistrasi()
SELECT * FROM registrasi

CREATE PROCEDURE delregistrasi(INregistrasiId INT)
DELETE FROM registrasi WHERE id_registrasi= registrasiId 