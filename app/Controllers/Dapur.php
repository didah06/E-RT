<?php

namespace App\Controllers;

use App\Models\DaftarMenuModel;

use App\Controllers\BaseController;

class Dapur extends BaseController
{
    public function __construct()
    {
        $this->model       = new DaftarMenuModel();
    }
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
                    'tgl_menu'   => $tgl_menu,
                    'menu_1'     => $menu_1,
                    'menu_2'     => $menu_2,
                    'menu_3'     => $menu_3,
                    'menu_4'     => $menu_4,
                    'id_sesi_menu' => $sesi_menu->id_sesi_menu,
                    'sesi_menu'    => $sesi_menu->sesi_menu,
                    'created_by'   => _session('nama'),
                    'created_at'   => time(),
                ];
                if (isMenuPagiExist($tgl_menu) > 0) {
                    $json['error'] = 'Menu pagi sudah ada pada tanggal tersebut. Anda tidak dapat menambahkan menu baru.';
                } else if (isMenuSiangExist($tgl_menu) > 0) {
                    $json['error'] = 'Menu siang sudah ada pada tanggal tersebut. Anda tidak dapat menambahkan menu baru.';
                } else if (isMenuMalamExist($tgl_menu) > 0) {
                    $json['error'] = 'Menu malam sudah ada pada tanggal tersebut. Anda tidak dapat menambahkan menu baru.';
                } else {
                    $add = addData('tb_daftar_menu', $data);
                    if ($add) {
                        $json['success'] = $add;
                    } else {
                        $json['error'] = 'tambah data gagal';
                    }
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
    public function delete($id_menu)
    {
        $menu = getData('tb_daftar_menu', ['id_menu' => $id_menu])->get()->getRow();
        $porsi = getData('tb_porsi_makanan')->get()->getRow();
        if (!$menu) {
            $json['msg'] = 'data Booking tidak ditemukan';
        } else if ($menu->tgl_menu == $porsi->tgl_produksi) {
            $json['msg']  = 'data menu sudah di set porsinya';
        } else {
            $delete = deleteData('tb_daftar_menu', ['id_menu' => $id_menu]);
            if ($delete) {
                $json['success']    = 1;
            } else {
                $json['msg']        = $delete;
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
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
        $data['menu']   = selectDaftarMenu();
        $start_date = _getVar($this->request->getVar('start_date'));
        $end_date   = _getVar($this->request->getVar('end_date'));
        $data['shift']      = selectShift();
        $data['area']       = selectArea();
        $data['start_date'] = $start_date == "" ? date('Y-m-') . '01' : $start_date;
        $data['end_date'] = $end_date == "" ? date('Y-m-t') : $end_date;
        $data['porsi'] = getData('tb_porsi_makanan', ['tgl_produksi BETWEEN "' . $data['start_date'] . '" AND "' . $data['end_date'] . '"' => null])->get()->getResult();
        return _tempHTML('dapur/porsi_makanan', $data);
    }
    public function porsi_save()
    {
        $json['input'] = [
            'jumlah_produksi'   => $this->_validation('jumlah_produksi', 'Jumlah Produksi', 'required|is_natural'),
            'jumlah_pembagian'  => $this->_validation('jumlah_pembagian', 'Jumlah Pembagian', 'required|is_natural'),
            'jumlah_persediaan' => $this->_validation('jumlah_persediaan', 'Jumlah Persediaan', 'required|is_natural'),
            'keterangan'        => $this->_validation('keterangan', 'Keterangan', 'required'),
            'foto'              => $this->_validation('foto', 'foto', 'uploaded[foto]|max_size[foto, 1024]|mime_in[foto,image/jpeg,image/png,image/jpg]'),
        ];
        $json['select'] = [
            'id_menu' => $this->_validation('id_menu', 'Menu', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $menu = getData('tb_daftar_menu', ['id_menu' => _getVar($this->request->getVar('id_menu'))])->get()->getRow();
            $porsi = getData('tb_porsi_makanan')->get()->getRow();
            $jumlah_produksi = _getVar($this->request->getVar('jumlah_produksi'));
            $jumlah_pembagian = _getVar($this->request->getVar('jumlah_pembagian'));
            $jumlah_persediaan = _getVar($this->request->getVar('jumlah_persediaan'));
            $keterangan = _getVar($this->request->getVar('keterangan'));
            $foto = $this->request->getFile('foto');
            if (!$menu) {
                $json['select']['id_menu'] = 'data menu tidak ditemukan';
            } else {
                if ($foto->getError() == 0 && $foto->isValid() && !$foto->hasMoved()) {
                    $photo        = $foto->getRandomName();
                    $foto->move(FCPATH . './public/assets/images/dapur/porsi_makanan', $photo);
                    $data = [
                        'tgl_produksi'      => $menu->tgl_menu,
                        'id_sesi_menu'      => $menu->id_sesi_menu,
                        'sesi_menu'         => $menu->sesi_menu,
                        'jumlah_produksi'   => $jumlah_produksi,
                        'jumlah_pembagian'  => $jumlah_pembagian,
                        'jumlah_persediaan' => $jumlah_persediaan,
                        'keterangan'        => $keterangan,
                        'foto'              => $photo,
                    ];
                    if ($menu->tgl_menu == $porsi->tgl_produksi) {
                        $json['error'] = 'menu ini porsinya sudah tersedia';
                    } else {
                        $add = addData('tb_porsi_makanan', $data);
                        if ($add) {
                            $json['success'] = 'data sukses upload';
                        } else {
                            $json['error'] = 'data gagal upload';
                        }
                    }
                } else {
                    $json['input']['foto'] = 'foto gagal upload';
                }
            }
        }
        $json['rscript'] = csrf_hash();
        return $this->response->setJSON($json);
    }
    public function porsi_edit($id_porsi_makanan)
    {
        $porsi = getData('tb_porsi_makanan', ['id_porsi_makanan' => $id_porsi_makanan])->get()->getRow();
        if ($porsi) {
            $data = [
                'status'    => true,
                'data'      => $porsi
            ];
        } else {
            $data = [
                'status'    => false,
                'data'      => ''
            ];
        }
        echo json_encode($data);
    }
    public function porsi_update()
    {
        $id_porsi_makanan = _getVar($this->request->getVar('e_id_porsi_makanan'));
        $json['input'] = [
            'e_jumlah_produksi'   => $this->_validation('e_jumlah_produksi', 'Jumlah Produksi', 'required|is_natural'),
            'e_jumlah_pembagian'  => $this->_validation('e_jumlah_pembagian', 'Jumlah Pembagian', 'required|is_natural'),
            'e_jumlah_persediaan' => $this->_validation('e_jumlah_persediaan', 'Jumlah Persediaan', 'required|is_natural'),
            'e_keterangan'        => $this->_validation('e_keterangan', 'Keterangan', 'required'),
            'e_foto'              => $this->_validation('e_foto', 'foto', 'uploaded[e_foto]|max_size[e_foto, 1024]|mime_in[e_foto,image/jpeg,image/png,image/jpg]'),
        ];
        if (_validationHasErrors(array_merge($json['input']))) {
            $jumlah_produksi = _getVar($this->request->getVar('e_jumlah_produksi'));
            $jumlah_pembagian = _getVar($this->request->getVar('e_jumlah_pembagian'));
            $jumlah_persediaan = _getVar($this->request->getVar('e_jumlah_persediaan'));
            $keterangan = _getVar($this->request->getVar('e_keterangan'));
            $porsi = getData('tb_porsi_makanan', ['id_porsi_makanan' => $id_porsi_makanan])->get()->getRow();
            $foto = $this->request->getFile('e_foto');
            if ($foto->getError() == 0 && $foto->isValid() && !$foto->hasMoved()) {
                $photo        = $foto->getRandomName();
                if ($foto->move(FCPATH . './public/assets/images/dapur/kebersihan_dapur', $photo)) {
                    if (file_exists(FCPATH . './public/assets/images/dapur/kebersihan_dapur' . $photo)) {
                        unlink(FCPATH . './public/assets/images/dapur/kebersihan_dapur' . $photo);
                    } else {
                        $json['error'] = "Failed to delete old file";
                    }
                    $data = [
                        'jumlah_produksi'   => $jumlah_produksi,
                        'jumlah_pembagian'  => $jumlah_pembagian,
                        'jumlah_persediaan' => $jumlah_persediaan,
                        'keterangan'        => $keterangan,
                        'foto'              => $photo,
                    ];
                    $update = updateData('tb_porsi_makanan', $data, ['id_porsi_makanan' => $id_porsi_makanan]);
                    if ($update) {
                        $json['success'] = 'data sukses upload';
                    } else {
                        $json['error'] = 'data gagal upload';
                    }
                } else {
                    $json['error'] = 'foto gagal upload';
                }
            } else {
                $foto = $porsi->foto;
            }
        }
        $json['rscript'] = csrf_hash();
        return $this->response->setJSON($json);
    }
    public function porsi_delete()
    {
        $id_porsi_makanan = $this->request->getPost('id_porsi_makanan');
        $json = [];

        if ($id_porsi_makanan) {
            foreach ($id_porsi_makanan as $porsi_id) {
                // Assuming 'deleteData' is a method in your model
                $delete = deleteData('tb_porsi_makanan', ['id_porsi_makanan' => $porsi_id]);
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
    // petugas dapur
    public function petugas_dapur()
    {
        $data['ms_user']       = selectUserDapur();
        $data['shift']         = selectShift();
        $data['petugas_dapur'] = getData('tb_petugas_dapur')->get()->getResult();
        return _tempHTML('dapur/petugas_dapur', $data);
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
    public function petugas_dapur_save()
    {
        $json['input'] = [
            'nama'        => $this->_validation('nama', 'Nama', 'required'),
            'foto'        => $this->_validation('foto', 'foto', 'uploaded[foto]|max_size[foto, 1024]|mime_in[foto,image/jpeg,image/png,image/jpg]'),
        ];
        $json['select'] = [
            'user_id'     => $this->_validation('user_id', 'User', 'required'),
            'id_shift'    => $this->_validation('id_shift', 'Shift', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $user          = getData('db_master.ms_user', ['user_id' => _getVar($this->request->getVar('user_id'))])->get()->getRow();
            $shift         = getData('ms_shift', ['id_shift' => _getVar($this->request->getVar('id_shift'))])->get()->getRow();
            $nama          = _getVar($this->request->getVar('nama'));
            $foto          = $this->request->getFile('foto');
            if (!$user) {
                $json['select']['user_id'] = 'Data user tidak ditemukan';
            } else if (!$shift) {
                $json['select']['id_shift'] = 'Data shift tidak ditemukan';
            } else {
                if ($foto->getError() == 0 && $foto->isValid() && !$foto->hasMoved()) {
                    $photo        = $foto->getRandomName();
                    ($foto->move(FCPATH . './public/assets/images/dapur/petugas_dapur', $photo));
                    $data = [
                        'user_id'  => $user->user_id,
                        'nama'     => $nama,
                        'id_shift' => $shift->id_shift,
                        'shift'    => $shift->shift,
                        'foto'     => $photo,
                    ];
                    $add = addData('tb_petugas_dapur', $data);
                    if ($add > 0) {
                        $data = [
                            'nama'  => $nama,
                        ];
                        updateData('db_master.ms_user', $data, ['user_id' => $user->user_id]);
                        $json['success'] = 'Data berhasil ditambahkan';
                    } else {
                        $json['error'] = 'Data gagal ditambahkan';
                    }
                } else {
                    $json['input']['foto'] = 'foto gagal di upload';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function petugas_dapur_edit($id_petugas_dapur)
    {
        $petugas_dapur = getData('tb_petugas_dapur', ['id_petugas_dapur' => $id_petugas_dapur])->get()->getRow();
        if ($petugas_dapur) {
            $data = [
                'status'    => true,
                'data'      => $petugas_dapur
            ];
        } else {
            $data = [
                'status'    => false,
                'data'      => ''
            ];
        }
        echo json_encode($data);
    }
    public function petugas_dapur_update()
    {
        $id_petugas_dapur = _getVar($this->request->getVar('e_id_petugas_dapur'));
        $json['input'] = [
            'e_nama'        => $this->_validation('e_nama', 'Nama', 'required'),
            'e_foto'        => $this->_validation('e_foto', 'foto', 'uploaded[e_foto]|max_size[e_foto, 1024]|mime_in[e_foto,image/jpeg,image/png,image/jpg]'),
        ];
        $json['select'] = [
            'e_user_id'     => $this->_validation('e_user_id', 'User', 'required'),
            'e_id_shift'    => $this->_validation('e_id_shift', 'Shift', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $user          = getData('db_master.ms_user', ['user_id' => _getVar($this->request->getVar('e_user_id'))])->get()->getRow();
            $shift         = getData('ms_shift', ['id_shift' => _getVar($this->request->getVar('e_id_shift'))])->get()->getRow();
            $petugas_dapur = getData('tb_petugas_dapur', ['id_petugas_dapur' => $id_petugas_dapur])->get()->getRow();
            $nama          = _getVar($this->request->getVar('e_nama'));
            $foto          = $this->request->getFile('e_foto');
            if (!$user) {
                $json['select']['e_user_id'] = 'Data user tidak ditemukan';
            } else if (!$shift) {
                $json['select']['e_id_shift'] = 'Data shift tidak ditemukan';
            } else {
                if ($foto->getError() == 0 && $foto->isValid() && !$foto->hasMoved()) {
                    $photo        = $foto->getRandomName();
                    if ($foto->move(FCPATH . './public/assets/images/dapur/petugas_dapur', $photo)) {
                        if (file_exists(FCPATH . './public/assets/images/dapur/petugas_dapur' . $photo)) {
                            unlink(FCPATH . './public/assets/images/dapur/petugas_dapur' . $photo);
                        }
                        $data = [
                            'user_id'  => $user->user_id,
                            'nama'     => $nama,
                            'id_shift' => $shift->id_shift,
                            'shift'    => $shift->shift,
                            'foto'     => $photo,
                        ];
                        $update = updateData('tb_petugas_dapur', $data, ['id_petugas_dapur' => $id_petugas_dapur]);
                        if ($update > 0) {
                            $data = [
                                'nama'  => $nama,
                            ];
                            updateData('db_master.ms_user', $data, ['user_id' => $user->user_id]);
                            $json['success'] = 'Data berhasil diubah';
                        } else {
                            $json['error'] = 'Data gagal diubah';
                        }
                    } else {
                        $json['input']['foto'] = 'foto gagal di upload';
                    }
                } else {
                    $foto = $petugas_dapur->foto;
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    // Penilian dan saran
    public function penilaian()
    {
        $today = _getVar($this->request->getVar('today'));
        $data['today'] = $today == "" ? date('Y-m-d') : $today;
        $data['daftar_menu'] = getData('tb_daftar_menu', ['tgl_menu' => $data['today']])->get()->getResult();
        return _tempHTML('dapur/penilaian', $data);
    }
}
