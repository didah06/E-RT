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
        $data['booking'] = $this->model->whereNotIn('status', ['diproses', 'selesai'])->get()->getResult();
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
        $data['driver']    = selectDriverUser();
        $data['booking'] = getData('tb_booking_transport', ['id_booking' => $id_booking])->get()->getRow();
        $data['booking_list'] = getData('tb_booking_transport', ['id_booking' => $id_booking])->get()->getResult();
        return _tempHTML('transportasi/booking_details', $data);
    }
    public function details_save()
    {
        $id_booking = _getVar($this->request->getVar('id_booking'));
        $json['input'] = [
            'jumlah_kendaraan' => $this->_validation('jumlah_kendaraan', 'Jumlah Kendaraan', 'required|is_natural'),
            'saldo_awal_etol'  => $this->_validation('saldo_awal_etol', 'Saldo Awal E-tol', 'required|decimal')
        ];
        $json['select'] = [
            'id_kendaraan' => $this->_validation('id_kendaraan', 'Jenis Kendaraan', 'required'),
            'user_id'      => $this->_validation('user_id', 'Driver', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $user               = getData('db_master.ms_user', ['user_id' => _getVar($this->request->getVar('user_id'))])->get()->getRow();
            $kendaraan          = getData('ms_kendaraan', ['id_kendaraan' => _getVar($this->request->getVar('id_kendaraan'))])->get()->getRow();
            $jumlah_kendaraan   = _getVar($this->request->getVar('jumlah_kendaraan'));
            $saldo_awal_etol    = _getVar($this->request->getVar('saldo_awal_etol'));
            if (!$user) {
                $json['select']['user_id']    = 'Pilihan data tidak ditemukan';
            } else if (!$kendaraan) {
                $json['select']['id_kendaraan']    = 'Pilihan data tidak ditemukan';
            } else {
                $data = [
                    'jumlah_kendaraan' => $jumlah_kendaraan,
                    'id_kendaraan'     => $kendaraan->id_kendaraan,
                    'jenis_kendaraan'  => $kendaraan->jenis_kendaraan,
                    'driver'           => $user->nama,
                    'saldo_awal_etol'  => $saldo_awal_etol,
                ];
                $add = updateData('tb_booking_transport', $data, ['id_booking' => $id_booking]);
                if ($add) {
                    $json['success'] = $add;
                } else {
                    $json['error'] = 'data gagal ditambahkan';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        return $this->respond($json);
    }
    public function edit($id_booking)
    {
        $booking     = getData('tb_booking_transport', ['id_booking' => $id_booking])->get()->getRow();
        if ($booking) {
            $data = [
                'status'    => true,
                'data'      => $booking
            ];
        } else {
            $data = [
                'status'    => false,
                'data'      => ''
            ];
        }
        return $this->respond($data);
    }
    public function update()
    {
        $json['input'] = [
            'e_tanggal_pemakaian' => $this->_validation('e_tanggal_pemakaian', 'Tanggal Pemakaian', 'required|valid_date'),
            'e_jumlah_peserta'    => $this->_validation('e_jumlah_peserta', 'Jumlah Peserta', 'required'),
            'e_anggaran'          => $this->_validation('e_anggaran', 'Anggaran', 'required'),
            'e_tujuan'            => $this->_validation('e_tujuan', 'Tujuan', 'required'),
            'e_acara_kegiatan'    => $this->_validation('e_acara_kegiatan', 'Acara Kegiatan', 'required'),
        ];
        $json['select'] = [
            'e_jam_keberangkatan' => $this->_validation('e_jam_keberangkatan', 'Jam Keberangkatan', 'required'),
            'e_jam_kembali'       => $this->_validation('e_jam_kembali', 'Jam Kembali', 'required'),
            'e_cara_pemakaian'    => $this->_validation('e_cara_pemakaian', 'Cara Pemakaian', 'required'),
            'e_type_pemakaian'    => $this->_validation('e_type_pemakaian', 'Tipe Pemakaian', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $booking            = getData('tb_booking_transport', ['id_booking' => _getVar($this->request->getVar('e_id_booking'))])->get()->getRow();
            $tanggal_pemakaian  = _getVar($this->request->getVar('e_tanggal_pemakaian'));
            $jumlah_peserta     = _getVar($this->request->getVar('e_jumlah_peserta'));
            $anggaran           = _getVar($this->request->getVar('e_anggaran'));
            $tujuan             = _getVar($this->request->getVar('e_tujuan'));
            $acara_kegiatan     = _getVar($this->request->getVar('e_acara_kegiatan'));
            $jam_keberangkatan = _getVar($this->request->getVar('e_jam_keberangkatan'));
            $jam_kembali       = _getVar($this->request->getVar('e_jam_kembali'));
            $cara_pemakaian    = _getVar($this->request->getVar('e_cara_pemakaian'));
            $type_pemakaian    = _getVar($this->request->getVar('e_type_pemakaian'));
            $data = [
                'tanggal_pemakaian' => $tanggal_pemakaian,
                'jumlah_peserta'    => $jumlah_peserta,
                'anggaran'          => $anggaran,
                'tujuan'            => $tujuan,
                'acara_kegiatan'    => $acara_kegiatan,
                'jam_keberangkatan' => $jam_keberangkatan,
                'jam_kembali'       => $jam_kembali,
                'cara_pemakaian'    => $cara_pemakaian,
                'type_pemakaian'    => $type_pemakaian,
            ];
            if (isJamKeberangkatanTerisi($tanggal_pemakaian, $jam_keberangkatan, $jam_kembali) > 0) {
                $json['error'] = 'Maaf! pada Jam tersebut sudah ada yang booking';
            } else {
                $update = updateData('tb_booking_transport', $data, ['id_booking' => $booking->id_booking]);
                if ($update) {
                    $json['success'] = $update;
                } else {
                    $json['error']  = 'data gagal update';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        return $this->respond($json);
    }
    public function delete($id_booking)
    {
        $booking = getData('tb_booking_transport', ['id_booking' => $id_booking])->get()->getRow();
        if (!$booking) {
            $json['msg'] = 'data Booking tidak ditemukan';
        } else {
            $delete = $this->model->delete($id_booking);
            if ($delete) {
                $json['success']    = 1;
            } else {
                $json['msg']        = $delete;
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
        $data['jadwal_transport'] = $this->model->where('status', 'diproses')->get()->getResult();
        return _tempHTML('transportasi/jadwal_transport', $data);
    }
    public function details_jadwal($id_booking)
    {
        $data['start_time'] = selectJadwalStart();
        $data['end_time'] = selectJadwalEnd();
        $data['booking'] = getData('tb_booking_transport', ['id_booking' => $id_booking])->get()->getRow();
        return _tempHTML('transportasi/jadwal_details', $data);
    }
    public function jadwal_update()
    {
        $json['input'] = [
            'km_berangkat'  => $this->_validation('km_berangkat', 'KM Berangkat', 'required'),
            'km_kembali'    => $this->_validation('km_kembali', 'KM Kembali', 'required'),
            'tgl_berangkat' => $this->_validation('tgl_berangkat', 'Tanggal Berangkat', 'required|valid_date'),
            'biaya_etol'    => $this->_validation('biaya_etol', 'Biaya E-tol', 'required|decimal'),
            'top_up_etol'   => $this->_validation('top_up_etol', 'Top Up E-tol', 'required|decimal'),
            'bensin'        => $this->_validation('bensin', 'Bensin', 'required|decimal'),
        ];
        $json['select'] = [
            'jam_berangkat'  => $this->_validation('jam_berangkat', 'Jam Berangkat', 'required'),
            'jam_pulang'  => $this->_validation('jam_pulang', 'Jam Pulang', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $booking            = getData('tb_booking_transport', ['id_booking' => _getVar($this->request->getVar('e_id_booking'))])->get()->getRow();
            $status             = getData('ms_status', ['id_status' => 5])->get()->getRow();
            $jam_berangkat      = _getVar($this->request->getVar('jam_berangkat'));
            $jam_pulang        = _getVar($this->request->getVar('jam_pulang'));
            $km_berangkat      = _getVar($this->request->getVar('km_berangkat'));
            $km_kembali        = _getVar($this->request->getVar('km_kembali'));
            $tgl_berangkat      = _getVar($this->request->getVar('tgl_berangkat'));
            $biaya_etol       = _getVar($this->request->getVar('biaya_etol'));
            $top_up_etol      = _getVar($this->request->getVar('top_up_etol'));
            $bensin           = _getVar($this->request->getVar('bensin'));
            $data = [
                'jam_berangkat'   => $jam_berangkat,
                'km_berangkat'    => $km_berangkat,
                'jam_pulang'      => $jam_pulang,
                'km_kembali'      => $km_kembali,
                'tgl_berangkat'   => $tgl_berangkat,
                'biaya_etol'      => $biaya_etol,
                'top_up_etol'     => $top_up_etol,
                'bensin'          => $bensin,
                'id_status'       => 5,
                'status'          => $status->status,
            ];
            $update = updateData('tb_booking_transport', ['id_booking' => $booking->id_booking]);
            if ($update) {
                $json['success'] = $update;
            } else {
                $json['error'] = 'data gagal update';
            }
            $json['rscript']    = csrf_hash();
            echo json_encode($json);
        }
    }
    public function record()
    {
        $data['record_perjalanan'] = $this->model->where('status', 'selesai')->get()->getResult();
        return _tempHTML('transportasi/record_perjalanan', $data);
    }
}
