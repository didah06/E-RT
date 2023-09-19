-- DRIVER

DROP TABLE IF EXISTS `ms_kendaraan`;
CREATE TABLE `ms_kendaraan`  (
  `id_kendaraan` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `jenis_kendaraan` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `merk` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `brand` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `warna` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kapasitas` int(10) NULL DEFAULT 0,
  `jml_kendaraan` int(10) NULL DEFAULT 0,
  `tgl_stnk` DATE,
  `foto_stnk` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tgl_pajak` DATE,
  `foto_pajak` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tgl_service_terakhir` DATE,
  `tahun_kendaraan` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `no_polisi` int(10) NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_kendaraan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `ms_kendaraan_asuransi`;
CREATE TABLE `ms_kendaraan_asuransi`  (
  `id_asuransi` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_asuransi` int(11) NULL,
  `asuransi` int(11) NULL,
  `masa_berlaku_asuransi` INT(11) NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_asuransi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `ms_kendaraan_service`;
CREATE TABLE `ms_kendaraan_service`  (
  `id_service` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_kendaraan` int(11) NULL,
  `tgl_service_terakhir` DATE,
  `nota_service` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `total_service` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tempat_service` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_service`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `ms_kendaraan_pajak`;
CREATE TABLE `ms_kendaraan_pajak`  (
  `id_pajak` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_kendaraan` INT(11) NULL,
  `tgl_pajak` DATE,
  `foto` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_pajak`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `ms_kendaraan_steam`;
CREATE TABLE `ms_kendaraan_steam`  (
  `id_steam` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `foto` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tgl_terakhir_steam` DATE,
  `total_steam` int(11) NULL DEFAULT 0,
  `nota_steam` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_steam`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `ms_jadwal`;
CREATE TABLE `ms_jadwal`  (
  `id_jadwal` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `jadwal` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_jadwal`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;


DROP TABLE IF EXISTS `ms_status`;
CREATE TABLE `ms_status`  (
  `id_status` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`status`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;


DROP TABLE IF EXISTS `tb_booking_transport`;
CREATE TABLE `tb_booking_transport`  (
  `id_booking` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_booking` varchar(225),
  `id_jadwal` int(11) null,
  `jadwal` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_direktorat` int(11) NULL DEFAULT NULL,
  `direktorat` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_divisi` int(11) NULL DEFAULT NULL,
  `divisi` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_dept` int(11) NULL DEFAULT NULL,
  `departemen` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nama` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `hari_pemakaian` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tanggal_pemakaian` DATE,
  `type_pemakaian` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cara_pemakaian` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `jam_keberangkatan` time,
  `tujuan` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `acara_kegiatan` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `jumlah_peserta` decimal(11) NULL DEFAULT 0,
  `jumlah_kendaraan` decimal(11) NULL DEFAULT 0,
  `anggaran` int(11) NULL DEFAULT 0,
  `driver`      varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `jam_berangkat` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `km_berangkat` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `jam_kembali`  varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `km_kembali`  varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tgl_berangkat` DATE,
  `id_kendaraan` int(11) null,
  `jenis_kendaraan` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_etol` int(11) NULL DEFAULT NULL,
  `saldo_awal_etol` int(11) NULL DEFAULT 0,
  `top_up` int(11) NULL DEFAULT 0,
  `biaya_etol` int(11) NULL DEFAULT 0,
  `total_etol` int(11) NULL DEFAULT 0,
  `saldo_akhir_etol` int(11) NULL DEFAULT 0,
  `bensin` int(11) NULL DEFAULT 0,
  `approved_kadep_by` int(11) NULL DEFAULT NULL,
  `approved_kadep_nama` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `approved_kadep_at` int(11) NULL DEFAULT NULL,
  `approved_kadep_ttd` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `approved_kadiv_by` int(11) NULL DEFAULT NULL,
  `approved_kadiv_nama` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `approved_kadiv_at` int(11) NULL DEFAULT NULL,
  `approved_kadiv_ttd` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `approved_rt_by` int(11) NULL DEFAULT NULL,
  `approved_rt_nama` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `approved_rt_at` int(11) NULL DEFAULT NULL,
  `approved_rt_ttd` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ditolak_kadep_by` int(11) NULL DEFAULT NULL,
  `ditolak_kadep_nama` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ditolak_kadep_at` int(11) NULL DEFAULT NULL,
  `ditolak_kadep_ttd` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ditolak_kadiv_by` int(11) NULL DEFAULT NULL,
  `ditolak_kadiv_nama` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ditolak_kadiv_at` int(11) NULL DEFAULT NULL,
  `ditolak_kadiv_ttd` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ditolak_rt_by` int(11) NULL DEFAULT NULL,
  `ditolak_rt_nama` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ditolak_rt_at` int(11) NULL DEFAULT NULL,
  `ditolak_rt_ttd` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_status` int(11) NULL DEFAULT 1,
  `status` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_by` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1, 
  PRIMARY KEY (`id_booking`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;


DROP TABLE IF EXISTS `tb_jadwal_transport`;
CREATE TABLE `tb_jadwal_transport`  (
  `id_jadwal_transport` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_jadwal` int(11) NOT NULL,
  `jadwal` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_booking` int(11) NULL DEFAULT NULL,
  `kode_booking` int(11) NULL DEFAULT NULL,
  `id_direktorat` int(11) NULL DEFAULT NULL,
  `direktorat` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_devisi` int(11) NULL DEFAULT NULL,
  `devisi` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_dept` int(11) NULL DEFAULT NULL,
  `departemen` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1, 
  PRIMARY KEY (`id_jadwal_transport`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `tb_pemeliharaan_transport`;
CREATE TABLE `tb_pemeliharaan_transport`  (
  `id_pemeliharaan` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_kendaraan`  int(11) NULL DEFAULT NULL,
  `jenis_kendaraan` int(11) NULL DEFAULT NULL,
  `id_steam` int(11) NULL DEFAULT NULL,
  `tgl_terakhir_steam` DATE,
  `id_pajak` int(11) NULL DEFAULT NULL,
  `tgl_pajak` DATE,
  `id_asuransi` int(11) NULL DEFAULT NULL,
  `no_asuransi` int(11) NULL DEFAULT NULL,
  `id_service` int(11) NULL DEFAULT NULL,
  `tgl_service_terakhir` DATE,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_pemeliharaan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;


-- Keamanan

DROP TABLE IF EXISTS `tb_security`;
CREATE TABLE `tb_security`  (
  `id_security` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `jadwal_shift` datetime(0) NULL DEFAULT,
  `foto` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_security`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `tb_shift`;
CREATE TABLE `tb_shift`  (
  `id_shift` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `jadwal_shift` datetime(0) NULL DEFAULT,
  `id_security` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_shift`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `tb_kejadian`;
CREATE TABLE `tb_kejadian`  (
  `id_kejadian` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kejadian` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kronologi` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  waktu_kejadian datetime(0) NULL DEFAULT,
  cctv_video varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_kejadian`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `tb_informasi`;
CREATE TABLE `tb_informasi`  (
  `id_informasi` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `informasi` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  kategori varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, 
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_informasi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `tb_inventaris_keamanan`;
CREATE TABLE `tb_inventaris_keamanan`  (
  `id_inventaris` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `barang` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, 
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_inventaris`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;


-- Dapur

DROP TABLE IF EXISTS `tb_menu_dapur`;
CREATE TABLE `tb_menu_dapur`  (
  `id_menu_dapur` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, 
  jadwal_menu datetime(0) NULL DEFAULT,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_menu_dapur`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `tb_jadwal_menu`;
CREATE TABLE `tb_jadwal_menu`(
  `id_jadwal_menu` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `jadwal_menu` datetime(0) NULL DEFAULT,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_jadwal_menu`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `tb_inventaris_barang`;
CREATE TABLE `tb_inventaris_barang`(
  `id_barang` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `barang` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_barang`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `tb_dapur`;
CREATE TABLE `tb_dapur`  (
  `id_dapur` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  id_petugas_dapur int(10) NULL DEFAULT NULL,
  id_jadwal_shift_dapur datetime(0) NULL DEFAULT,
  `tanggal` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, 
  foto_kebersihan_dapur varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_dapur`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;


DROP TABLE IF EXISTS `tb_jadwal_shift_dapur`;
CREATE TABLE `tb_jadwal_shift_dapur`  (
  `id_shift_petugas` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  id_petugas_dapur int(10) NULL DEFAULT NULL,
  `jadwal_shift_dapur` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, 
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_shift_petugas`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `tb_pengaduan`;
CREATE TABLE `tb_pengaduan`  (
  `id_pengaduan` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  pengaduan varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `saran` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, 
  penilaian varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_pengaduan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;


-- seragam

DROP TABLE IF EXISTS `tb_seragam`;
CREATE TABLE `tb_seragam`  (
  `id_seragam` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  seragam varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  harga   varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `stok_tersedia` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, 
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_seragam`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `tb_pemesanan_seragam`;
CREATE TABLE `tb_pemesanan_seragam`  (
  `id_pemesanan` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  seragam varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `jumlah` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, 
  total_harga varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  jenis_pembayaran varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_pemesanan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `tb_pembayaran`;
CREATE TABLE `tb_pembayaran`  (
  `id_pembayaran` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  jenis_pembayaran varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bukti_pembayaran` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, 
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_pembayaran`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `tb_vendor`;
CREATE TABLE `tb_vendor`  (
  `id_vendor` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  vendor varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_vendor`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `tb_pengaduan`;
CREATE TABLE `tb_pengaduan`  (
  `id_pengaduan` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  pengaduan varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `saran` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, 
  foto varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_pengaduan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;


-- fotokopi
DROP TABLE IF EXISTS `tb_transaksi`;
CREATE TABLE `tb_transaksi`  (
  `id_fotokopi` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  kategori varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `file` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, 
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_pengaduan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `tb_inventaris_fotokopi`;
CREATE TABLE `tb_inventaris_fotokopi`  (
  `id_barang` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  nama_barang varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_barang`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `tb_pengajuan`;
CREATE TABLE `tb_pengajuan`  (
  `id_pengajuan` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  nama_barang varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  harga varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  total_harga varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_pengajuan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `tb_pembelian`;
CREATE TABLE `tb_pembelian`  (
  `id_pembelian` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  id_pengajuan varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_pembelian`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;