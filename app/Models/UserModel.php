<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'ms_user';
    protected $allowedFields    = [
        'master_id',
        'role',
        'ttd',
        'id_direktorat',
        'id_divisi',
        'id_dept',
        'is_aktif',
    ];
}
