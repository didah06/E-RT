<?php

namespace App\Controllers;

use App\Models\TransportModel;
use App\Models\JadwalTransportModel;
use App\Models\KendaraanModel;
use App\Models\AsuransiModel;
use App\Models\PajakModel;
use App\Models\SteamModel;
use App\Models\ServiceModel;

use CodeIgniter\API\ResponseTrait;

class Transportasi extends BaseController
{
    use ResponseTrait;
    protected $model;
    protected $modeljadwal;
    protected $modelkendaraan;
    protected $modelasuransi;
    protected $modelpajak;
    protected $modelsteam;
    protected $modelservice;

    public function __construct()
    {
        $this->model       = new TransportModel();
        $this->modeljadwal = new JadwalTransportModel();
        $this->modelkendaraan = new KendaraanModel();
        $this->modelasuransi = new AsuransiModel();
        $this->modelpajak = new PajakModel();
        $this->modelsteam = new SteamModel();
        $this->modelservice = new ServiceModel();
    }
    public function index()
    {
        $user     = getUser(['id' => _session('id')])->getRow();
        if (_session('jenis') != 'Admin') {
            $data['departemen'] = selectDepartemen(['id_divisi' => $user->departemen]);
        }
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
    public function select_jadwal_start($tanggal_pemakaian)
    {
        $defaultNull        = _getVar($this->request->getVar('df'));
        $id_booking         = _getVar($this->request->getVar('id_booking'));
        $jadwal             = getJadwal($tanggal_pemakaian)->getResult();
        // $ms_jadwal = getData('ms_jadwal')->get()->getResult();
        if ($defaultNull == '') {
            $select    = '<option value="" selected disabled>--Pilih Jam Keberangkatan--</option>';
        } else if ($defaultNull == 1) {
            $select    = '<option value="" selected>--Semua Jam Keberangkatan--</option>';
        } else {
            $select = '';
        }
        foreach ($jadwal as $item) {
            $disable = ($item->tujuan != "" && $item->id_booking != $id_booking) ? "disabled" : "";
            $str = ($item->tujuan != "") ? ' - ' . $item->departemen . ' ' . $item->tujuan : '';
            if ($item->id_booking == $id_booking) {
                $select .= '<option value="' . $item->start_time . '" selected>' . $item->start_time  . $str . '</option>';
            } else {
                $select .= '<option value="' . $item->start_time . '" ' . $disable . '>' . $item->start_time  . $str . '</option>';
            }
        }
        echo $select;
    }
    public function select_jadwal_end($tanggal_pemakaian)
    {
        $defaultNull    = _getVar($this->request->getVar('df'));
        $id_booking     = _getVar($this->request->getVar('id_booking'));
        $jadwal         = getJadwalEnd($tanggal_pemakaian)->getResult();
        // $ms_jadwal = getData('ms_jadwal')->get()->getResult();
        if ($defaultNull == '') {
            $select    = '<option value="" selected disabled>--Pilih Jam Kembali--</option>';
        } else if ($defaultNull == 1) {
            $select    = '<option value="" selected>--Semua Jam Kembali--</option>';
        } else {
            $select = ''; // Initialize select variable
        }
        foreach ($jadwal as $item) {
            $disable = ($item->tujuan != "" && $item->id_booking != $id_booking) ? "disabled" : "";
            $str = ($item->tujuan != "") ? ' - ' . $item->departemen . ' ' . $item->tujuan : '';
            if ($item->id_booking == $id_booking) {
                $select .= '<option value="' . $item->end_time . '" selected>' . $item->end_time . $str . '</option>';
            } else {
                $select .= '<option value="' . $item->end_time . '" ' . $disable . '>' . $item->end_time . $str . '</option>';
            }
        }
        echo $select;
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
            'signature'    => $this->_validation('signature', 'Signature tidak boleh kosong', 'required'),
        ];
        $json['select'] = [
            'jam_keberangkatan' => $this->_validation('jam_keberangkatan', 'Jam Keberangkatan', 'required'),
            'jam_kembali'        => $this->_validation('jam_kembali', 'Jam Kembali', 'required'),
            'cara_pemakaian'    => $this->_validation('cara_pemakaian', 'Cara Pemakaian', 'required'),
            'type_pemakaian'    => $this->_validation('type_pemakaian', 'Tipe Pemakaian', 'required'),
            // 'id_kendaraan'      => $this->_validation('id_kendaraan', 'Jenis Kendaraan', 'required'),
        ];
        if (!empty($this->request->getVar('signature'))) {
            $user                   = getUser(['id' => _session('id')])->getRow();
            $data_signature         = _getVar($this->request->getVar('signature'));
            $exp                    = explode(';base64,', $data_signature);
            $image_type             = str_replace('data:image/', '', $exp[0]);
            $signature_base64       = $exp[1];
            if ($signature_base64 == _signatureKosong() && (_getVar($this->request->getVar('old_check')) != 1 || $user->ttd == 'default.png')) {
                $json['input']['signature']    = 'Signature masih kosong';
            }
        }
        $tanggal_pemakaian  = _getVar($this->request->getVar('tanggal_pemakaian'));
        $min_date = date('Y-m-d');
        if ($tanggal_pemakaian < $min_date) {
            $json['input']['tanggal_pemakaian'] = 'tanggal input pemakaian error';
            $json['error'] = 'minimum tanggal input adalah hari ini';
        }
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            // $kendaraan          = getData('ms_kendaraan', ['id_kendaraan' => _getVar($this->request->getVar('id_kendaraan'))])->get()->getRow();
            $jam_keberangkatan  = getData('ms_jadwal', ['start_time' => _getVar($this->request->getVar('jam_keberangkatan'))])->get()->getRow();
            $jam_kembali        = getData('ms_jadwal', ['end_time' => _getVar($this->request->getVar('jam_kembali'))])->get()->getRow();
            $status             = getData('ms_status', ['id_status' => 1])->get()->getRow();
            $kode_booking       = generateKodeBooking();
            $user               = getUser(['id' => _session('id')])->getRow();
            $cara_pemakaian     = _getVar($this->request->getVar('cara_pemakaian'));
            $type_pemakaian     = _getVar($this->request->getVar('type_pemakaian'));
            $tujuan             = _getVar($this->request->getVar('tujuan'));
            $acara_kegiatan     = _getVar($this->request->getVar('acara_kegiatan'));
            $jumlah_peserta     = _getVar($this->request->getVar('jumlah_peserta'));
            $anggaran           = _getVar($this->request->getVar('anggaran'));
            $old_check          = _getVar($this->request->getVar('old_check'));
            if (!$user) {
                $json['select']['id_direktorat']    = 'Pilihan data tidak ditemukan';
            } else if (!$jam_keberangkatan) {
                $json['select']['start_time']    = 'Pilihan data tidak ditemukan';
            } else if (!$jam_kembali) {
                $json['select']['end_time']    = 'Pilihan data tidak ditemukan';
            } else {
                if ($old_check == 1) {
                    $ttd = $user->ttd;
                } else {
                    $signature    = base64_decode($signature_base64);
                    $ttd          = time() . rand(1, 10000) . '.' . $image_type;
                    file_put_contents(FCPATH . 'public/assets/images/ttd/' . $ttd, $signature);
                    updateData('ms_user', ['ttd' => $ttd], ['id' => $user->id]);
                }
                $data = [
                    'kode_booking'      => $kode_booking,
                    'id_direktorat'     => $user->id_direktorat,
                    'direktorat'        => $user->direktorat,
                    'id_divisi'         => $user->id_divisi,
                    'divisi'            => $user->divisi,
                    'id_dept'           => $user->id_dept,
                    'departemen'        => $user->departemen,
                    'nama'              => $user->nama,
                    'pemohon_ttd'       => $ttd,
                    'tanggal_pemakaian' => $tanggal_pemakaian,
                    'id_jadwal_start'   => $jam_keberangkatan->id_jadwal_start,
                    'jam_keberangkatan' => $jam_keberangkatan->start_time,
                    'id_jadwal_end'     => $jam_kembali->id_jadwal_end,
                    'jam_kembali'       => $jam_kembali->end_time,
                    'cara_pemakaian'    => $cara_pemakaian,
                    'type_pemakaian'    => $type_pemakaian,
                    'tujuan'            => $tujuan,
                    'acara_kegiatan'    => $acara_kegiatan,
                    'jumlah_peserta'    => $jumlah_peserta,
                    'anggaran'          => $anggaran,
                    'id_status'         => $status->id_status,
                    'status'            => $status->status,
                    'created_at'        => time(),
                    'created_id'        => _session('user_id'),
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
        $booking            = getData('tb_booking_transport', ['id_booking' => _getVar($this->request->getVar('e_id_booking'))])->get()->getRow();
        $tanggal_pemakaian  = _getVar($this->request->getVar('e_tanggal_pemakaian'));
        $min_date = date('Y-m-d');
        if ($tanggal_pemakaian >= $min_date || $tanggal_pemakaian === $booking->tanggal_pemakaian) {
            $data['tanggal_pemakaian'] = $tanggal_pemakaian;
        } else {
            $json['input']['e_tanggal_pemakaian'] = 'tanggal input pemakaian error';
            $json['error'] = 'minimum tanggal input adalah hari ini';
        }
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $booking            = getData('tb_booking_transport', ['id_booking' => _getVar($this->request->getVar('e_id_booking'))])->get()->getRow();
            $jam_keberangkatan  = getData('ms_jadwal', ['start_time' => _getVar($this->request->getVar('e_jam_keberangkatan'))])->get()->getRow();
            $jam_kembali        = getData('ms_jadwal', ['end_time' => _getVar($this->request->getVar('e_jam_kembali'))])->get()->getRow();
            $jumlah_peserta     = _getVar($this->request->getVar('e_jumlah_peserta'));
            $anggaran           = _getVar($this->request->getVar('e_anggaran'));
            $tujuan             = _getVar($this->request->getVar('e_tujuan'));
            $acara_kegiatan     = _getVar($this->request->getVar('e_acara_kegiatan'));
            $cara_pemakaian    = _getVar($this->request->getVar('e_cara_pemakaian'));
            $type_pemakaian    = _getVar($this->request->getVar('e_type_pemakaian'));
            if (!$booking) {
                $json['error'] = 'data booking tidak ditemukan';
            } else {
                $data = [
                    'tanggal_pemakaian' => $tanggal_pemakaian,
                    'jumlah_peserta'    => $jumlah_peserta,
                    'anggaran'          => $anggaran,
                    'tujuan'            => $tujuan,
                    'acara_kegiatan'    => $acara_kegiatan,
                    'id_jadwal_start'   => $jam_keberangkatan->id_jadwal_start,
                    'jam_keberangkatan' => $jam_keberangkatan->start_time,
                    'id_jadwal_end'     => $jam_keberangkatan->id_jadwal_end,
                    'jam_kembali'       => $jam_kembali->end_time,
                    'cara_pemakaian'    => $cara_pemakaian,
                    'type_pemakaian'    => $type_pemakaian,
                ];
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
        $getBooking          = $this->model->find($id_booking);
        $json['input']    = [
            'signature'    => $this->_validation('signature', 'Signature tidak boleh kosong', 'required'),
        ];
        if (!empty($this->request->getVar('signature'))) {
            $user                   = getUser(['id' => _session('id')])->getRow();
            $data_signature         = _getVar($this->request->getVar('signature'));
            $exp                    = explode(';base64,', $data_signature);
            $image_type             = str_replace('data:image/', '', $exp[0]);
            $signature_base64       = $exp[1];
            if ($signature_base64 == _signatureKosong() && (_getVar($this->request->getVar('old_check')) != 1 || $user->ttd == 'default.png')) {
                $json['input']['signature']    = 'Signature masih kosong';
            }
        }
        if (_validationHasErrors($json['input'])) {
            $old_check            = _getVar($this->request->getVar('old_check'));
            $status              = getData('ms_status', ['id_status' => 3])->get()->getRow();
            if (!$getBooking) {
                $json['msg']           = 'Data tidak ditemukan atau anda tidak memiliki akses';
            } else {
                if ($old_check == 1) {
                    $ttd = $user->ttd;
                } else {
                    $signature    = base64_decode($signature_base64);
                    $ttd          = time() . rand(1, 10000) . '.' . $image_type;
                    file_put_contents(FCPATH . 'public/assets/images/ttd/' . $ttd, $signature);
                    updateData('ms_user', ['ttd' => $ttd], ['id' => $user->id]);
                }
                $data = [
                    'approved_kadep_by'    => _session('nama'),
                    'approved_kadep_at'    => time(),
                    'approved_kadep_ttd'   => $ttd,
                    'id_status'            => 3,
                    'status'               => $status->status,
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
    public function approved_kadiv($id_booking)
    {
        $getBooking = $this->model->find($id_booking);
        $json['input']    = [
            'signature'    => $this->_validation('signature', 'Signature', 'required'),
        ];
        if (!empty($this->request->getVar('signature'))) {
            $user                   = getUser(['id' => _session('id')])->getRow();
            $data_signature         = _getVar($this->request->getVar('signature'));
            $exp                    = explode(';base64,', $data_signature);
            $image_type             = str_replace('data:image/', '', $exp[0]);
            $signature_base64       = $exp[1];
            if ($signature_base64 == _signatureKosong() && (_getVar($this->request->getVar('old_check')) != 1 || $user->ttd == 'default.png')) {
                $json['input']['signature']    = 'Signature masih kosong';
            }
        }
        if (_validationHasErrors($json['input'])) {
            $status  = getData('ms_status', ['id_status' => 2])->get()->getRow();
            $old_check            = _getVar($this->request->getVar('old_check'));
            if (!$getBooking) {
                $json['msg']           = 'Data tidak ditemukan atau anda tidak memiliki akses';
            } else {
                if ($old_check == 1) {
                    $ttd    = $user->ttd;
                } else {
                    $signature    = base64_decode($signature_base64);
                    $ttd        = time() . rand(1, 10000) . '.' . $image_type;
                    file_put_contents(FCPATH . 'public/assets/images/ttd/' . $ttd, $signature);
                    updateData('ms_user', ['ttd' => $ttd], ['id' => $user->id]);
                }
                $data = [
                    'approved_kadiv_by'    => _session('nama'),
                    'approved_kadiv_at'    => time(),
                    'approved_kadiv_ttd'   => $ttd,
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
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function approved_RT($id_booking)
    {
        $getBooking = $this->model->find($id_booking);
        $json['input']    = [
            'signature'    => $this->_validation('signature', 'Signature tidak boleh kosong', 'required'),
        ];
        if (!empty($this->request->getVar('signature'))) {
            $user                   = getUser(['id' => _session('id')])->getRow();
            $data_signature         = _getVar($this->request->getVar('signature'));
            $exp                    = explode(';base64,', $data_signature);
            $image_type             = str_replace('data:image/', '', $exp[0]);
            $signature_base64       = $exp[1];
            if ($signature_base64 == _signatureKosong() && (_getVar($this->request->getVar('old_check')) != 1 || $user->ttd == 'default.png')) {
                $json['input']['signature']    = 'Signature masih kosong';
            }
        }
        if (_validationHasErrors($json['input'])) {
            $status  = getData('ms_status', ['id_status' => 4])->get()->getRow();
            $old_check            = _getVar($this->request->getVar('old_check'));
            if (!$getBooking) {
                $json['msg']           = 'Data tidak ditemukan atau anda tidak memiliki akses';
            } else {
                if ($old_check == 1) {
                    $ttd    = $user->ttd;
                } else {
                    $signature    = base64_decode($signature_base64);
                    $ttd        = time() . rand(1, 10000) . '.' . $image_type;
                    file_put_contents(FCPATH . 'public/assets/images/ttd/' . $ttd, $signature);
                    updateData('ms_user', ['ttd' => $ttd], ['id' => $user->id]);
                }
                $data = [
                    'approved_rt_by'      => _session('nama'),
                    'approved_rt_at'      => time(),
                    'approved_rt_ttd'     => $ttd,
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
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function unapproved($id_booking)
    {
        $json['input'] = [
            'ditolak_ket'  => $this->_validation('ditolak_ket', 'Keterangan', 'required'),
            'signature'    => $this->_validation('signature', 'Signature tidak boleh kosong', 'required'),
        ];
        if (!empty($this->request->getVar('signature'))) {
            $user                   = getUser(['id' => _session('id')])->getRow();
            $data_signature         = _getVar($this->request->getVar('signature'));
            $exp                    = explode(';base64,', $data_signature);
            $image_type             = str_replace('data:image/', '', $exp[0]);
            $signature_base64       = $exp[1];
            if ($signature_base64 == _signatureKosong() && (_getVar($this->request->getVar('old_check')) != 1 || $user->ttd == 'default.png')) {
                $json['input']['signature']    = 'Signature masih kosong';
            }
        }
        if (_validationHasErrors(array_merge($json['input']))) {
            $reason = _getVar($this->request->getVar('ditolak_ket'));
            $getBooking      = $this->model->find($id_booking);
            $old_check       = _getVar($this->request->getVar('old_check'));
            $status          = getData('ms_status', ['id_status' => 5])->get()->getRow();
            if (!$getBooking) {
                $json['msg']           = 'Data tidak ditemukan atau anda tidak memiliki akses';
            } else {
                if ($old_check == 1) {
                    $ttd    = $user->ttd;
                } else {
                    $signature    = base64_decode($signature_base64);
                    $ttd        = time() . rand(1, 10000) . '.' . $image_type;
                    file_put_contents(FCPATH . 'public/assets/images/ttd/' . $ttd, $signature);
                    updateData('ms_user', ['ttd' => $ttd], ['id' => $user->id]);
                }
                $data = [
                    'ditolak_by'         => _session('nama'),
                    'ditolak_at'          => time(),
                    'ditolak_ket'         => $reason,
                    'ditolak_ttd'         => $ttd,
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
    public function jadwal_save()
    {
        $id_booking = _getVar($this->request->getVar('id_booking'));
        $json['input'] = [
            'km_berangkat'       => $this->_validation('km_berangkat', 'KM Berangkat', 'required'),
            'km_kembali'         => $this->_validation('km_kembali', 'KM Kembali', 'required'),
            'tgl_berangkat'      => $this->_validation('tgl_berangkat', 'Tanggal Berangkat', 'required|valid_date'),
            'biaya_etol'         => $this->_validation('biaya_etol', 'Biaya E-tol', 'required|decimal'),
            'top_up'             => $this->_validation('top_up', 'Top Up E-tol', 'required|decimal'),
            'bensin'             => $this->_validation('bensin', 'Bensin', 'required|decimal'),
            'signature'          => $this->_validation('signature', 'signature', 'required'),
        ];
        $json['select'] = [
            'jam_berangkat'  => $this->_validation('jam_berangkat', 'Jam Berangkat', 'required'),
            'jam_pulang'  => $this->_validation('jam_pulang', 'Jam Pulang', 'required'),
        ];
        if (!empty($this->request->getVar('signature'))) {
            $user                   = getUser(['id' => _session('id')])->getRow();
            $data_signature         = _getVar($this->request->getVar('signature'));
            $exp                    = explode(';base64,', $data_signature);
            $image_type             = str_replace('data:image/', '', $exp[0]);
            $signature_base64       = $exp[1];
            if ($signature_base64 == _signatureKosong() && (_getVar($this->request->getVar('old_check')) != 1 || $user->ttd == 'default.png')) {
                $json['input']['signature']    = 'Signature masih kosong';
            }
        }
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $status  = getData('ms_status', ['id_status' => 6])->get()->getRow();
            $booking = getData('tb_booking_transport', ['id_booking' => _getVar($this->request->getVar('id_booking'))])->get()->getRow();
            $jam_berangkat      = _getVar($this->request->getVar('jam_berangkat'));
            $jam_pulang         = _getVar($this->request->getVar('jam_pulang'));
            $km_berangkat       = _getVar($this->request->getVar('km_berangkat'));
            $km_kembali         = _getVar($this->request->getVar('km_kembali'));
            $tgl_berangkat      = _getVar($this->request->getVar('tgl_berangkat'));
            $biaya_etol         = _getVar($this->request->getVar('biaya_etol'));
            $top_up             = _getVar($this->request->getVar('top_up'));
            $saldo_akhir_etol   = $booking->saldo_awal_etol - $biaya_etol + $top_up;
            $bensin             = _getVar($this->request->getVar('bensin'));
            $total_pengeluaran  = $biaya_etol + $bensin;
            $old_check  = _getVar($this->request->getVar('old_check'));
            if ($old_check == 1) {
                $ttd    = $user->ttd;
            } else {
                $signature    = base64_decode($signature_base64);
                $ttd          = time() . rand(1, 10000) . '.' . $image_type;
                file_put_contents(FCPATH . 'public/assets/images/ttd/' . $ttd, $signature);
                updateData('ms_user', ['ttd' => $ttd], ['id' => $user->id]);
            }
            $data = [
                'jam_berangkat'     => $jam_berangkat,
                'km_berangkat'      => $km_berangkat,
                'jam_pulang'        => $jam_pulang,
                'km_kembali'        => $km_kembali,
                'tgl_berangkat'     => $tgl_berangkat,
                'biaya_etol'        => $biaya_etol,
                'top_up'            => $top_up,
                'saldo_akhir_etol'  => $saldo_akhir_etol,
                'bensin'            => $bensin,
                'total_pengeluaran' => $total_pengeluaran,
                'ttd_form_pengeluaran' => $ttd,
                'id_status'         => 6,
                'status'            => $status->status,
                'selesai_by'        => _session('nama'),
                'selesai_at'        => time(),
            ];
            $add = updateData('tb_booking_transport', $data, ['id_booking' => $id_booking]);;
            if ($add) {
                $json['success'] = $add;
            } else {
                $json['error'] = 'data gagal ditambah';
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function record()
    {
        $data['record_perjalanan'] = $this->model->where('status', 'selesai')->get()->getResult();
        return _tempHTML('transportasi/record_perjalanan', $data);
    }
    public function inventaris()
    {
        $data['kendaraan'] = selectKendaraan();
        $data['inventaris_transport'] = getData('ms_kendaraan')->get()->getResult();
        return _tempHTML('transportasi/inventaris', $data);
    }
    public function inventaris_save()
    {
        $json['input'] = [
            'jenis_kendaraan'      => $this->_validation('jenis_kendaraan', 'Jenis Kendaraan', 'required'),
            'merk'                 => $this->_validation('merk', 'Merk Kendaraan', 'required'),
            'brand'                => $this->_validation('brand', 'Brand Kendaraan', 'required'),
            'warna'                => $this->_validation('warna', 'Warna', 'required'),
            'kapasitas'            => $this->_validation('kapasitas', 'Kapasitas', 'required|decimal'),
            'jml_kendaraan'        => $this->_validation('jml_kendaraan', 'Jumlah Kendaraan', 'required|decimal'),
            'no_polisi'            => $this->_validation('no_polisi', 'No Polisi', 'required'),
            'tgl_stnk'             => $this->_validation('tgl_stnk', 'tanggal STNK', 'required|valid_date'),
            'foto_stnk'            => $this->_validation('foto_stnk', 'foto STNK', 'uploaded[foto_stnk]|mime_in[foto_stnk,image/jpeg,image/png,image/jpg]'),
        ];
        $json['select'] = [
            'tahun_kendaraan'   => $this->_validation('tahun_kendaraan', 'Tahun Kendaraan', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $jenis_kendaraan    = _getVar($this->request->getVar('jenis_kendaraan'));
            $merk               = _getVar($this->request->getVar('merk'));
            $brand              = _getVar($this->request->getVar('brand'));
            $warna              = _getVar($this->request->getVar('warna'));
            $kapasitas          = _getVar($this->request->getVar('kapasitas'));
            $jml_kendaraan      = _getVar($this->request->getVar('jml_kendaraan'));
            $no_polisi          = _getVar($this->request->getVar('no_polisi'));
            $tahun_kendaraan    = _getVar($this->request->getVar('tahun_kendaraan'));
            $tgl_stnk           = _getVar($this->request->getVar('tgl_stnk'));
            $foto_stnk          = $this->request->getFile('foto_stnk');
            if ($foto_stnk->getError() == 0 && $foto_stnk->isValid() && !$foto_stnk->hasMoved()) {
                $filename        = $foto_stnk->getRandomName();
                $foto_stnk->move(FCPATH . './public/assets/images/transportasi/stnk', $filename);
                $data = [
                    'jenis_kendaraan' => $jenis_kendaraan,
                    'merk'            => $merk,
                    'brand'           => $brand,
                    'warna'           => $warna,
                    'kapasitas'       => $kapasitas,
                    'jml_kendaraan'   => $jml_kendaraan,
                    'no_polisi'       => $no_polisi,
                    'tahun_kendaraan' => $tahun_kendaraan,
                    'tgl_stnk'        => $tgl_stnk,
                    'foto_stnk'       => $filename,
                ];
                $add = $this->modelkendaraan->insert($data);
                if ($add) {
                    $json['success'] = $add;
                } else {
                    $json['error'] = 'gagal tambah data kendaraan';
                }
            } else {
                $json['input']['foto_stnk']    = 'Foto gagal upload';
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function inventaris_edit($id_kendaraan)
    {
        $kendaraan     = getData('ms_kendaraan', ['id_kendaraan' => $id_kendaraan])->get()->getRow();
        if ($kendaraan) {
            $data = [
                'status'    => true,
                'data'      => $kendaraan
            ];
        } else {
            $data = [
                'status'    => false,
                'data'      => ''
            ];
        }
        return $this->respond($data);
    }
    public function inventaris_update()
    {
        $json['input'] = [
            'e_jenis_kendaraan'      => $this->_validation('e_jenis_kendaraan', 'Jenis Kendaraan', 'required'),
            'e_merk'                 => $this->_validation('e_merk', 'Merk Kendaraan', 'required'),
            'e_brand'                => $this->_validation('e_brand', 'Brand Kendaraan', 'required'),
            'e_warna'                => $this->_validation('e_warna', 'Warna', 'required'),
            'e_kapasitas'            => $this->_validation('e_kapasitas', 'Kapasitas', 'required|decimal'),
            'e_jml_kendaraan'        => $this->_validation('e_jml_kendaraan', 'Jumlah Kendaraan', 'required|decimal'),
            'e_no_polisi'            => $this->_validation('e_no_polisi', 'No Polisi', 'required'),
            'e_tgl_stnk'             => $this->_validation('e_tgl_stnk', 'tanggal STNK', 'required|valid_date'),
            'e_foto_stnk'            => $this->_validation('e_foto_stnk', 'foto STNK', 'uploaded[e_foto_stnk]|mime_in[e_foto_stnk,image/jpeg,image/png,image/jpg]'),
        ];
        $json['select'] = [
            'e_tahun_kendaraan'   => $this->_validation('e_tahun_kendaraan', 'Tahun Kendaraan', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $kendaraan            = getData('ms_kendaraan', ['id_kendaraan' => _getVar($this->request->getVar('e_id_kendaraan'))])->get()->getRow();
            $jenis_kendaraan    = _getVar($this->request->getVar('e_jenis_kendaraan'));
            $merk               = _getVar($this->request->getVar('e_merk'));
            $brand              = _getVar($this->request->getVar('e_brand'));
            $warna              = _getVar($this->request->getVar('e_warna'));
            $kapasitas          = _getVar($this->request->getVar('e_kapasitas'));
            $jml_kendaraan      = _getVar($this->request->getVar('e_jml_kendaraan'));
            $no_polisi          = _getVar($this->request->getVar('e_no_polisi'));
            $tahun_kendaraan    = _getVar($this->request->getVar('e_tahun_kendaraan'));
            $tgl_stnk           = _getVar($this->request->getVar('e_tgl_stnk'));
            $foto_stnk          = $this->request->getFile('e_foto_stnk');
            if ($foto_stnk->getError() === 0 && $foto_stnk->isValid() && !$foto_stnk->hasMoved()) {
                $filename        = $foto_stnk->getRandomName();
                if ($foto_stnk->move(FCPATH . 'public/assets/images/transportasi/stnk', $filename)) {
                    // Check if the file has moved successfully
                    if (file_exists(FCPATH . 'public/assets/images/transportasi/stnk/' . $filename) && $filename != 'default.jpg') {
                        // Delete the old file, if it exists
                        if (file_exists(FCPATH . 'public/assets/images/transportasi/stnk/' . $filename) && $filename != 'default.jpg') {
                            unlink(FCPATH . 'public/assets/images/transportasi/stnk/' . $filename);
                        }
                    } else {
                        $json['error'] = "Failed to delete old file";
                    }
                    $data = [
                        'jenis_kendaraan' => $jenis_kendaraan,
                        'merk'            => $merk,
                        'brand'           => $brand,
                        'warna'           => $warna,
                        'kapasitas'       => $kapasitas,
                        'jml_kendaraan'   => $jml_kendaraan,
                        'no_polisi'       => $no_polisi,
                        'tahun_kendaraan' => $tahun_kendaraan,
                        'tgl_stnk'        => $tgl_stnk,
                        'foto_stnk'       => $filename,
                    ];
                    $update = updateData('ms_kendaraan', $data, ['id_kendaraan' => $kendaraan->id_kendaraan]);
                    if ($update) {
                        $json['success'] = $update;
                    } else {
                        $json['error'] = "data gagal update";
                    }
                } else {
                    $json['error'] = 'gagal upload foto';
                }
            } else {
                $foto_stnk = $kendaraan->foto_stnk;
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function pemeliharaan($id_kendaraan)
    {
        $data['inventaris_transport'] = getData('ms_kendaraan', ['id_kendaraan' => $id_kendaraan])->get()->getResult();
        $data['ms_transport']         = getData('ms_kendaraan', ['id_kendaraan' => $id_kendaraan])->get()->getRow();
        $data['asuransi']             = getData('ms_kendaraan_asuransi', ['id_kendaraan' => $id_kendaraan], 'id_asuransi DESC')->get()->getResult();
        $data['asuransi_tp']          = getData('ms_kendaraan_asuransi', ['id_kendaraan' => $id_kendaraan], 'id_asuransi DESC')->get()->getRow();
        $data['pajak']                = getData('ms_kendaraan_pajak', ['id_kendaraan' => $id_kendaraan], 'id_pajak DESC')->get()->getResult();
        $data['pajak_tp']             = getData('ms_kendaraan_pajak', ['id_kendaraan' => $id_kendaraan], 'id_pajak DESC')->get()->getRow();
        $data['service']              = getData('ms_kendaraan_service', ['id_kendaraan' => $id_kendaraan], 'id_service DESC')->get()->getResult();
        $data['service_tp']           = getData('ms_kendaraan_service', ['id_kendaraan' => $id_kendaraan], 'id_service DESC')->get()->getRow();
        $data['steam']                = getData('ms_kendaraan_steam', ['id_kendaraan' => $id_kendaraan], 'id_steam DESC')->get()->getResult();
        $data['steam_tp']             = getData('ms_kendaraan_steam', ['id_kendaraan' => $id_kendaraan], 'id_steam DESC')->get()->getRow();
        return _tempHTML('transportasi/pemeliharaan_transport', $data);
    }
    public function asuransi_save()
    {
        $id_kendaraan = $this->request->getVar('id_kendaraan');
        // validation
        $json['input'] = [
            'id_kendaraan'           => $this->_validation('id_kendaraan', 'Id Kendaraan', 'required'),
            'no_asuransi'            => $this->_validation('no_asuransi', 'No Asuransi', 'required'),
            'asuransi'               => $this->_validation('asuransi', 'Asuransi', 'required'),
            'masa_berlaku_asuransi'  => $this->_validation('masa_berlaku_asuransi', 'Masa Berlaku Asuransi', 'required|valid_date'),
        ];
        if (_validationHasErrors($json['input'])) {
            $no_asuransi            = _getVar($this->request->getVar('no_asuransi'));
            $asuransi               = _getVar($this->request->getVar('asuransi'));
            $masa_berlaku_asuransi  = _getVar($this->request->getVar('masa_berlaku_asuransi'));
            $data = [
                'id_kendaraan'          => $id_kendaraan,
                'no_asuransi'           => $no_asuransi,
                'asuransi'              => $asuransi,
                'masa_berlaku_asuransi' => $masa_berlaku_asuransi,
            ];
            $add = $this->modelasuransi->insert($data);
            if ($add > 0) {
                $data = [
                    'no_asuransi' => $no_asuransi,
                ];
                updateData('ms_kendaraan', $data, ['id_kendaraan' => $id_kendaraan]);
                $json['success'] = $add;
            } else {
                $json['error'] = 'data asuransi gagal ditambahkan';
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function asuransi_edit($id_asuransi)
    {
        $asuransi     = getData('ms_kendaraan_asuransi', ['id_asuransi' => $id_asuransi])->get()->getRow();
        if ($asuransi) {
            $data = [
                'status'    => true,
                'data'      => $asuransi
            ];
        } else {
            $data = [
                'status'    => false,
                'data'      => ''
            ];
        }
        return $this->respond($data);
    }
    public function asuransi_update()
    {
        $id_kendaraan       = $this->request->getVar('id_kendaraan');
        $id_asuransi        = $this->request->getVar('e_id_asuransi');
        $json['input'] = [
            'e_no_asuransi'            => $this->_validation('e_no_asuransi', 'No Asuransi', 'required'),
            'e_asuransi'               => $this->_validation('e_asuransi', 'asuransi', 'required'),
            'e_masa_berlaku_asuransi'  => $this->_validation('e_masa_berlaku_asuransi', 'masa berlaku asuransi', 'required|valid_date'),
        ];
        if (_validationHasErrors($json['input'])) {
            $no_asuransi           = $this->request->getVar('e_no_asuransi');
            $asuransi              = $this->request->getVar('e_asuransi');
            $masa_berlaku_asuransi = $this->request->getVar('e_masa_berlaku_asuransi');
            $data = [
                'id_kendaraan'          => $id_kendaraan,
                'no_asuransi'           => $no_asuransi,
                'asuransi'              => $asuransi,
                'masa_berlaku_asuransi' => $masa_berlaku_asuransi,
            ];
            $update = updateData('ms_kendaraan_asuransi', $data, ['id_asuransi' => $id_asuransi, 'id_kendaraan' => $id_kendaraan]);
            if ($update > 0) {
                $data = [
                    'no_asuransi' => $no_asuransi,
                ];
                updateData('ms_kendaraan', $data, ['id_kendaraan' => $id_kendaraan]);
                $json['success'] = $update;
            } else {
                $json['error'] = 'data gagal diupdate';
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function pajak_save()
    {
        $id_kendaraan = _getVar($this->request->getVar('id_kendaraan'));
        $json['input'] = [
            'tgl_pajak'       => $this->_validation('tgl_pajak', 'Tanggal Pajak', 'required|valid_date'),
            'foto_pajak'      => $this->_validation('foto', 'foto Pajak', 'uploaded[foto_pajak]|mime_in[foto_pajak,image/jpeg,image/png,image/jpg]'),
        ];
        if (_validationHasErrors($json['input'])) {
            $tgl_pajak      = _getVar($this->request->getVar('tgl_pajak'));
            $foto           = $this->request->getFile('foto_pajak');
            if ($foto->getError() == 0 && $foto->isValid() && !$foto->hasMoved()) {
                $filename        = $foto->getRandomName();
                $foto->move(FCPATH . './public/assets/images/transportasi/pajak', $filename);
                $data = [
                    'id_kendaraan'   => $id_kendaraan,
                    'tgl_pajak'      => $tgl_pajak,
                    'foto_pajak'     => $filename,
                ];
                $add = $this->modelpajak->insert($data);
                if ($add > 0) {
                    updateData('ms_kendaraan', $data, ['id_kendaraan' => $id_kendaraan]);
                    $json['success'] = $add;
                } else {
                    $json['error'] = 'data gagal ditambahkan';
                }
            } else {
                $json['input']['foto_pajak'] = "foto gagal upload";
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function pajak_edit($id_pajak)
    {
        $pajak     = getData('ms_kendaraan_pajak', ['id_pajak' => $id_pajak])->get()->getRow();
        if ($pajak) {
            $data = [
                'status'    => true,
                'data'      => $pajak
            ];
        } else {
            $data = [
                'status'    => false,
                'data'      => ''
            ];
        }
        return $this->respond($data);
    }
    public function pajak_update()
    {
        $id_kendaraan = $this->request->getVar('id_kendaraan');
        $id_pajak = $this->request->getVar('e_id_pajak');
        $json['input'] = [
            'e_tgl_pajak' => $this->_validation('e_tgl_pajak', 'Tanggal Pajak', 'required|valid_date'),
            'e_foto_pajak'  => $this->_validation('e_foto_pajak', 'foto Pajak', 'uploaded[e_foto_pajak]|mime_in[e_foto_pajak,image/jpeg,image/png,image/jpg]'),
        ];
        if (_validationHasErrors($json['input'])) {
            $pajak          = getData('ms_kendaraan_pajak', ['id_pajak' => _getVar($this->request->getVar('id_pajak'))]);
            $tgl_pajak      = _getVar($this->request->getVar('e_tgl_pajak'));
            $foto           = $this->request->getFile('e_foto_pajak');
            if ($foto->getError() == 0 && $foto->isValid() && !$foto->hasMoved()) {
                $filename        = $foto->getRandomName();
                if ($foto->move(FCPATH . './public/assets/images/transportasi/pajak', $filename)) {
                    if (file_exists(FCPATH . './public/assets/images/transportasi/pajak' . $filename) && $filename != 'default.jpg') {
                        // Delete the old file, if it exists
                        if (file_exists(FCPATH . './public/assets/images/transportasi/pajak' . $filename) && $filename != 'default.jpg') {
                            unlink(FCPATH . './public/assets/images/transportasi/pajak' . $filename);
                        }
                    } else {
                        $json['error'] = "Failed to delete old file";
                    }
                    $data = [
                        'id_kendaraan'   => $id_kendaraan,
                        'tgl_pajak'      => $tgl_pajak,
                        'foto_pajak'     => $filename,
                    ];
                    $update = updateData('ms_kendaraan_pajak', $data, ['id_pajak' => $id_pajak, 'id_kendaraan' => $id_kendaraan]);
                    if ($update > 0) {
                        $data = [
                            'tgl_pajak' => $tgl_pajak,
                            'foto_pajak' => $filename,
                        ];
                        updateData('ms_kendaraan', $data, ['id_kendaraan' => $id_kendaraan]);
                        $json['success'] = $update;
                    } else {
                        $json['error'] = 'data gagal di update';
                    }
                } else {
                    $json['input']['foto_pajak'] = "foto gagal upload";
                }
            } else {
                $foto = $pajak->foto_pajak;
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function steam_save()
    {
        $id_kendaraan = _getVar($this->request->getVar('id_kendaraan'));
        $json['input'] = [
            'tgl_terakhir_steam'       => $this->_validation('tgl_terakhir_steam', 'Tanggal Terakhir Steam', 'required|valid_date'),
            'nota_steam'               => $this->_validation('nota_steam', 'Nota Steam', 'uploaded[nota_steam]|mime_in[nota_steam,image/jpeg,image/png,image/jpg]'),
            'tempat_steam'             => $this->_validation('tempat_steam', 'Tempat', 'required'),
        ];
        if (_validationHasErrors($json['input'])) {
            $tgl_terakhir_steam = _getVar($this->request->getVar('tgl_terakhir_steam'));
            $nota_steam         = $this->request->getFile('nota_steam');
            $tempat             = _getVar($this->request->getVar('tempat_steam'));
            if ($nota_steam->getError() == 0 && $nota_steam->isValid() && !$nota_steam->hasMoved()) {
                $nota       = $nota_steam->getRandomName();
                $nota_steam->move(FCPATH . './public/assets/images/transportasi/nota_steam', $nota);
                $data = [
                    'id_kendaraan'         => $id_kendaraan,
                    'tgl_terakhir_steam'   => $tgl_terakhir_steam,
                    'nota_steam'           => $nota,
                    'tempat_steam'         => $tempat,
                ];
                $add = $this->modelsteam->insert($data);
                if ($add > 0) {
                    $data = [
                        'tgl_terakhir_steam'   => $tgl_terakhir_steam,
                    ];
                    updateData('ms_kendaraan', $data, ['id_kendaraan' => $id_kendaraan]);
                    $json['success'] = $add;
                } else {
                    $json['error'] = 'data gagal ditambahkan';
                }
            } else {
                $json['input']['nota_steam'] = "nota gagal upload";
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function steam_edit($id_steam)
    {
        $steam     = getData('ms_kendaraan_steam', ['id_steam' => $id_steam])->get()->getRow();
        if ($steam) {
            $data = [
                'status'    => true,
                'data'      => $steam
            ];
        } else {
            $data = [
                'status'    => false,
                'data'      => ''
            ];
        }
        return $this->respond($data);
    }
    public function steam_update()
    {
        $id_kendaraan = _getVar($this->request->getVar('id_kendaraan'));
        $id_steam = $this->request->getVar('e_id_steam');
        $json['input'] = [
            'e_tgl_terakhir_steam'       => $this->_validation('e_tgl_terakhir_steam', 'Tanggal Terakhir Steam', 'required|valid_date'),
            'e_nota_steam'               => $this->_validation('e_nota_steam', 'Nota Steam', 'uploaded[nota_steam]|mime_in[nota_steam,image/jpeg,image/png,image/jpg]'),
            'e_tempat_steam'             => $this->_validation('e_tempat_steam', 'Tempat', 'required'),
        ];
        if (_validationHasErrors($json['input'])) {
            $steam              = getData('ms_kendaraan_steam', ['id_steam' => _getVar($this->request->getVar('id_steam'))]);
            $tgl_terakhir_steam = _getVar($this->request->getVar('e_tgl_terakhir_steam'));
            $nota_steam         = $this->request->getFile('e_nota_steam');
            $tempat             = _getVar($this->request->getVar('e_tempat_steam'));
            if ($nota_steam->getError() == 0 && $nota_steam->isValid() && !$nota_steam->hasMoved()) {
                $nota       = $nota_steam->getRandomName();
                if ($nota_steam->move(FCPATH . './public/assets/images/transportasi/nota_steam', $nota)) {
                    if (file_exists(FCPATH . './public/assets/images/transportasi/nota_steam' . $nota) && $nota != 'default.jpg') {
                        // Delete the old file, if it exists
                        if (file_exists(FCPATH . './public/assets/images/transportasi/nota_steam' . $nota) && $nota != 'default.jpg') {
                            unlink(FCPATH . './public/assets/images/transportasi/nota_steam' . $nota);
                        }
                    } else {
                        $json['error'] = "Failed to delete old file";
                    }
                    $data = [
                        'id_kendaraan'         => $id_kendaraan,
                        'tgl_terakhir_steam'   => $tgl_terakhir_steam,
                        'nota_steam'           => $nota,
                        'tempat_steam'         => $tempat,
                    ];
                    $update = updateData('ms_kendaraan_steam', $data, ['id_steam' => $steam->id_steam, 'id_kendaraan' => $id_kendaraan]);
                    if ($update > 0) {
                        $data = [
                            'tgl_service_terakhir' => $tgl_terakhir_steam,
                        ];
                        updateData('ms_kendaraan', $data, ['id_kendaraan' => $id_kendaraan]);
                        $json['success'] = $update;
                    } else {
                        $json['error'] = 'data gagal diupdate';
                    }
                } else {
                    $json['input']['nota_steam'] = "nota gagal upload";
                }
            } else {
                $nota = $steam->nota_steam;
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function service_save()
    {
        $id_kendaraan = _getVar($this->request->getVar('id_kendaraan'));
        $json['input'] = [
            'tgl_service_terakhir'     => $this->_validation('tgl_service_terakhir', 'Tanggal Terakhir Service', 'required|valid_date'),
            'nota_service'             => $this->_validation('nota_service', 'Nota Service', 'uploaded[nota_service]|mime_in[nota_service,image/jpeg,image/png,image/jpg]'),
            'tempat_service'           => $this->_validation('tempat_service', 'Tempat', 'required'),
        ];
        if (_validationHasErrors($json['input'])) {
            $tgl_terakhir_service = _getVar($this->request->getVar('tgl_service_terakhir'));
            $nota_service         = $this->request->getFile('nota_service');
            $tempat             = _getVar($this->request->getVar('tempat_service'));
            if ($nota_service->getError() == 0 && $nota_service->isValid() && !$nota_service->hasMoved()) {
                $nota       = $nota_service->getRandomName();
                $nota_service->move(FCPATH . './public/assets/images/transportasi/nota_service', $nota);
                $data = [
                    'id_kendaraan'         => $id_kendaraan,
                    'tgl_service_terakhir' => $tgl_terakhir_service,
                    'nota_service'         => $nota,
                    'tempat_service'       => $tempat,
                ];
                $add = $this->modelservice->insert($data);
                if ($add > 0) {
                    $data = [
                        'tgl_service_terakhir' => $tgl_terakhir_service,
                    ];
                    updateData('ms_kendaraan', $data, ['id_kendaraan' => $id_kendaraan]);
                    $json['success'] = $add;
                } else {
                    $json['error'] = 'data gagal ditambahkan';
                }
            } else {
                $json['input']['nota_service'] = "nota gagal upload";
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function service_edit($id_service)
    {
        $service     = getData('ms_kendaraan_service', ['id_service' => $id_service])->get()->getRow();
        if ($service) {
            $data = [
                'status'    => true,
                'data'      => $service
            ];
        } else {
            $data = [
                'status'    => false,
                'data'      => ''
            ];
        }
        return $this->respond($data);
    }
    public function service_update()
    {
        $id_kendaraan = _getVar($this->request->getVar('id_kendaraan'));
        $json['input'] = [
            'e_tgl_service_terakhir'     => $this->_validation('e_tgl_service_terakhir', 'Tanggal Terakhir Service', 'required|valid_date'),
            'e_nota_service'             => $this->_validation('e_nota_service', 'Nota Service', 'uploaded[nota_service]|mime_in[nota_service,image/jpeg,image/png,image/jpg]'),
            'e_tempat_service'           => $this->_validation('e_tempat_service', 'Tempat', 'required'),
        ];
        if (_validationHasErrors($json['input'])) {
            $service              = getData('ms_kendaraan_service', ['id_service' => _getVar($this->request->getVar('id_service'))]);
            $tgl_terakhir_service = _getVar($this->request->getVar('e_tgl_service_terakhir'));
            $nota_service         = $this->request->getFile('e_nota_service');
            $tempat               = _getVar($this->request->getVar('e_tempat_service'));
            if ($nota_service->getError() == 0 && $nota_service->isValid() && !$nota_service->hasMoved()) {
                $nota       = $nota_service->getRandomName();
                if ($nota_service->move(FCPATH . './public/assets/images/transportasi/nota_service', $nota)) {
                    if (file_exists(FCPATH . './public/assets/images/transportasi/nota_service' . $nota) && $nota != 'default.jpg') {
                        // Delete the old file, if it exists
                        if (file_exists(FCPATH . './public/assets/images/transportasi/nota_service' . $nota) && $nota != 'default.jpg') {
                            unlink(FCPATH . './public/assets/images/transportasi/nota_service' . $nota);
                        }
                    } else {
                        $json['error'] = "Failed to delete old file";
                    }
                    $data = [
                        'id_kendaraan'         => $id_kendaraan,
                        'tgl_service_terakhir' => $tgl_terakhir_service,
                        'nota_service'         => $nota,
                        'tempat_service'       => $tempat,
                    ];
                    $update = updateData('ms_kendaraan_service', $data, ['id_service' => $service->id_service, 'id_kendaraan' => $id_kendaraan]);
                    if ($update > 0) {
                        $data = [
                            'tgl_service_terakhir' => $tgl_terakhir_service,
                        ];
                        updateData('ms_kendaraan', $data, ['id_kendaraan' => $id_kendaraan]);
                        $json['success'] = $update;
                    } else {
                        $json['error'] = 'data gagal di update';
                    }
                } else {
                    $json['input']['nota_service'] = "nota gagal upload";
                }
            } else {
                $nota = $service->nota_service;
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
}
