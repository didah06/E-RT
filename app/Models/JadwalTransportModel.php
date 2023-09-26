<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalTransportModel extends Model
{
    protected $table            = 'tb_jadwal_transport';
    protected $primaryKey       = 'id_jadwal_transport';
    protected $allowedFields    = [
        'id_jadwal',
        'jadwal',
        'id_booking',
        'kode_booking',
        'status',
        'is_aktif',
    ];
}
