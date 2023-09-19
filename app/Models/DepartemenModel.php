<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartemenModel extends Model
{
    protected $table            = 'ms_departemen';

    public function getDepartemen()
    {
        $this->select('ms_departemen.*, divisi, direktorat');
        $this->join('ms_divisi', 'ms_divisi.id_divisi = ms_departemen.id_divisi');
        $this->join('ms_direktorat', 'ms_direktorat.id_direktorat = ms_divisi.id_direktorat');
        return $this->findAll();
    }
}
