<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKeamanan extends Model
{
    protected $table = 'tb_keamanan';
    protected $primaryKey = 'id_keamanan';
    protected $allowedFields    = [
        'id_keamanan',
        'id_user',
        'kode_kejadian',
        'kejadian',
        'kronologi',
        'id_area',
        'tgl_kejadian',
        'waktu_kejadian',
        'is_aktif',
        'created_by',
        'created_at',
    ];
}
