<?php

namespace App\Models;

use CodeIgniter\Model;

class PajakModel extends Model
{
    protected $table = 'ms_kendaraan_pajak';
    protected $primaryKey = 'id_pajak';
    protected $allowedFields    = [
        'id_kendaraan',
        'tgl_pajak',
        'foto_pajak',
        'is_aktif',
    ];
}
