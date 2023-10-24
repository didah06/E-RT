<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['baru']           = count_status(['status' => 'baru']);
        $data['diproses']       = count_status(['status' => 'diproses']);
        $data['selesai']        = count_status(['status' => 'selesai']);
        $data['ditolak']        = count_status(['status' => 'ditolak']);
        $data['booking']        = getData('tb_booking_transport')->get()->getResult();
        $data['informasi']      = getData('tb_informasi')->get()->getResult();
        $data['daftar_menu']    = getData('tb_daftar_menu')->get()->getResult();
        return _tempHTML('dashboard/index', $data);
    }
    public function details($id_booking)
    {
        $data['booking']  = getData('tb_booking_transport', ['id_booking' => $id_booking])->get()->getRow();
        return _tempHTML('dashboard/timeline', $data);
    }
    public function get_menu_dapur($id_menu)
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
    public function penilaian_menu_dapur()
    {
        $json['input'] = [
            'rating'    => $this->_validation('rating', 'Rating', 'required'),
            'saran'     => $this->_validation('saran', 'Saran', 'required'),
        ];
        if (_validationHasErrors($json['input'])) {
            $rating = _getVar($this->request->getVar('rating'));
            $saran  = _getVar($this->request->getVar('saran'));
            $daftar_menu = getData('tb_daftar_menu', ['id_menu' => _getVar($this->request->getVar('id_menu'))])->get()->getRow();
            if (!$daftar_menu) {
                echo 'data menu tidak ditemukan';
            }
            $data = [
                'rating' => $rating,
                'saran'  => $saran,
            ];
            $update = updateData('tb_daftar_menu', $data, ['id_menu' => $daftar_menu->id_menu]);
            if ($update) {
                $json['success'] = 'penilaian berhasil disimpan';
            } else {
                $json['error'] = 'penilaian gagal disimpan';
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
}
