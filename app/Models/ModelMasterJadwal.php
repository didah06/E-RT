<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMasterJadwal extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ms_jadwal';
    protected $primaryKey       = 'id_jadwal';
    protected $allowedFields    = [
        'id_jadwal',
        'jadwal',
        'is_aktif',
    ];
}
