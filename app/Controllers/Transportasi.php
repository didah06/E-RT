<?php

namespace App\Controllers;

use App\Models\TransportModel;
use CodeIgniter\API\ResponseTrait;

class Transportasi extends BaseController
{
    use ResponseTrait;
    protected $model;

    public function __construct()
    {
        $this->model  = new TransportModel();
    }
    public function index()
    {
        $data['booking'] = $this->model->get()->getResult();
        return $this->respond($data);
    }
    public function booking()
    {
        $data['kendaraan']  = selectKendaraan();
        $data['booking'] = $this->model->whereNotIn('status', [5])->get()->getResult();
        return _tempHTML('transportasi/booking_transport', $data);
    }
    public function create()
    {
        $json['input'] = [
            'tanggal_pemakaian' => $this->_validation('tanggal_pemakaian', 'Tanggal Pemakaian', 'required|valid_date'),
            'jam_keberangkatan' => $this->_validation('jam_keberangkatan', 'Jam Keberangkatan', 'required'),
            'tujuan'            => $this->_validation('tujuan', 'Tujuan', 'required'),
            'acara_kegiatan'    => $this->_validation('acara_kegiatan', 'Acara Kegiatan', 'required'),
            'jumlah_peserta'    => $this->_validation('jumlah_peserta', 'Jumlah Peserta', 'required|decimal'),
            'jumlah_kendaraan'  => $this->_validation('jumlah_kendaraan', 'Jumlah Kendaraan', 'required|decimal'),
            'anggaran'          => $this->_validation('anggaran', 'Anggaran', 'required|decimal'),
        ];
        $json['select'] = [
            'hari_pemakaian'    => $this->_validation('hari_pemakaian', 'Hari', 'required'),
            'cara_pemakaian'    => $this->_validation('cara_pemakaian', 'Cara Pemakaian', 'required'),
            'type_pemakaian'    => $this->_validation('type_pemakaian', 'Tipe Pemakaian', 'required'),
            'id_kendaraan'      => $this->_validation('id_kendaraan', 'Jenis Kendaraan', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $kendaraan          = getData('ms_kendaraan', ['id_kendaraan' => _getVar($this->request->getVar('id_kendaraan'))])->get()->getRow();
            $status             = getData('ms_status', ['id_status' => 1])->get()->getRow();
            $kode_booking       = generateKodeBooking();
            $user               = getUser(['id' => _session('id')])->getRow();
            $hari_pemakaian     = _getVar($this->request->getVar('hari_pemakaian'));
            $tanggal_pemakaian  = _getVar($this->request->getVar('tanggal_pemakaian'));
            $jam_keberangkatan  = _getVar($this->request->getVar('jam_keberangkatan'));
            $cara_pemakaian     = _getVar($this->request->getVar('cara_pemakaian'));
            $type_pemakaian     = _getVar($this->request->getVar('type_pemakaian'));
            $tujuan             = _getVar($this->request->getVar('tujuan'));
            $acara_kegiatan     = _getVar($this->request->getVar('acara_kegiatan'));
            $jumlah_peserta     = _getVar($this->request->getVar('jumlah_peserta'));
            $jumlah_kendaraan   = _getVar($this->request->getVar('jumlah_kendaraan'));
            $anggaran           = _getVar($this->request->getVar('anggaran'));
            if (!$user) {
                $json['select']['id_direktorat'] = 'Pilihan data tidak ditemukan';
            } else if (!$kendaraan) {
                $json['select']['id_kendaraan'] = 'Pilihan data tidak ditemukan';
            } else {
                $data = [
                    'kode_booking'      => $kode_booking,
                    'id_direktorat'     => $user->id_direktorat,
                    'direktorat'        => $user->direktorat,
                    'id_divisi'         => $user->id_divisi,
                    'divisi'            => $user->divisi,
                    'id_dept'           => $user->id_dept,
                    'departemen'        => $user->departemen,
                    'nama'              => $user->nama,
                    'hari_pemakaian'    => $hari_pemakaian,
                    'tanggal_pemakaian' => $tanggal_pemakaian,
                    'jam_keberangkatan' => $jam_keberangkatan,
                    'cara_pemakaian'    => $cara_pemakaian,
                    'type_pemakaian'    => $type_pemakaian,
                    'tujuan'            => $tujuan,
                    'acara_kegiatan'    => $acara_kegiatan,
                    'jumlah_peserta'    => $jumlah_peserta,
                    'jumlah_kendaraan'  => $jumlah_kendaraan,
                    'id_kendaraan'      => $kendaraan->id_kendaraan,
                    'jenis_kendaraan'   => $kendaraan->jenis_kendaraan,
                    'anggaran'          => $anggaran,
                    'id_status'         => $status->id_status,
                    'status'            => $status->status,

                ];
                $add = $this->model->insert($data);
                if ($add) {
                    $json['success'] = $add;
                } else {
                    $json['error']  = "data gagal ditambahkan";
                }
            }
        }
        $json['rscript']    = csrf_hash();
        return $this->respond($json);
    }
    public function booking_details($id_booking)
    {
        $data['booking'] = getData('tb_booking_transport', ['id_booking' => $id_booking])->get()->getRow();
        $data['booking_list'] = getData('tb_booking_transport', ['id_booking' => $id_booking])->get()->getResult();
        return _tempHTML('transportasi/booking_details', $data);
    }
    public function approved_kadep($id_booking)
    {
        $getBooking = $this->model->find($id_booking);
        $status  = getData('ms_status', ['id_status' => 3])->get()->getRow();
        if (!$getBooking) {
            $json['msg']           = 'Data tidak ditemukan atau anda tidak memiliki akses';
        } else {
            $data = [
                'approved_kadep_by'    => _session('nama'),
                'approved_kadep_at'    => time(),
                'id_status'           => 3,
                'status'              => $status->status,
            ];
            $update = updateData('tb_booking_transport', $data, ['id_booking' => $id_booking]);
            if ($update) {
                $json['success'] = $update;
            } else {
                $json['error'] = 'update gagal';
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function approve_kadiv()
    {
    }
    public function approve_RT()
    {
    }
    public function unapproved($id_booking)
    {
        $json['input']['ditolak_ket'] = $this->_validation('ditolak_ket', 'Keterangan', 'required');
        if (_validationHasErrors(array_merge($json['input']))) {
            $reason = _getVar($this->request->getVar('ditolak_ket'));
            $getBooking = $this->model->find($id_booking);
            $status  = getData('ms_status', ['id_status' => 6])->get()->getRow();
            if (!$getBooking) {
                $json['msg']           = 'Data tidak ditemukan atau anda tidak memiliki akses';
            } else {
                $data = [
                    'ditolak_by'         => _session('nama'),
                    'ditolak_at'          => time(),
                    'ditolak_ket'         => $reason,
                    'id_status'           => 6,
                    'status'              => $status->status,
                ];
                $update = updateData('tb_booking_transport', $data, ['id_booking' => $id_booking]);
                if ($update) {
                    $json['success'] = $update;
                } else {
                    $json['error'] = 'update gagal';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function select_user($user_id)
    {
        $user = getMasterUser([
            'user_id' => $user_id
        ]);
        if ($user) {
            $data = [
                'status'    => true,
                'data'    => $user
            ];
        } else {
            $data = [
                'status'    => false,
                'data'    => ''
            ];
        }
        echo json_encode($data);
    }
    public function jadwal()
    {
    }
}
