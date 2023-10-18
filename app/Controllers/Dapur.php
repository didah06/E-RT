<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dapur extends BaseController
{
    public function index()
    {
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
            'sesi_menu'      => $this->_validation('sesi_menu', 'Sesi Menu', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $tgl_menu = _getVar($this->request->getVar('tgl_menu'));
            $menu_1   = _getVar($this->request->getVar('menu_1'));
            $menu_2   = _getVar($this->request->getVar('menu_2'));
            $menu_3   = _getVar($this->request->getVar('menu_3'));
            $menu_4   = _getVar($this->request->getVar('menu_4'));
            $sesi_menu = _getVar($this->request->getVar('sesi_menu'));
            $data = [
                'tgl_menu' => $tgl_menu,
                'menu_1'     => $menu_1,
                'menu_2'     => $menu_2,
                'menu_3'     => $menu_3,
                'menu_4'     => $menu_4,
                'sesi_menu' => $sesi_menu,
            ];
            $add = addData('tb_daftar_menu', $data);
            if ($add) {
                $json['success'] = $add;
            } else {
                $json['error'] = 'tambah data gagal';
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
            'e_sesi_menu'       => $this->_validation('e_sesi_menu', 'Sesi Menu', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input']))) {
            $tgl_menu = _getVar($this->request->getVar('e_tgl_menu'));
            $menu_1   = _getVar($this->request->getVar('e_menu_1'));
            $menu_2   = _getVar($this->request->getVar('e_menu_2'));
            $menu_3   = _getVar($this->request->getVar('e_menu_3'));
            $menu_4   = _getVar($this->request->getVar('e_menu_4'));
            $sesi_menu = _getVar($this->request->getVar('e_sesi_menu'));
            $data = [
                'tgl_menu' => $tgl_menu,
                'menu_1'     => $menu_1,
                'menu_2'     => $menu_2,
                'menu_3'     => $menu_3,
                'menu_4'     => $menu_4,
                'sesi_menu' => $sesi_menu,
            ];
            $update = updateData('tb_daftar_menu', $data, ['id_menu' => $id_menu]);
            if ($update) {
                $json['success'] = $update;
            } else {
                $json['error'] = 'ubah data gagal';
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
}
