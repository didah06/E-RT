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

 Date: 12/10/2023 13:54:23
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
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2023-06-21-021252', 'App\\Database\\Migrations\\User', 'default', 'App', 1687313781, 1);

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
-- Records of ms_departemen
-- ----------------------------
INSERT INTO `ms_departemen` VALUES (1, 1, 1, 'REN, BANG & EVALUASI KINERJA SDI', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (2, 1, 1, 'ADMINISTRASI SDI & REMUNERASI', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (3, 2, 1, 'SEKRETARIAT PTSP & EVENT ORGANIZER', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (4, 2, 1, 'LEGAL & KERJASAMA', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (5, 3, 2, 'RUMAH TANGGA', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (6, 3, 2, 'IT', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (7, 3, 2, 'PEMELIHARAAN & SARPRAS', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (8, 3, 2, 'PERENCANAAN & PROJECT BUILDING', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (9, 4, 3, 'PESANTREN & ASRAMA', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (10, 4, 3, 'TPQ', 'Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (11, 4, 3, 'MT', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (12, 5, 4, 'TK', 'Pendidikan', 0, 20266533, 'Siti Rohmah, S.Pd', NULL, '-', NULL, 'YuliantI, S.Pd', NULL);
INSERT INTO `ms_departemen` VALUES (13, 5, 4, 'SDIT', 'Pendidikan', 0, 20247304, 'Swandaru, M.Pd', NULL, 'Nita Oktifa, S.Pd', NULL, 'Syahru Zein, SS', NULL);
INSERT INTO `ms_departemen` VALUES (14, 5, 4, 'SMPI', 'Pendidikan', 0, 20275884, 'Mad Sholeh, M.Pd', NULL, 'Medina, S.Pd', NULL, 'Irvan Yulidar, S.Pd', NULL);
INSERT INTO `ms_departemen` VALUES (15, 12, 4, 'MTS', 'Pendidikan', 0, 20279711, 'Suyatno, S.Si., M.Pd', NULL, 'Siti Andriyani, S.Pd', NULL, 'Asenih, S.Pd', NULL);
INSERT INTO `ms_departemen` VALUES (16, 12, 4, 'MA', 'Pendidikan', 0, 20277149, 'Ira Asmara, S.Pd., MM', NULL, 'Yunus Pribadi, Lc', NULL, 'Hari Abdusalam, S.Pd', NULL);
INSERT INTO `ms_departemen` VALUES (17, 5, 4, 'DIREKTORAT PENDIDIKAN', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (18, 6, 4, 'STAI', 'Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (19, 7, 7, 'QA/QC & SPI (AKREDITASI BAN)', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (20, 7, 7, 'BISPRO (SMM ISO)', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (21, 8, 5, 'ACCOUNTING/PPIC', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (22, 8, 5, 'FINANCE', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (23, 8, 5, 'PURCHASING', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (24, 9, 6, 'KOMINFO', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (25, 9, 6, 'MARKPROM', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (26, 10, 6, 'AHA MART', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (27, 10, 6, 'AFG', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (28, 10, 6, 'AGS', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (29, 10, 6, 'AHA TRANS', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (30, 10, 6, 'AHA MUSIC COURSE', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (31, 10, 6, 'AHA AGRO', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (32, 10, 6, 'VOKASI CENTER AHA', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (33, 10, 6, 'AHA GARMENT', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (34, 10, 6, 'AHA MEDICAL CENTER', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (35, 10, 6, 'AHA CATERING', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (36, 10, 6, 'AHA LAUNDRY', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (37, 10, 6, 'AHA BOOK STORE', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (38, 10, 6, 'AHA PROPERTY', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (39, 11, 7, 'KBIH', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (40, 11, 7, 'LEMBAGA DAKWAH', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (41, 11, 7, 'LAZIS AL-HAMIDIYAH', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_departemen` VALUES (42, 11, 7, 'LEMBAGA TILAWAH & TAHFIDZ AL-QURAN (LTTQ)', 'Non Pendidikan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
-- Records of ms_direktorat
-- ----------------------------
INSERT INTO `ms_direktorat` VALUES (1, 'SUMBER DAYA INSANI, SEKRETARIAT, LEGAL & KERJASAMA', 'Achmad Firdaus, Mm');
INSERT INTO `ms_direktorat` VALUES (2, 'SUMBER DAYA SARANA & IT', 'Rahmat Fajar Trianto, ST');
INSERT INTO `ms_direktorat` VALUES (3, 'KEPALA PENGASUH PESANTREN', 'Prof. Dr. KH. Oman Fathurahman, M.Hum');
INSERT INTO `ms_direktorat` VALUES (4, 'PENDIDIKAN', 'Dr. Farida Wulandari, M. Pd');
INSERT INTO `ms_direktorat` VALUES (5, 'KEUANGAN, PURCHASING & PPIC', 'Hj. Zubaidah, SE');
INSERT INTO `ms_direktorat` VALUES (6, 'KOMINFO & PENGEMBANGAN BISNIS/INVESTASI', 'M. Rifky Wijaya, ST., M.Sc');
INSERT INTO `ms_direktorat` VALUES (7, '--NON DIREKTORAT--', NULL);

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
-- Records of ms_divisi
-- ----------------------------
INSERT INTO `ms_divisi` VALUES (1, 1, 'SUMBER DAYA INSANI', 'Wahyudi, S.Pd., MM.');
INSERT INTO `ms_divisi` VALUES (2, 1, 'SEKRETARIAT, LEGAL & KERJASAMA YIA', 'M. Timmi Fauzan, SE.');
INSERT INTO `ms_divisi` VALUES (3, 2, 'SUMBER DAYA SARANA & IT', 'M. Reza Fauzan Bobby, M.Ds');
INSERT INTO `ms_divisi` VALUES (4, 3, 'PESANTREN & ASRAMA', 'Suma Wijaya, M.IKom.');
INSERT INTO `ms_divisi` VALUES (5, 4, 'PAUD - DIKDASMEN', 'Hadi Sukoco, S.Si');
INSERT INTO `ms_divisi` VALUES (6, 4, 'DIKTI', '');
INSERT INTO `ms_divisi` VALUES (7, 7, 'PENJAMINAN MUTU', 'R. Muh. Iman Sasraningrat, ST. MBA');
INSERT INTO `ms_divisi` VALUES (8, 5, 'KEUANGAN, PURCHASING & PPIC', 'Rini Sugiyanto, S.E.');
INSERT INTO `ms_divisi` VALUES (9, 6, 'KOMINFO & MARKPROM', 'Eky Akmal');
INSERT INTO `ms_divisi` VALUES (10, 6, 'PENGEMBANGAN BISNIS & INVESTASI', 'M. Ilham Sjarif, S.T., M.M.');
INSERT INTO `ms_divisi` VALUES (11, 7, 'DAKWAH', '');
INSERT INTO `ms_divisi` VALUES (12, 4, 'MADRASAH', '');

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
-- Records of ms_jadwal
-- ----------------------------
INSERT INTO `ms_jadwal` VALUES (1, '00:00:00', '01:00:00', 1);
INSERT INTO `ms_jadwal` VALUES (2, '01:00:00', '02:00:00', 1);
INSERT INTO `ms_jadwal` VALUES (3, '02:00:00', '03:00:00', 1);
INSERT INTO `ms_jadwal` VALUES (4, '03:00:00', '04:00:00', 1);
INSERT INTO `ms_jadwal` VALUES (5, '04:00:00', '05:00:00', 1);
INSERT INTO `ms_jadwal` VALUES (6, '05:00:00', '06:00:00', 1);
INSERT INTO `ms_jadwal` VALUES (7, '06:00:00', '07:00:00', 1);
INSERT INTO `ms_jadwal` VALUES (8, '07:00:00', '08:00:00', 1);
INSERT INTO `ms_jadwal` VALUES (9, '08:00:00', '09:00:00', 1);
INSERT INTO `ms_jadwal` VALUES (10, '09:00:00', '10:00:00', 1);
INSERT INTO `ms_jadwal` VALUES (11, '10:00:00', '11:00:00', 1);
INSERT INTO `ms_jadwal` VALUES (12, '11:00:00', '12:00:00', 1);
INSERT INTO `ms_jadwal` VALUES (13, '12:00:00', '13:00:00', 1);
INSERT INTO `ms_jadwal` VALUES (14, '14:00:00', '15:00:00', 1);
INSERT INTO `ms_jadwal` VALUES (15, '15:00:00', '16:00:00', 1);
INSERT INTO `ms_jadwal` VALUES (16, '16:00:00', '17:00:00', 1);
INSERT INTO `ms_jadwal` VALUES (17, '17:00:00', '18:00:00', 1);
INSERT INTO `ms_jadwal` VALUES (18, '18:00:00', '19:00:00', 1);
INSERT INTO `ms_jadwal` VALUES (19, '19:00:00', '20:00:00', 1);
INSERT INTO `ms_jadwal` VALUES (20, '20:00:00', '21:00:00', 1);
INSERT INTO `ms_jadwal` VALUES (21, '21:00:00', '22:00:00', 1);
INSERT INTO `ms_jadwal` VALUES (22, '22:00:00', '23:00:00', 1);
INSERT INTO `ms_jadwal` VALUES (23, '23:00:00', '00:00:00', 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_kendaraan
-- ----------------------------
INSERT INTO `ms_kendaraan` VALUES (2, 'motor', 'honda', 'honda', 'hitam', 2, 3, '2023-10-05', '1696472864_0a40240378563c11f428.png', 'fgdfgf57', '2023-10-06', '1696473092_5788cfcf8e09fae8f720.png', NULL, NULL, '2019', 0, 1);
INSERT INTO `ms_kendaraan` VALUES (5, 'mobil', 'apv', 'honda', 'putih', 8, 5, '2023-10-03', '1696305903_bda1d2fb6a12bae4397a.jpg', 'ff', NULL, NULL, NULL, NULL, '2019', 0, 1);
INSERT INTO `ms_kendaraan` VALUES (6, 'mobil', 'apv', 'honda', 'putih', 8, 5, '2023-10-03', '1696305904_3ac7f9c6b3d43e15ea13.jpg', NULL, NULL, NULL, NULL, NULL, '2019', 0, 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_kendaraan_asuransi
-- ----------------------------
INSERT INTO `ms_kendaraan_asuransi` VALUES (13, 2, '894djsdjd', 'adira', '2023-10-03', 1);
INSERT INTO `ms_kendaraan_asuransi` VALUES (24, 2, 'fgdfgf57', 'test2', '2023-10-04', 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_kendaraan_pajak
-- ----------------------------
INSERT INTO `ms_kendaraan_pajak` VALUES (9, 2, '2023-10-06', '1696473092_5788cfcf8e09fae8f720.png', 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_kendaraan_service
-- ----------------------------
INSERT INTO `ms_kendaraan_service` VALUES (4, 2, '2023-10-13', '1696387010_9d93eed57a7d325c6ca0.png', 'depok', 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_kendaraan_steam
-- ----------------------------
INSERT INTO `ms_kendaraan_steam` VALUES (1, 2, '2023-10-05', '1696474284_352a2eb086ee16a58a42.png', 'depok', 1);

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
-- Records of ms_menu
-- ----------------------------
INSERT INTO `ms_menu` VALUES (1, 'Master User', 0, 'user', '(user)', 'zmdi zmdi-accounts-alt', 4, 1);
INSERT INTO `ms_menu` VALUES (2, 'User Rumah Tangga', 1, 'rt', '(rt)', 'zmdi zmdi-accounts', 5, 1);
INSERT INTO `ms_menu` VALUES (3, 'Pengaturan Akses', 0, 'akses', '(akses)', 'zmdi zmdi-account-box-o', 6, 1);
INSERT INTO `ms_menu` VALUES (4, 'Transportasi', 1, '#transportasi', '#(transportasi)', 'zmdi zmdi-car-taxi', 7, 1);
INSERT INTO `ms_menu` VALUES (5, 'Keamanan', 0, 'keamanan', '(#keamanan)', 'zmdi zmdi-male-alt', 8, 1);
INSERT INTO `ms_menu` VALUES (6, 'Dapur', 0, 'dapur', '(#dapur)', 'zmdi zmdi-store', 9, 1);
INSERT INTO `ms_menu` VALUES (7, 'Seragam', 0, 'seragam', '(#seragam)', 'zmdi zmdi-male-female', 10, 1);
INSERT INTO `ms_menu` VALUES (8, 'Fotocopy', 0, 'fotokopi', '(#fotokopi)', 'zmdi zmdi-file', 11, 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_menu_sub
-- ----------------------------
INSERT INTO `ms_menu_sub` VALUES (1, 4, 'Booking Transportasi', 'booking', '(booking)', 'zmdi zmdi-plus-circle-o', 1, 1);
INSERT INTO `ms_menu_sub` VALUES (2, 4, 'Jadwal Transportasi', 'jadwal', '(jadwal)', 'zmdi zmdi-file-text', 2, 1);
INSERT INTO `ms_menu_sub` VALUES (3, 4, 'Record Perjalanan', 'record', '(record)', 'zmdi zmdi-truck', 3, 1);
INSERT INTO `ms_menu_sub` VALUES (5, 4, 'Inventaris Transport', 'inventaris', '(inventaris)', 'zmdi zmdi-check-square', 4, 1);
INSERT INTO `ms_menu_sub` VALUES (6, 2, 'Driver', 'driver', '(driver)', 'zmdi zmdi-accounts', 1, 1);
INSERT INTO `ms_menu_sub` VALUES (7, 2, 'Security', 'security', '(security)', 'zmdi zmdi-accounts', 2, 1);
INSERT INTO `ms_menu_sub` VALUES (8, 2, 'Dapur', 'dapur', '(dapur)', 'zmdi zmdi-accounts', 3, 1);

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
-- Records of ms_role
-- ----------------------------
INSERT INTO `ms_role` VALUES ('Dapur', 'Non Admin', 11);
INSERT INTO `ms_role` VALUES ('Developer', 'Admin', 1);
INSERT INTO `ms_role` VALUES ('Direktur', 'Non Admin', 2);
INSERT INTO `ms_role` VALUES ('Driver', 'Non Admin', 10);
INSERT INTO `ms_role` VALUES ('Kadep', 'Non Admin', 4);
INSERT INTO `ms_role` VALUES ('Kadiv', 'Non Admin', 3);
INSERT INTO `ms_role` VALUES ('PTK', 'Non Admin', 5);
INSERT INTO `ms_role` VALUES ('RT', 'Non Admin', 6);
INSERT INTO `ms_role` VALUES ('Satpam', 'Non Admin', 9);
INSERT INTO `ms_role` VALUES ('Staf', 'Non Admin', 8);
INSERT INTO `ms_role` VALUES ('TU', 'Non Admin', 7);

-- ----------------------------
-- Table structure for ms_status
-- ----------------------------
DROP TABLE IF EXISTS `ms_status`;
CREATE TABLE `ms_status`  (
  `id_status` int(11) NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_status
-- ----------------------------
INSERT INTO `ms_status` VALUES (1, 'baru');
INSERT INTO `ms_status` VALUES (2, 'approved kadiv');
INSERT INTO `ms_status` VALUES (3, 'approved kadep');
INSERT INTO `ms_status` VALUES (4, 'diproses');
INSERT INTO `ms_status` VALUES (5, 'ditolak');
INSERT INTO `ms_status` VALUES (6, 'selesai');

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
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_user
-- ----------------------------
INSERT INTO `ms_user` VALUES (1, 76, 'Developer', 'default.png', 2, 3, 6, 1, 0, 1, 1);
INSERT INTO `ms_user` VALUES (2, 1674, 'Developer', '16969885816845.png', 2, 3, 6, 1, 0, 1, 1696927294);
INSERT INTO `ms_user` VALUES (13, 459, 'Driver', 'default.png', 2, 3, 5, 1, 0, 1, 1);
INSERT INTO `ms_user` VALUES (21, 496, 'Staf', 'default.png', 4, 5, 17, 1, 0, 1, 1);
INSERT INTO `ms_user` VALUES (22, 191, 'Direktur', 'default.png', 7, NULL, NULL, 1, 0, 1, 1);
INSERT INTO `ms_user` VALUES (23, 112, 'Direktur', 'default.png', 1, NULL, NULL, 1, 0, 1, 1);
INSERT INTO `ms_user` VALUES (24, 174, 'Direktur', 'default.png', 7, NULL, NULL, 1, 0, 1, 1);
INSERT INTO `ms_user` VALUES (25, 67, 'Kadep', 'default.png', 6, 10, 26, 1, 0, 1, 1);
INSERT INTO `ms_user` VALUES (26, 99, 'Kadiv', 'default.png', 3, 4, NULL, 1, 0, 1, 1);
INSERT INTO `ms_user` VALUES (27, 193, 'Satpam', 'default.png', 2, 3, 5, 1, 0, 1, 1);

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
-- Records of tb_booking_transport
-- ----------------------------
INSERT INTO `tb_booking_transport` VALUES (3, 'RT-MJ2O4F', 2, 'SUMBER DAYA SARANA & IT', 3, 'SUMBER DAYA SARANA & IT', 6, 'IT', 'Didah Siti Nursaadah', NULL, '2023-09-27', '2', 'Jemput', '00:00:00', '01:00:00', 'test', 'test test test', 5, 1, 1, 'Andi Mizar', '00:00:00', '80 km', '01:00:00', '80 km', '2023-09-27', 5, 'mobil', NULL, 50000, 50000, 25000, 125000, 75000, 100000, '16969130224016.png', 'Didah Siti Nursaadah', 1696838940, '1696838940209.png', 'Didah Siti Nursaadah', 1696840067, '1696838940209.png', 'Didah Siti Nursaadah', 1696841288, '1696838940209.png', NULL, NULL, NULL, NULL, NULL, NULL, 6, 'selesai', NULL, NULL, 1);
INSERT INTO `tb_booking_transport` VALUES (4, 'RT-IONZLH', 2, 'SUMBER DAYA SARANA & IT', 3, 'SUMBER DAYA SARANA & IT', 6, 'IT', 'Didah Siti Nursaadah', NULL, '2023-09-27', '2', 'Antar Jemput Ditunggu', '02:00:00', NULL, 'test', 'test test', 5, 0, 100000, 'Arif Fadilah', NULL, NULL, NULL, NULL, NULL, 5, 'mobil', NULL, 0, 0, 0, 0, 0, 0, NULL, 'Didah Siti Nursaadah', 1696824200, NULL, 'Didah Siti Nursaadah', 1696927529, '16969130224016.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'approved kadiv', NULL, NULL, 1);
INSERT INTO `tb_booking_transport` VALUES (5, 'RT-01EEBC', 2, 'SUMBER DAYA SARANA & IT', 3, 'SUMBER DAYA SARANA & IT', 6, 'IT', 'Didah Siti Nursaadah', NULL, '2023-09-27', '2', 'Jemput', '00:00:00', NULL, 'test', 'test test', 5, 1, 100000, 'Arif Fadilah', NULL, NULL, NULL, NULL, NULL, 5, 'mobil', NULL, 100000, 0, 0, 0, 0, 0, NULL, 'Didah Siti Nursaadah', 1696838310, '16968383106668.png', 'Didah Siti Nursaadah', 1696988496, '16969884967290.png', 'Didah Siti Nursaadah', 1696988581, '16969885816845.png', NULL, NULL, NULL, NULL, NULL, NULL, 4, 'diproses', NULL, NULL, 1);
INSERT INTO `tb_booking_transport` VALUES (7, 'RT-I31C6U', 2, 'SUMBER DAYA SARANA & IT', 3, 'SUMBER DAYA SARANA & IT', 6, 'IT', 'Didah Siti Nursaadah', NULL, '2023-09-27', '2', 'Antar Jemput Ditunggu', '02:00:00', NULL, 'test', 'test test', 10, 0, 100000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, 'Didah Siti Nursaadah', 1696838355, '16968383106668.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'approved kadep', NULL, NULL, 1);
INSERT INTO `tb_booking_transport` VALUES (10, 'RT-BEHAP0', 2, 'SUMBER DAYA SARANA & IT', 3, 'SUMBER DAYA SARANA & IT', 6, 'IT', 'Didah Siti Nursaadah', NULL, '2023-09-29', '2', 'Jemput', '01:00:00', '02:00:00', 'test', 'test test', 5, 0, 100000, NULL, '01:00:00', '80 km', '02:00:00', '80 km', '2023-09-29', NULL, NULL, NULL, 0, 100000, 50000, 200000, 150000, 150000, '16969130224016.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, 'selesai', NULL, NULL, 1);
INSERT INTO `tb_booking_transport` VALUES (11, 'RT-0XP96R', 2, 'SUMBER DAYA SARANA & IT', 3, 'SUMBER DAYA SARANA & IT', 6, 'IT', 'Didah Siti Nursaadah', NULL, '2023-09-27', '2', 'Antar Jemput Ditunggu', '03:00:00', '04:00:00', 'test', 'test test', 5, 1, 100000, 'Andi Mizar', '03:00:00', '80 km', '04:00:00', '80 km', '2023-09-27', 1, 'mobil', NULL, 100000, 100000, 50000, 100000, 150000, 50000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 'selesai', NULL, NULL, 1);
INSERT INTO `tb_booking_transport` VALUES (12, 'RT-LTMTJ5', 2, 'SUMBER DAYA SARANA & IT', 3, 'SUMBER DAYA SARANA & IT', 6, 'IT', 'Didah Siti Nursaadah', NULL, '2023-09-26', '2', 'Jemput', '11:00:00', '15:00:00', 'test', 'test test', 20, 4, 100000, NULL, '11:00:00', '80 km', '15:00:00', '80 km', '2023-09-26', 3, 'mobil', NULL, 0, 200000, 100000, 250000, 300000, 150000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Didah Siti Nursaadah', 1695700430, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, 'selesai', NULL, NULL, 1);
INSERT INTO `tb_booking_transport` VALUES (19, 'RT-20231009G2FAQE', 2, 'SUMBER DAYA SARANA & IT', 3, 'SUMBER DAYA SARANA & IT', 6, 'IT', 'Didah Siti Nursaadah', NULL, '2023-10-10', '2', 'Antar', '09:00:00', '12:00:00', 'jakarta convention center', 'bazar buku', 20, 0, 100000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, 'Didah Siti Nursaadah', 1696900018, '1696838940209.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'approved kadep', NULL, NULL, 1);
INSERT INTO `tb_booking_transport` VALUES (22, 'RT-20231009V69H1P', 2, 'SUMBER DAYA SARANA & IT', 3, 'SUMBER DAYA SARANA & IT', 6, 'IT', 'Didah Siti Nursaadah', NULL, '2023-10-12', '2', 'Jemput', '09:00:00', '10:00:00', 'RS Bhakti Yudha', 'test', 20, 0, 100000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, 'Didah Siti Nursaadah', 1696913022, '16969130224016.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'approved kadep', NULL, NULL, 1);
INSERT INTO `tb_booking_transport` VALUES (23, 'RT-20231009SN69OP', 2, 'SUMBER DAYA SARANA & IT', 3, 'SUMBER DAYA SARANA & IT', 6, 'IT', 'Didah Siti Nursaadah', NULL, '2023-10-13', '2', 'Jemput', '09:00:00', '10:00:00', 'test', 'test test', 5, 0, 200000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, 'Didah Siti Nursaadah', 1696987177, '16969871774953.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'approved kadep', NULL, NULL, 1);
INSERT INTO `tb_booking_transport` VALUES (27, 'RT-20231009P1DNHM', 2, 'SUMBER DAYA SARANA & IT', 3, 'SUMBER DAYA SARANA & IT', 6, 'IT', 'Didah Siti Nursaadah', NULL, '2023-10-21', '2', 'Jemput', '06:00:00', '07:00:00', 'test', 'test test', 10, 0, 100000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Didah Siti Nursaadah', 'test', 1696987412, '16969874125805.png', NULL, NULL, 5, 'ditolak', NULL, NULL, 1);
INSERT INTO `tb_booking_transport` VALUES (28, 'RT-20231009IU9UJO', 2, 'SUMBER DAYA SARANA & IT', 3, 'SUMBER DAYA SARANA & IT', 6, 'IT', 'Didah Siti Nursaadah', NULL, '2023-10-18', '2', 'Jemput', '10:00:00', '09:00:00', 'test', 'test test', 10, 0, 200000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, 'Didah Siti Nursaadah', 1696988194, '16969881945212.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'approved kadep', NULL, NULL, 1);
INSERT INTO `tb_booking_transport` VALUES (29, 'RT-20231009FD731S', 2, 'SUMBER DAYA SARANA & IT', 3, 'SUMBER DAYA SARANA & IT', 6, 'IT', 'Didah Siti Nursaadah', NULL, '2023-10-12', '2', 'Jemput', '06:00:00', '07:00:00', 'test', 'test test', 10, 0, 50000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'baru', NULL, NULL, 1);
INSERT INTO `tb_booking_transport` VALUES (30, 'RT-20231010104KJK', 2, 'SUMBER DAYA SARANA & IT', 3, 'SUMBER DAYA SARANA & IT', 6, 'IT', 'Didah Siti Nursaadah', '16969130224016.png', '2023-10-13', '2', 'Jemput', '11:00:00', '12:00:00', 'test', 'test test', 5, 0, 100000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'baru', NULL, NULL, 1);

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

SET FOREIGN_KEY_CHECKS = 1;
