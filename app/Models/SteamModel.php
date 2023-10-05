<?php

namespace App\Models;

use CodeIgniter\Model;

class SteamModel extends Model
{
    protected $table = 'ms_kendaraan_steam';
    protected $primaryKey = 'id_steam';
    protected $allowedFields    = [
        'id_kendaraan',
        'tgl_terakhir_steam',
        'nota_steam',
        'tempat_steam',
        'foto',
        'is_aktif',
    ];
}
