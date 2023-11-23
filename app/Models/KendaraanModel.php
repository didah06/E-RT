<?php

namespace App\Models;

use CodeIgniter\Model;

class KendaraanModel extends Model
{
    protected $table = 'ms_kendaraan';
    protected $primaryKey = 'id_kendaraan';
    protected $allowedFields    = [
        'jenis_kendaraan',
        'merk',
        'brand',
        'warna',
        'kapasitas',
        'jml_kendaraan',
        'tgl_stnk',
        'foto_stnk',
        'no_asuransi',
        'tgl_pajak',
        'foto_pajak',
        'tgl_service_terakhir',
        'tgl_terakhir_steam',
        'tahun_kendaraan',
        'no_polisi',
        'is_aktif',
    ];
}
