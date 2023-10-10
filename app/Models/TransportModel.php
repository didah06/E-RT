<?php

namespace App\Models;

use CodeIgniter\Model;

class TransportModel extends Model
{
    protected $table = 'tb_booking_transport';
    protected $primaryKey = 'id_booking';
    protected $allowedFields    = [
        'kode_booking',
        'id_jadwal',
        'jadwal',
        'id_direktorat',
        'direktorat',
        'id_divisi',
        'divisi',
        'id_dept',
        'departemen',
        'nama',
        'pemohon_ttd',
        'type_pemakaian',
        'hari_pemakaian',
        'tanggal_pemakaian',
        'cara_pemakaian',
        'type_pemakaian',
        'jam_keberangkatan',
        'jam_berangkat',
        'jam_kembali',
        'tujuan',
        'acara_kegiatan',
        'jumlah_peserta',
        'jumlah_kendaraan',
        'anggaran',
        'driver',
        'km_berangkat',
        'km_kembali',
        'tgl_berangkat',
        'id_kendaraan',
        'jenis_kendaraan',
        'id_etol',
        'saldo_awal_etol',
        'top_up',
        'biaya_etol',
        'total_etol',
        'saldo_akhir_etol',
        'bensin',
        'approved_kadep_by',
        'approved_kadep_nama',
        'approved_kadep_at',
        'approved_kadep_ttd',
        'approved_kadiv_by',
        'approved_kadiv_nama',
        'approved_rt_by',
        'approved_rt_nama',
        'approved_rt_at',
        'approved_rt_ttd',
        'id_status',
        'status',
        'is_aktif',
    ];
}
