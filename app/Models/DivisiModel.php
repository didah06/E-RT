<?php

namespace App\Models;

use CodeIgniter\Model;

class DivisiModel extends Model
{
    protected $table            = 'ms_divisi';

    public function getDivisi()
    {
        $this->select('ms_divisi.*, direktorat');
        $this->join('ms_direktorat', 'ms_direktorat.id_direktorat = ms_divisi.id_direktorat', 'LEFT');
        return $this->findAll();
    }
}
