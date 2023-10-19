<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKebersihan extends Model
{
    protected $table = 'tb_kebersihan';
    protected $primaryKey = 'id_kebersihan_dapur';
    protected $allowedFields    = [
        'id_kebersihan_dapur',
        'tgl_pemantauan',
        'id_shift',
        'shift',
        'id_area',
        'area',
        'foto',
        'keterangan',
        'is_aktif',
        'created_by',
        'created_at',
    ];
}
