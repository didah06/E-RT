<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarMenuModel extends Model
{
    protected $table = 'tb_daftar_menu';
    protected $primaryKey = 'id_menu';
    protected $allowedFields    = [
        'id_menu',
        'tgl_menu',
        'nota_steam',
        'menu_1',
        'menu_2',
        'menu_3',
        'menu_4',
        'id_sesi_menu',
        'sesi_menu',
        'is_aktif',
        'created_by',
        'created_at',
    ];
}
