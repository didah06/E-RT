<?php

namespace App\Models;

use CodeIgniter\Model;

class AsuransiModel extends Model
{
    protected $table = 'ms_kendaraan_asuransi';
    protected $primaryKey = 'id_asuransi';
    protected $allowedFields    = [
        'id_kendaraan',
        'no_asuransi',
        'asuransi',
        'masa_berlaku_asuransi',
        'is_aktif',
    ];
}
