/*
 Navicat Premium Data Transfer

 Source Server         : perdin
 Source Server Type    : MySQL
 Source Server Version : 100422
 Source Host           : localhost:3306
 Source Schema         : e_rt

 Target Server Type    : MySQL
 Target Server Version : 100422
 File Encoding         : 65001

 Date: 25/10/2023 11:35:30
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ms_area
-- ----------------------------
DROP TABLE IF EXISTS `ms_area`;
CREATE TABLE `ms_area`  (
  `id_area` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `area` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `foto` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_by` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` time(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_area`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ms_barang_kondisi
-- ----------------------------
DROP TABLE IF EXISTS `ms_barang_kondisi`;
CREATE TABLE `ms_barang_kondisi`  (
  `id_kondisi` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kondisi` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_by` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` time(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_kondisi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ms_barang_security
-- ----------------------------
DROP TABLE IF EXISTS `ms_barang_security`;
CREATE TABLE `ms_barang_security`  (
  `id_barang` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  `created_by` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` time(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_barang`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ms_departemen
-- ----------------------------
DROP TABLE IF EXISTS `ms_departemen`;
CREATE TABLE `ms_departemen`  (
  `id_dept` int(11) NOT NULL AUTO_INCREMENT,
  `id_divisi` int(11) NULL DEFAULT NULL,
  `id_direktorat` int(11) NULL DEFAULT NULL,
  `departemen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jenis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'Non Pendidikan',
  `sort` int(11) NULL DEFAULT 0,
  `npsn` int(11) NULL DEFAULT NULL,
  `kepala` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nip_kepala` int(25) NULL DEFAULT NULL,
  `wakasis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nip_wakasis` int(25) NULL DEFAULT NULL,
  `wakakur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nip_wakakur` int(25) NULL DEFAULT NULL,
  PRIMARY KEY (`id_dept`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ms_direktorat
-- ----------------------------
DROP TABLE IF EXISTS `ms_direktorat`;
CREATE TABLE `ms_direktorat`  (
  `id_direktorat` int(11) NOT NULL AUTO_INCREMENT,
  `direktorat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kepala` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_direktorat`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ms_divisi
-- ----------------------------
DROP TABLE IF EXISTS `ms_divisi`;
CREATE TABLE `ms_divisi`  (
  `id_divisi` int(11) NOT NULL AUTO_INCREMENT,
  `id_direktorat` int(11) NULL DEFAULT NULL,
  `divisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kepala` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_divisi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ms_jadwal
-- ----------------------------
DROP TABLE IF EXISTS `ms_jadwal`;
CREATE TABLE `ms_jadwal`  (
  `id_jadwal` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `start_time` time(0) NULL DEFAULT NULL,
  `end_time` time(0) NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_jadwal`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ms_kendaraan
-- ----------------------------
DROP TABLE IF EXISTS `ms_kendaraan`;
CREATE TABLE `ms_kendaraan`  (
  `id_kendaraan` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `jenis_kendaraan` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `merk` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `brand` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `warna` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kapasitas` int(10) NULL DEFAULT 0,
  `jml_kendaraan` int(10) NULL DEFAULT 0,
  `tgl_stnk` date NULL DEFAULT NULL,
  `foto_stnk` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `no_asuransi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tgl_pajak` date NULL DEFAULT NULL,
  `foto_pajak` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tgl_service_terakhir` date NULL DEFAULT NULL,
  `tgl_terakhir_steam` date NULL DEFAULT NULL,
  `tahun_kendaraan` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `no_polisi` int(10) NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_kendaraan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ms_kendaraan_asuransi
-- ----------------------------
DROP TABLE IF EXISTS `ms_kendaraan_asuransi`;
CREATE TABLE `ms_kendaraan_asuransi`  (
  `id_asuransi` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_kendaraan` int(11) NULL DEFAULT NULL,
  `no_asuransi` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `asuransi` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `masa_berlaku_asuransi` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_asuransi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ms_kendaraan_pajak
-- ----------------------------
DROP TABLE IF EXISTS `ms_kendaraan_pajak`;
CREATE TABLE `ms_kendaraan_pajak`  (
  `id_pajak` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_kendaraan` int(11) NULL DEFAULT NULL,
  `tgl_pajak` date NULL DEFAULT NULL,
  `foto_pajak` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_pajak`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ms_kendaraan_service
-- ----------------------------
DROP TABLE IF EXISTS `ms_kendaraan_service`;
CREATE TABLE `ms_kendaraan_service`  (
  `id_service` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_kendaraan` int(11) NULL DEFAULT NULL,
  `tgl_service_terakhir` date NULL DEFAULT NULL,
  `nota_service` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tempat_service` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_service`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ms_kendaraan_steam
-- ----------------------------
DROP TABLE IF EXISTS `ms_kendaraan_steam`;
CREATE TABLE `ms_kendaraan_steam`  (
  `id_steam` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_kendaraan` int(4) NULL DEFAULT NULL,
  `tgl_terakhir_steam` date NULL DEFAULT NULL,
  `nota_steam` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tempat_steam` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_steam`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ms_menu
-- ----------------------------
DROP TABLE IF EXISTS `ms_menu`;
CREATE TABLE `ms_menu`  (
  `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_sub` int(1) NULL DEFAULT 0,
  `url` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `links` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `icon` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sort` int(2) NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ms_menu_sub
-- ----------------------------
DROP TABLE IF EXISTS `ms_menu_sub`;
CREATE TABLE `ms_menu_sub`  (
  `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_menu` int(4) NULL DEFAULT NULL,
  `sub_menu` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `url` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `links` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `icon` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sort` int(2) NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ms_role
-- ----------------------------
DROP TABLE IF EXISTS `ms_role`;
CREATE TABLE `ms_role`  (
  `role` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `jenis` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sort` int(2) NULL DEFAULT NULL,
  PRIMARY KEY (`role`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ms_sesi_menu
-- ----------------------------
DROP TABLE IF EXISTS `ms_sesi_menu`;
CREATE TABLE `ms_sesi_menu`  (
  `id_sesi_menu` int(11) NULL DEFAULT NULL,
  `sesi_menu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ms_shift
-- ----------------------------
DROP TABLE IF EXISTS `ms_shift`;
CREATE TABLE `ms_shift`  (
  `id_shift` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shift` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `start_time` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `end_time` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_by` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` time(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_shift`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ms_status
-- ----------------------------
DROP TABLE IF EXISTS `ms_status`;
CREATE TABLE `ms_status`  (
  `id_status` int(11) NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ms_user
-- ----------------------------
DROP TABLE IF EXISTS `ms_user`;
CREATE TABLE `ms_user`  (
  `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `master_id` int(11) NULL DEFAULT NULL,
  `role` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ttd` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'default.png',
  `id_direktorat` int(11) NULL DEFAULT NULL,
  `id_divisi` int(11) NULL DEFAULT NULL,
  `id_dept` int(11) NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  `is_action` int(1) NULL DEFAULT 0,
  `last_history` int(11) NULL DEFAULT 1,
  `last_login` int(11) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_access_menu
-- ----------------------------
DROP TABLE IF EXISTS `tb_access_menu`;
CREATE TABLE `tb_access_menu`  (
  `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_user` int(4) NULL DEFAULT NULL,
  `id_menu` int(4) NULL DEFAULT NULL,
  `id_menu_sub` int(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 126 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_booking_transport
-- ----------------------------
DROP TABLE IF EXISTS `tb_booking_transport`;
CREATE TABLE `tb_booking_transport`  (
  `id_booking` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_booking` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_direktorat` int(11) NULL DEFAULT NULL,
  `direktorat` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_divisi` int(11) NULL DEFAULT NULL,
  `divisi` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_dept` int(11) NULL DEFAULT NULL,
  `departemen` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nama` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pemohon_ttd` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tanggal_pemakaian` date NULL DEFAULT NULL,
  `type_pemakaian` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cara_pemakaian` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `jam_keberangkatan` time(0) NULL DEFAULT NULL,
  `jam_kembali` time(0) NULL DEFAULT NULL,
  `tujuan` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `acara_kegiatan` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `jumlah_peserta` decimal(11, 0) NULL DEFAULT 0,
  `jumlah_kendaraan` decimal(11, 0) NULL DEFAULT 0,
  `anggaran` int(11) NULL DEFAULT 0,
  `driver` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `jam_berangkat` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `km_berangkat` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `jam_pulang` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `km_kembali` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tgl_berangkat` date NULL DEFAULT NULL,
  `id_kendaraan` int(11) NULL DEFAULT NULL,
  `jenis_kendaraan` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_etol` int(11) NULL DEFAULT NULL,
  `saldo_awal_etol` int(11) NULL DEFAULT 0,
  `top_up` int(11) NULL DEFAULT 0,
  `biaya_etol` int(11) NULL DEFAULT 0,
  `total_pengeluaran` int(11) NULL DEFAULT 0,
  `saldo_akhir_etol` int(11) NULL DEFAULT 0,
  `bensin` int(11) NULL DEFAULT 0,
  `ttd_form_pengeluaran` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `approved_kadep_by` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `approved_kadep_at` int(4) NULL DEFAULT NULL,
  `approved_kadep_ttd` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `approved_kadiv_by` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `approved_kadiv_at` int(4) NULL DEFAULT NULL,
  `approved_kadiv_ttd` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `approved_rt_by` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `approved_rt_at` int(4) NULL DEFAULT NULL,
  `approved_rt_ttd` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ditolak_by` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ditolak_ket` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ditolak_at` int(4) NULL DEFAULT NULL,
  `ditolak_ttd` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `selesai_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `selesai_at` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_status` int(11) NULL DEFAULT 1,
  `status` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_by` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_booking`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_daftar_menu
-- ----------------------------
DROP TABLE IF EXISTS `tb_daftar_menu`;
CREATE TABLE `tb_daftar_menu`  (
  `id_menu` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tgl_menu` date NULL DEFAULT NULL,
  `menu_1` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `menu_2` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `menu_3` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `menu_4` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_sesi_menu` int(14) NULL DEFAULT NULL,
  `sesi_menu` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rating` int(11) NULL DEFAULT NULL,
  `saran` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  `created_by` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_menu`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 44 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_informasi
-- ----------------------------
DROP TABLE IF EXISTS `tb_informasi`;
CREATE TABLE `tb_informasi`  (
  `id_informasi` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_kegiatan` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `type_kegiatan` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tgl_kegiatan` date NULL DEFAULT NULL,
  `waktu_kegiatan` time(0) NULL DEFAULT NULL,
  `tempat_kegiatan` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  `created_by` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` time(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_informasi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_inventaris
-- ----------------------------
DROP TABLE IF EXISTS `tb_inventaris`;
CREATE TABLE `tb_inventaris`  (
  `id_inventaris` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) NULL DEFAULT NULL,
  `nama_barang` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tgl_pengadaan_barang` date NULL DEFAULT NULL,
  `id_kondisi` int(11) NULL DEFAULT NULL,
  `kondisi` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tempat_barang_disimpan` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `posisi_barang` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  `created_by` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_inventaris`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_jadwal_transport
-- ----------------------------
DROP TABLE IF EXISTS `tb_jadwal_transport`;
CREATE TABLE `tb_jadwal_transport`  (
  `id_jadwal_transport` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `start_time` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `end_time` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_booking` int(11) NULL DEFAULT NULL,
  `kode_booking` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_jadwal_transport`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_keamanan
-- ----------------------------
DROP TABLE IF EXISTS `tb_keamanan`;
CREATE TABLE `tb_keamanan`  (
  `id_keamanan` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NULL DEFAULT NULL,
  `kode_kejadian` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kejadian` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kronologi` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_area` int(11) NULL DEFAULT NULL,
  `area` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tgl_kejadian` date NULL DEFAULT NULL,
  `waktu_kejadian` time(0) NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  `created_by` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_keamanan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_kebersihan_dapur
-- ----------------------------
DROP TABLE IF EXISTS `tb_kebersihan_dapur`;
CREATE TABLE `tb_kebersihan_dapur`  (
  `id_kebersihan_dapur` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tgl_pemantauan` date NULL DEFAULT NULL,
  `id_shift` int(11) NULL DEFAULT NULL,
  `shift` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_area` int(11) NULL DEFAULT NULL,
  `area` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `foto` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `keterangan` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  `created_by` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_kebersihan_dapur`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_pemeliharaan_transport
-- ----------------------------
DROP TABLE IF EXISTS `tb_pemeliharaan_transport`;
CREATE TABLE `tb_pemeliharaan_transport`  (
  `id_pemeliharaan` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_kendaraan` int(11) NULL DEFAULT NULL,
  `jenis_kendaraan` int(11) NULL DEFAULT NULL,
  `id_steam` int(11) NULL DEFAULT NULL,
  `tgl_terakhir_steam` date NULL DEFAULT NULL,
  `id_pajak` int(11) NULL DEFAULT NULL,
  `tgl_pajak` date NULL DEFAULT NULL,
  `id_asuransi` int(11) NULL DEFAULT NULL,
  `no_asuransi` int(11) NULL DEFAULT NULL,
  `id_service` int(11) NULL DEFAULT NULL,
  `tgl_service_terakhir` date NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_pemeliharaan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_pengawasan
-- ----------------------------
DROP TABLE IF EXISTS `tb_pengawasan`;
CREATE TABLE `tb_pengawasan`  (
  `id_pengawasan` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_shift` int(11) NULL DEFAULT NULL,
  `shift` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_area` int(11) NULL DEFAULT NULL,
  `area` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `foto` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  `created_by` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_pengawasan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_penilaian_saran
-- ----------------------------
DROP TABLE IF EXISTS `tb_penilaian_saran`;
CREATE TABLE `tb_penilaian_saran`  (
  `id_penilaian` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NULL DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tgl_penilaian` date NULL DEFAULT NULL,
  `rating` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `saran` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  `created_by` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_penilaian`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_petugas_dapur
-- ----------------------------
DROP TABLE IF EXISTS `tb_petugas_dapur`;
CREATE TABLE `tb_petugas_dapur`  (
  `id_petugas_dapur` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_shift` int(11) NULL DEFAULT NULL,
  `shift` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `foto` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  `created_by` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_petugas_dapur`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_porsi_makanan
-- ----------------------------
DROP TABLE IF EXISTS `tb_porsi_makanan`;
CREATE TABLE `tb_porsi_makanan`  (
  `id_porsi_makanan` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tgl_produksi` date NULL DEFAULT NULL,
  `id_sesi_menu` int(11) NULL DEFAULT NULL,
  `sesi_menu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `jumlah_produksi` int(11) NULL DEFAULT NULL,
  `jumlah_pembagian` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `jumlah_persediaan` int(11) NULL DEFAULT NULL,
  `keterangan` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `foto` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  `created_by` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_porsi_makanan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
