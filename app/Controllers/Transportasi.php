<?php

namespace App\Controllers;

use App\Models\TransportModel;
use App\Models\JadwalTransportModel;
use App\Models\ModelMasterJadwal;
use CodeIgniter\API\ResponseTrait;

class Transportasi extends BaseController
{
    use ResponseTrait;
    protected $model;
    protected $modeljadwal;
    protected $modelmasterjadwal;

    public function __construct()
    {
        $this->model       = new TransportModel();
        $this->modeljadwal = new JadwalTransportModel();
        $this->modelmasterjadwal = new ModelMasterJadwal();
    }
    public function index()
    {
        $data['booking'] = $this->model->get()->getResult();
        return $this->respond($data);
    }
    public function booking()
    {
        $data['kendaraan']  = selectKendaraan();
        $data['start_time'] = selectJadwalStart();
        $data['end_time'] = selectJadwalEnd();
        $data['booking'] = $this->model->orderBy('status', 'baru ASC')->get()->getResult();
        return _tempHTML('transportasi/booking_transport', $data);
    }
    public function validasi_jadwal($tanggal_pemakaian, $jam_keberangkatan, $jam_pulang)
    {
        $booked = isJamKeberangkatanTerisi($tanggal_pemakaian, $jam_keberangkatan, $jam_pulang);
        if ($booked > 0) {
            $data['status'] = true;
        }
        echo json_encode($data);
    }
    public function create()
    {
        $json['input'] = [
            'tanggal_pemakaian' => $this->_validation('tanggal_pemakaian', 'Tanggal Pemakaian', 'required|valid_date'),
            'tujuan'            => $this->_validation('tujuan', 'Tujuan', 'required'),
            'acara_kegiatan'    => $this->_validation('acara_kegiatan', 'Acara Kegiatan', 'required'),
            'jumlah_peserta'    => $this->_validation('jumlah_peserta', 'Jumlah Peserta', 'required|decimal'),
            // 'jumlah_kendaraan'  => $this->_validation('jumlah_kendaraan', 'Jumlah Kendaraan', 'required|decimal'),
            'anggaran'          => $this->_validation('anggaran', 'Anggaran', 'required|decimal'),
        ];
        $json['select'] = [
            'jam_keberangkatan' => $this->_validation('jam_keberangkatan', 'Jam Keberangkatan', 'required'),
            'jam_kembali'        => $this->_validation('jam_kembali', 'Jam Kembali', 'required'),
            'cara_pemakaian'    => $this->_validation('cara_pemakaian', 'Cara Pemakaian', 'required'),
            'type_pemakaian'    => $this->_validation('type_pemakaian', 'Tipe Pemakaian', 'required'),
            // 'id_kendaraan'      => $this->_validation('id_kendaraan', 'Jenis Kendaraan', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            // $kendaraan          = getData('ms_kendaraan', ['id_kendaraan' => _getVar($this->request->getVar('id_kendaraan'))])->get()->getRow();
            $jam_keberangkatan  = getData('ms_jadwal', ['start_time' => _getVar($this->request->getVar('jam_keberangkatan'))])->get()->getRow();
            $jam_kembali        = getData('ms_jadwal', ['end_time' => _getVar($this->request->getVar('jam_kembali'))])->get()->getRow();
            $status             = getData('ms_status', ['id_status' => 1])->get()->getRow();
            $kode_booking       = generateKodeBooking();
            $user               = getUser(['id' => _session('id')])->getRow();
            $tanggal_pemakaian  = _getVar($this->request->getVar('tanggal_pemakaian'));
            $cara_pemakaian     = _getVar($this->request->getVar('cara_pemakaian'));
            $type_pemakaian     = _getVar($this->request->getVar('type_pemakaian'));
            $tujuan             = _getVar($this->request->getVar('tujuan'));
            $acara_kegiatan     = _getVar($this->request->getVar('acara_kegiatan'));
            $jumlah_peserta     = _getVar($this->request->getVar('jumlah_peserta'));
            $anggaran           = _getVar($this->request->getVar('anggaran'));
            if (!$user) {
                $json['select']['id_direktorat']    = 'Pilihan data tidak ditemukan';
            } else if (!$jam_keberangkatan) {
                $json['select']['start_time']    = 'Pilihan data tidak ditemukan';
            } else if (!$jam_kembali) {
                $json['select']['end_time']    = 'Pilihan data tidak ditemukan';
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
                    'tanggal_pemakaian' => $tanggal_pemakaian,
                    'jam_keberangkatan' => $jam_keberangkatan->start_time,
                    'jam_kembali'       => $jam_kembali->end_time,
                    'cara_pemakaian'    => $cara_pemakaian,
                    'type_pemakaian'    => $type_pemakaian,
                    'tujuan'            => $tujuan,
                    'acara_kegiatan'    => $acara_kegiatan,
                    'jumlah_peserta'    => $jumlah_peserta,
                    'anggaran'          => $anggaran,
                    'id_status'         => $status->id_status,
                    'status'            => $status->status,
                ];
                if (isJamKeberangkatanTerisi($tanggal_pemakaian, $jam_keberangkatan->start_time, $jam_kembali->end_time) > 0) {
                    $json['error'] = 'Maaf! pada Jam tersebut sudah ada yang booking';
                } else {
                    $add = $this->model->insert($data);
                    if ($add) {
                        $json['success'] = $add;
                    } else {
                        $json['error']  = "data gagal ditambahkan";
                    }
                }
            }
        }
        $json['rscript']    = csrf_hash();
        return $this->respond($json);
    }
    public function booking_details($id_booking)
    {
        $data['kendaraan'] = selectKendaraan();
        $data['booking'] = getData('tb_booking_transport', ['id_booking' => $id_booking])->get()->getRow();
        $data['booking_list'] = getData('tb_booking_transport', ['id_booking' => $id_booking])->get()->getResult();
        return _tempHTML('transportasi/booking_details', $data);
    }
    public function details_save()
    {
        $id_booking = _getVar($this->request->getVar('id_booking'));
        $json['input'] = [
            'jumlah_kendaraan' => $this->_validation('jumlah_kendaraan', 'Jumlah Kendaraan', 'required|is_natural'),
        ];
        $json['select'] = [
            'id_kendaraan' => $this->_validation('id_kendaraan', 'Jenis Kendaraan', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $kendaraan          = getData('ms_kendaraan', ['id_kendaraan' => _getVar($this->request->getVar('id_kendaraan'))])->get()->getRow();
            $jumlah_kendaraan   = _getVar($this->request->getVar('jumlah_kendaraan'));
            if (!$kendaraan) {
                $json['select']['id_kendaraan']    = 'Pilihan data tidak ditemukan';
            } else {
                $data = [
                    'jumlah_kendaraan' => $jumlah_kendaraan,
                    'id_kendaraan'     => $kendaraan->id_kendaraan,
                    'jenis_kendaraan'  => $kendaraan->jenis_kendaraan,
                ];
                $add = $this->model->insert($data);
                if ($add > 0) {
                    updateData('tb_booking_transport', $data, ['id_booking' => $id_booking]);
                    $json['success'] = $add;
                } else {
                    $json['error'] = 'data gagal ditambahkan';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        return $this->respond($json);
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
    public function approved_kadiv($id_booking)
    {
        $getBooking = $this->model->find($id_booking);
        $status  = getData('ms_status', ['id_status' => 2])->get()->getRow();
        if (!$getBooking) {
            $json['msg']           = 'Data tidak ditemukan atau anda tidak memiliki akses';
        } else {
            $data = [
                'approved_kadiv_by'    => _session('nama'),
                'approved_kadiv_at'    => time(),
                'id_status'            => 2,
                'status'               => $status->status,
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
    public function approved_RT($id_booking)
    {
        $getBooking = $this->model->find($id_booking);
        $status  = getData('ms_status', ['id_status' => 4])->get()->getRow();
        if (!$getBooking) {
            $json['msg']           = 'Data tidak ditemukan atau anda tidak memiliki akses';
        } else {
            $data = [
                'approved_rt_by'      => _session('nama'),
                'approved_rt_at'      => time(),
                'id_status'           => 4,
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
    public function unapproved($id_booking)
    {
        $json['input']['ditolak_ket'] = $this->_validation('ditolak_ket', 'Keterangan', 'required');
        if (_validationHasErrors(array_merge($json['input']))) {
            $reason = _getVar($this->request->getVar('ditolak_ket'));
            $getBooking = $this->model->find($id_booking);
            $status  = getData('ms_status', ['id_status' => 5])->get()->getRow();
            if (!$getBooking) {
                $json['msg']           = 'Data tidak ditemukan atau anda tidak memiliki akses';
            } else {
                $data = [
                    'ditolak_by'         => _session('nama'),
                    'ditolak_at'          => time(),
                    'ditolak_ket'         => $reason,
                    'id_status'           => 5,
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
        $data['kode_booking'] = selectKodeBooking();
        $data['start_time'] = selectJadwalStart();
        $data['end_time'] = selectJadwalEnd();
        $data['jadwal_transport'] = $this->modeljadwal->get()->getResult();
        return _tempHTML('transportasi/jadwal_transport', $data);
    }
    public function set_jadwal()
    {
        $json['select'] = [
            'kode_booking'   => $this->_validation('kode_booking', 'Kode Booking', 'required'),
            'jadwal'         => $this->_validation('jadwal', 'Jadwal', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['select']))) {
            $kode_booking = _getVar($this->request->getVar('kode_booking'));
            $jadwal = _getVar($this->request->getVar('jadwal'));
            if (!$kode_booking) {
                $json['select'] = [
                    'kode_booking'             => 'Pilihan data tidak ditemukan',
                ];
            } else if (!$jadwal) {
                $json['select'] = [
                    'jadwal'       => 'Pilihan data tidak ditemukan',
                ];
            } else {
                $getBooking = $this->model->where('id_booking', $kode_booking)->get()->getRow();
                $getJadwal = $this->modelmasterjadwal->where('id_jadwal', $jadwal)->get()->getRow();
                $data = [
                    'id_booking'   => $getBooking->id_booking,
                    'kode_booking' => $getBooking->kode_booking,
                    'id_jadwal'    => $getJadwal->id_jadwal,
                    'jadwal'       => $getJadwal->jadwal,
                    'status'       => $getBooking->status,
                    'is_aktif'     => 1,
                ];
                $add = $this->modeljadwal->insert($data);
                if ($add) {
                    $json['success'] = $add;
                } else {
                    $json['error'] = 'set jadwal gagal';
                }
            }
            $json['rscript']    = csrf_hash();
            echo json_encode($json);
        }
    }
}
