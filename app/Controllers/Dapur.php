<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dapur extends BaseController
{
    public function index()
    {
        $data['sesi_menu']   = selectSesiMenu();
        $data['daftar_menu'] = getData('tb_daftar_menu')->get()->getResult();
        return _tempHTML('dapur/daftar_menu', $data);
    }
    public function menu_save()
    {
        $json['input'] = [
            'tgl_menu'      => $this->_validation('tgl_menu', 'Tanggal Menu', 'required|valid_date'),
            'menu_1'          => $this->_validation('menu_1', 'Menu', 'required'),
            'menu_2'          => $this->_validation('menu_2', 'Menu', 'required'),
            'menu_3'          => $this->_validation('menu_3', 'Menu', 'required'),
            'menu_4'          => $this->_validation('menu_4', 'Menu', 'required'),
        ];
        $json['select'] = [
            'id_sesi_menu'      => $this->_validation('id_sesi_menu', 'Sesi Menu', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $tgl_menu = _getVar($this->request->getVar('tgl_menu'));
            $menu_1   = _getVar($this->request->getVar('menu_1'));
            $menu_2   = _getVar($this->request->getVar('menu_2'));
            $menu_3   = _getVar($this->request->getVar('menu_3'));
            $menu_4   = _getVar($this->request->getVar('menu_4'));
            $sesi_menu = getData('ms_sesi_menu', ['id_sesi_menu' => _getVar($this->request->getVar('id_sesi_menu'))])->get()->getRow();
            if (!$sesi_menu) {
                $json['select']['id_sesi_menu'] = 'data sesi menu tidak ditemukan';
            } else {
                $data = [
                    'tgl_menu' => $tgl_menu,
                    'menu_1'     => $menu_1,
                    'menu_2'     => $menu_2,
                    'menu_3'     => $menu_3,
                    'menu_4'     => $menu_4,
                    'id_sesi_menu' => $sesi_menu->id_sesi_menu,
                    'sesi_menu'    => $sesi_menu->sesi_menu,
                    'created_by'   => _session('nama'),
                    'created_at'   => time(),
                ];
                $add = addData('tb_daftar_menu', $data);
                if ($add) {
                    $json['success'] = $add;
                } else {
                    $json['error'] = 'tambah data gagal';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function menu_edit($id_menu)
    {
        $menu = getData('tb_daftar_menu', ['id_menu' => $id_menu])->get()->getRow();
        if ($menu) {
            $data = [
                'status'    => true,
                'data'      => $menu
            ];
        } else {
            $data = [
                'status'    => false,
                'data'      => ''
            ];
        }
        echo json_encode($data);
    }
    public function menu_update()
    {
        $id_menu = _getVar($this->request->getVar('e_id_menu'));
        $json['input'] = [
            'e_tgl_menu'        => $this->_validation('e_tgl_menu', 'Tanggal Menu', 'required|valid_date'),
            'e_menu_1'          => $this->_validation('e_menu_1', 'Menu', 'required'),
            'e_menu_2'          => $this->_validation('e_menu_2', 'Menu', 'required'),
            'e_menu_3'          => $this->_validation('e_menu_3', 'Menu', 'required'),
            'e_menu_4'          => $this->_validation('e_menu_4', 'Menu', 'required'),
        ];
        $json['select'] = [
            'e_id_sesi_menu'      => $this->_validation('e_id_sesi_menu', 'Sesi Menu', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input']))) {
            $tgl_menu = _getVar($this->request->getVar('e_tgl_menu'));
            $menu_1   = _getVar($this->request->getVar('e_menu_1'));
            $menu_2   = _getVar($this->request->getVar('e_menu_2'));
            $menu_3   = _getVar($this->request->getVar('e_menu_3'));
            $menu_4   = _getVar($this->request->getVar('e_menu_4'));
            $sesi_menu = getData('ms_sesi_menu', ['id_sesi_menu' => _getVar($this->request->getVar('e_id_sesi_menu'))])->get()->getRow();
            if (!$sesi_menu) {
                $json['select']['e_id_sesi_menu'] = 'data sesi menu tidak ditemukan';
            } else {
                $data = [
                    'tgl_menu' => $tgl_menu,
                    'menu_1'     => $menu_1,
                    'menu_2'     => $menu_2,
                    'menu_3'     => $menu_3,
                    'menu_4'     => $menu_4,
                    'id_sesi_menu' => $sesi_menu->id_sesi_menu,
                    'sesi_menu'  => $sesi_menu->sesi_menu,
                    'created_by'   => _session('nama'),
                    'created_at'   => time(),
                ];
                $update = updateData('tb_daftar_menu', $data, ['id_menu' => $id_menu]);
                if ($update) {
                    $json['success'] = $update;
                } else {
                    $json['error'] = 'ubah data gagal';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function menu_delete()
    {
        $id_menu = $this->request->getPost('id_menu');
        $json = [];

        if ($id_menu) {
            foreach ($id_menu as $menu_id) {
                // Assuming 'deleteData' is a method in your model
                $delete = deleteData('tb_daftar_menu', ['id_menu' => $menu_id]);
            }
            if ($delete) {
                $json['success'] = true;
                $json['msg'] = 'Data berhasil dihapus';
            } else {
                $json['success'] = false;
                $json['msg'] = 'Tidak ada data yang dipilih untuk dihapus';
            }
        }
        $json['rscript'] = csrf_hash();
        return $this->response->setJSON($json);
    }
    public function kebersihan()
    {
        $start_date = _getVar($this->request->getVar('start_date'));
        $end_date   = _getVar($this->request->getVar('end_date'));
        $data['shift']      = selectShift();
        $data['area']       = selectArea();
        $data['start_date'] = $start_date == "" ? date('Y-m-') . '01' : $start_date;
        $data['end_date'] = $end_date == "" ? date('Y-m-t') : $end_date;
        $data['kebersihan'] = getData('tb_kebersihan_dapur', ['tgl_pemantauan BETWEEN "' . $data['start_date'] . '" AND "' . $data['end_date'] . '"' => null])->get()->getResult();
        return _tempHTML('dapur/kebersihan', $data);
    }
    public function kebersihan_save()
    {
        $json['input'] = [
            'tgl_pemantauan'      => $this->_validation('tgl_pemantauan', 'Tanggal Pemantauan Kebersihan', 'required|valid_date'),
            'foto'                => $this->_validation('foto', 'foto', 'uploaded[foto]|max_size[foto, 1024]|mime_in[foto,image/jpeg,image/png,image/jpg]'),
            'keterangan'          => $this->_validation('keterangan', 'Keterangan', 'required'),
        ];
        $json['select'] = [
            'id_shift'      => $this->_validation('id_shift', 'Shift', 'required'),
            'id_area'      => $this->_validation('id_area', 'Area', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $tgl_pemantauan = _getVar($this->request->getVar('tgl_pemantauan'));
            $keterangan     = _getVar($this->request->getVar('keterangan'));
            $foto           = $this->request->getFile('foto');
            $shift = getData('ms_shift', ['id_shift' => _getVar($this->request->getVar('id_shift'))])->get()->getRow();
            $area = getData('ms_area', ['id_area' => _getVar($this->request->getVar('id_area'))])->get()->getRow();
            if (!$shift) {
                $json['select']['id_shift'] = 'data shift tidak ditemukan';
            } else if (!$area) {
                $json['select']['id_area'] = 'data area tidak ditemukan';
            } else {
                if ($foto->getError() == 0 && $foto->isValid() && !$foto->hasMoved()) {
                    $photo        = $foto->getRandomName();
                    ($foto->move(FCPATH . './public/assets/images/dapur/kebersihan_dapur', $photo));
                    $data = [
                        'tgl_pemantauan' => $tgl_pemantauan,
                        'id_shift'     => $shift->id_shift,
                        'shift'        => $shift->shift,
                        'id_area'      => $area->id_area,
                        'area'         => $area->area,
                        'foto'         => $photo,
                        'keterangan'   => $keterangan,
                        'created_by'   => _session('nama'),
                        'created_at'   => time(),
                    ];
                    $add = addData('tb_kebersihan_dapur', $data);
                    if ($add) {
                        $json['success'] = $add;
                    } else {
                        $json['error'] = 'tambah data gagal';
                    }
                } else {
                    $json['error'] = 'foto gagal upload';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function kebersihan_edit($id_kebersihan_dapur)
    {
        $kebersihan = getData('tb_kebersihan_dapur', ['id_kebersihan_dapur' => $id_kebersihan_dapur])->get()->getRow();
        if ($kebersihan) {
            $data = [
                'status'    => true,
                'data'      => $kebersihan
            ];
        } else {
            $data = [
                'status'    => false,
                'data'      => ''
            ];
        }
        echo json_encode($data);
    }
    public function kebersihan_update()
    {
        $id_kebersihan_dapur = _getVar($this->request->getVar('e_id_kebersihan_dapur'));
        $json['input'] = [
            'e_tgl_pemantauan'      => $this->_validation('e_tgl_pemantauan', 'Tanggal Pemantauan Kebersihan', 'required|valid_date'),
            'e_foto'                => $this->_validation('e_foto', 'foto', 'uploaded[e_foto]|max_size[e_foto, 1024]|mime_in[e_foto,image/jpeg,image/png,image/jpg]'),
            'e_keterangan'          => $this->_validation('e_keterangan', 'Keterangan', 'required'),
        ];
        $json['select'] = [
            'e_id_shift'      => $this->_validation('e_id_shift', 'Shift', 'required'),
            'e_id_area'      => $this->_validation('e_id_area', 'Area', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $tgl_pemantauan = _getVar($this->request->getVar('e_tgl_pemantauan'));
            $keterangan     = _getVar($this->request->getVar('e_keterangan'));
            $foto           = $this->request->getFile('e_foto');
            $shift = getData('ms_shift', ['id_shift' => _getVar($this->request->getVar('e_id_shift'))])->get()->getRow();
            $area = getData('ms_area', ['id_area' => _getVar($this->request->getVar('e_id_area'))])->get()->getRow();
            $kebersihan = getData('tb_kebersihan_dapur', ['id_kebersihan_dapur' => $id_kebersihan_dapur])->get()->getRow();
            if (!$shift) {
                $json['select']['e_id_shift'] = 'data shift tidak ditemukan';
            } else if (!$area) {
                $json['select']['e_id_area'] = 'data area tidak ditemukan';
            } else {
                if ($foto->getError() == 0 && $foto->isValid() && !$foto->hasMoved()) {
                    $photo        = $foto->getRandomName();
                    if ($foto->move(FCPATH . './public/assets/images/dapur/kebersihan_dapur', $photo)) {
                        if (file_exists(FCPATH . './public/assets/images/dapur/kebersihan_dapur' . $photo)) {
                            unlink(FCPATH . './public/assets/images/dapur/kebersihan_dapur' . $photo);
                        } else {
                            $json['error'] = "Failed to delete old file";
                        }
                        $data = [
                            'tgl_pemantauan' => $tgl_pemantauan,
                            'id_shift'     => $shift->id_shift,
                            'shift'        => $shift->shift,
                            'id_area'      => $area->id_area,
                            'area'         => $area->area,
                            'foto'         => $photo,
                            'keterangan'   => $keterangan,
                            'created_by'   => _session('nama'),
                            'created_at'   => time(),
                        ];
                        $update = updateData('tb_kebersihan_dapur', $data, ['id_kebersihan_dapur' => $id_kebersihan_dapur]);
                        if ($update) {
                            $json['success'] = $update;
                        } else {
                            $json['error'] = 'tambah data gagal';
                        }
                    } else {
                        $json['error'] = 'foto gagal upload';
                    }
                } else {
                    $foto = $kebersihan->foto;
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function kebersihan_delete()
    {
        $id_kebersihan_dapur = $this->request->getPost('id_kebersihan_dapur');
        $json = [];

        if ($id_kebersihan_dapur) {
            foreach ($id_kebersihan_dapur as $kebersihan_id) {
                // Assuming 'deleteData' is a method in your model
                $delete = deleteData('tb_kebersihan_dapur', ['id_kebersihan_dapur' => $kebersihan_id]);
            }
            if ($delete) {
                $json['success'] = true;
                $json['msg'] = 'Data berhasil dihapus';
            } else {
                $json['success'] = false;
                $json['msg'] = 'Tidak ada data yang dipilih untuk dihapus';
            }
        }
        $json['rscript'] = csrf_hash();
        return $this->response->setJSON($json);
    }
    public function porsi()
    {
        $data['sesi_menu']   = selectSesiMenu();
        return _tempHTML('dapur/porsi_makanan', $data);
    }
}
