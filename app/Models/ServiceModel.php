<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = 'ms_kendaraan_service';
    protected $primaryKey = 'id_service';
    protected $allowedFields    = [
        'id_kendaraan',
        'tgl_service_terakhir',
        'nota_service',
        'tempat_service',
        'foto',
        'is_aktif',
    ];
}
