
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