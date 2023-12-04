<?php

namespace App\Controllers;

use App\Models\ModelKeamanan;

use App\Controllers\BaseController;


use CodeIgniter\API\ResponseTrait;

class Keamanan extends BaseController
{
    use ResponseTrait;
    protected $model;

    public function __construct()
    {
        $this->model = new ModelKeamanan();
    }
    // pelaporan
    public function laporan()
    {
        $data['area']     = selectArea();
        $data['keamanan'] = $this->model->get()->getResult();
        return _tempHTML('keamanan/laporan', $data);
    }
    public function laporan_save()
    {
        $json['input'] = [
            'kejadian'       => $this->_validation('kejadian', 'Kejadian', 'required'),
            'kronologi'      => $this->_validation('kronologi', 'Kronologi', 'required'),
            'tgl_kejadian'   => $this->_validation('tgl_kejadian', 'Tanggal Kejadian', 'required|valid_date'),
            'waktu_kejadian' => $this->_validation('waktu_kejadian', 'Waktu Kejadian', 'required'),
            'foto'           => $this->_validation('foto', 'foto', 'uploaded[foto]|max_size[foto, 1024]|mime_in[foto,image/jpeg,image/png,image/jpg]'),
        ];
        $json['select'] = [
            'id_area'      => $this->_validation('id_area', 'id area', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $kode_kejadian  = generateKodeKejadian();
            $kejadian       = _getVar($this->request->getVar('kejadian'));
            $kronologi      = _getVar($this->request->getVar('kronologi'));
            $tgl_kejadian   = _getVar($this->request->getVar('tgl_kejadian'));
            $waktu_kejadian = _getVar($this->request->getVar('waktu_kejadian'));
            $ms_area        = getData('ms_area', ['id_area' => _getVar($this->request->getVar('id_area'))])->get()->getRow();
            $foto           = $this->request->getFile('foto');
            if (!$ms_area) {
                $json['select']['id_area'] = 'area tidak ditemukan';
            } else {
                if ($foto->getError() == 0 && $foto->isValid() && !$foto->hasMoved()) {
                    $photo        = $foto->getRandomName();
                    $foto->move(FCPATH . './public/assets/images/keamanan/foto_kejadian', $photo);
                    $data = [
                        'kode_kejadian'  => $kode_kejadian,
                        'kejadian'       => $kejadian,
                        'kronologi'      => $kronologi,
                        'tgl_kejadian'   => $tgl_kejadian,
                        'waktu_kejadian' => $waktu_kejadian,
                        'id_area'        => $ms_area->id_area,
                        'area'           => $ms_area->area,
                        'foto'           => $photo,
                        'created_by'     => _session('nama'),
                        'created_at'     => time(),
                    ];
                    $add = addData('tb_keamanan', $data);
                    if ($add) {
                        if ($add) {
                            $json['success'] = $add;
                        } else {
                            $json['error']  = "data gagal ditambahkan";
                        }
                    }
                } else {
                    $json['input']['foto']    = 'Foto gagal upload';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function laporan_edit($id_keamanan)
    {
        $laporan = getData('tb_keamanan', ['id_keamanan' => $id_keamanan])->get()->getRow();
        if ($laporan) {
            $data = [
                'status'    => true,
                'data'      => $laporan
            ];
        } else {
            $data = [
                'status'    => false,
                'data'      => ''
            ];
        }
        echo json_encode($data);
    }
    public function laporan_update()
    {
        $id_keamanan           = _getVar($this->request->getVar('e_id_kejadian'));
        $json['input'] = [
            'e_kejadian'       => $this->_validation('e_kejadian', 'Kejadian', 'required'),
            'e_kronologi'      => $this->_validation('e_kronologi', 'Kronologi', 'required'),
            'e_tgl_kejadian'   => $this->_validation('e_tgl_kejadian', 'Tanggal Kejadian', 'required|valid_date'),
            'e_waktu_kejadian' => $this->_validation('e_waktu_kejadian', 'Waktu Kejadian', 'required'),
            'e_foto'           => $this->_validation('e_foto', 'foto', 'uploaded[e_foto]|max_size[e_foto, 1024]|mime_in[e_foto,image/jpeg,image/png,image/jpg]'),
        ];
        $json['select'] = [
            'e_id_area'      => $this->_validation('e_id_area', 'id area', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $kode_kejadian  = generateKodeKejadian();
            $kejadian       = _getVar($this->request->getVar('e_kejadian'));
            $kronologi      = _getVar($this->request->getVar('e_kronologi'));
            $tgl_kejadian   = _getVar($this->request->getVar('e_tgl_kejadian'));
            $waktu_kejadian = _getVar($this->request->getVar('e_waktu_kejadian'));
            $ms_area        = getData('ms_area', ['id_area' => _getVar($this->request->getVar('e_id_area'))])->get()->getRow();
            $foto           = $this->request->getFile('e_foto');
            if (!$ms_area) {
                $json['select']['e_id_area'] = 'area tidak ditemukan';
            } else {
                if ($foto->getError() == 0 && $foto->isValid() && !$foto->hasMoved()) {
                    $photo        = $foto->getRandomName();
                    if ($foto->move(FCPATH . './public/assets/images/keamanan/foto_kejadian/', $photo)) {
                        if (file_exists(FCPATH . '/public/assets/images/keamanan/foto_kejadian/' . $photo)) {
                            // Delete the old file, if it exists
                            if (file_exists(FCPATH . '/public/assets/images/keamanan/foto_kejadian/' . $photo)) {
                                unlink(FCPATH . '/public/assets/images/keamanan/foto_kejadian/' . $photo);
                            }
                        } else {
                            $json['error'] = "Failed to delete old file";
                        }
                    }
                    $data = [
                        'kode_kejadian'  => $kode_kejadian,
                        'kejadian'       => $kejadian,
                        'kronologi'      => $kronologi,
                        'tgl_kejadian'   => $tgl_kejadian,
                        'waktu_kejadian' => $waktu_kejadian,
                        'id_area'        => $ms_area->id_area,
                        'area'           => $ms_area->area,
                        'foto'           => $photo,
                        'created_by'     => _session('nama'),
                        'created_at'     => time(),
                    ];
                    $update = updateData('tb_keamanan', $data, ['id_keamanan' => $id_keamanan]);
                    if ($update) {
                        if ($update) {
                            $json['success'] = $update;
                        } else {
                            $json['error']  = "data gagal diupdate";
                        }
                    }
                } else {
                    $json['input']['foto']    = 'Foto gagal upload';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    // pengawasan
    public function pengawasan()
    {
        $data['ms_user']    = selectSecurityUser();
        $data['shift']      = selectShift();
        $data['area']       = selectArea();
        $data['pengawasan'] = getData('tb_pengawasan')->get()->getResult();
        return _tempHTML('keamanan/pengawasan', $data);
    }
    public function pengawasan_save()
    {
        $json['input'] = [
            'foto'      =>  $this->_validation('foto', 'foto', 'uploaded[foto]|max_size[foto, 1024]|mime_in[foto,image/jpeg,image/png,image/jpg]'),
        ];
        $json['select'] = [
            'user_id'   => $this->_validation('user_id', 'user', 'required'),
            'id_shift'  => $this->_validation('id_shift', 'Shift', 'required'),
            'id_area'   => $this->_validation('id_area', 'area', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $user       = getData('db_master.ms_user', ['user_id' => _getVar($this->request->getVar('user_id'))])->get()->getRow();
            $shift      = getData('ms_shift', ['id_shift' => _getVar($this->request->getVar('id_shift'))])->get()->getRow();
            $ms_area    = getData('ms_area', ['id_area' => _getVar($this->request->getVar('id_area'))])->get()->getRow();
            $foto       = $this->request->getFile('foto');
            if (!$user) {
                $json['select']['user_id'] = 'data user tidak ditemukan';
            } else if (!$shift) {
                $json['select']['id_shift'] = 'shift tidak ditemukan';
            } else if (!$ms_area) {
                $json['select']['id_area'] = 'area tidak ditemukan';
            } else {
                if ($foto->getError() == 0 && $foto->isValid() && !$foto->hasMoved()) {
                    $photo        = $foto->getRandomName();
                    ($foto->move(FCPATH . './public/assets/images/keamanan/pengawasan_personal/', $photo));
                    $data = [
                        'user_id'       => $user->user_id,
                        'nama'          => $user->nama,
                        'id_shift'      => $shift->id_shift,
                        'shift'         => $shift->shift,
                        'id_area'       => $ms_area->id_area,
                        'area'          => $ms_area->area,
                        'foto'           => $photo,
                        'created_by'     => _session('nama'),
                        'created_at'     => time(),
                    ];
                    $add = addData('tb_pengawasan', $data);
                    if ($add) {
                        $json['success'] = $add;
                    } else {
                        $json['error'] = 'data gagal ditambahkan';
                    }
                } else {
                    $json['error'] = 'foto gagal upload';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function pengawasan_edit($id_pengawasan)
    {
        $pengawasan = getData('tb_pengawasan', ['id_pengawasan' => $id_pengawasan])->get()->getRow();
        if ($pengawasan) {
            $data = [
                'status'    => true,
                'data'      => $pengawasan
            ];
        } else {
            $data = [
                'status'    => false,
                'data'      => ''
            ];
        }
        echo json_encode($data);
    }
    public function pengawasan_update()
    {
        $id_pengawasan = _getVar($this->request->getVar('e_id_pengawasan'));
        $json['input'] = [
            'e_foto'      =>  $this->_validation('e_foto', 'foto', 'uploaded[e_foto]|max_size[e_foto, 1024]|mime_in[e_foto,image/jpeg,image/png,image/jpg]'),
        ];
        $json['select'] = [
            'e_user_id'   => $this->_validation('e_user_id', 'user', 'required'),
            'e_id_shift'  => $this->_validation('e_id_shift', 'Shift', 'required'),
            'e_id_area'   => $this->_validation('e_id_area', 'area', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $user       = getData('db_master.ms_user', ['user_id' => _getVar($this->request->getVar('e_user_id'))])->get()->getRow();
            $shift      = getData('ms_shift', ['id_shift' => _getVar($this->request->getVar('e_id_shift'))])->get()->getRow();
            $ms_area    = getData('ms_area', ['id_area' => _getVar($this->request->getVar('e_id_area'))])->get()->getRow();
            $foto       = $this->request->getFile('e_foto');
            if (!$user) {
                $json['select']['e_user_id'] = 'data user tidak ditemukan';
            } else if (!$shift) {
                $json['select']['e_id_shift'] = 'shift tidak ditemukan';
            } else if (!$ms_area) {
                $json['select']['e_id_area'] = 'area tidak ditemukan';
            } else {
                if ($foto->getError() == 0 && $foto->isValid() && !$foto->hasMoved()) {
                    $photo        = $foto->getRandomName();
                    ($foto->move(FCPATH . './public/assets/images/keamanan/pengawasan_personal/', $photo));
                    $data = [
                        'user_id'       => $user->user_id,
                        'nama'          => $user->nama,
                        'id_shift'      => $shift->id_shift,
                        'shift'         => $shift->shift,
                        'id_area'       => $ms_area->id_area,
                        'area'          => $ms_area->area,
                        'foto'           => $photo,
                        'created_by'     => _session('nama'),
                        'created_at'     => time(),
                    ];
                    $update = updateData('tb_pengawasan', $data, ['id_pengawasan' => $id_pengawasan]);
                    if ($update) {
                        $json['success'] = $update;
                    } else {
                        $json['error'] = 'data gagal diupdate';
                    }
                } else {
                    $json['error'] = 'foto gagal upload';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    // informasi
    public function index()
    {
        $data['informasi'] = getData('tb_informasi')->get()->getResult();
        return $this->respond($data);
    }
    public function informasi()
    {
        $data['informasi'] = getData('tb_informasi')->get()->getResult();
        return _tempHTML('keamanan/informasi', $data);
    }
    public function create()
    {
        $json['input'] = [
            'nama_kegiatan'     => $this->_validation('nama_kegiatan', 'Nama Kegiatan', 'required'),
            'tgl_kegiatan'      => $this->_validation('tgl_kegiatan', 'Tanggal Kegiatan', 'required'),
            'waktu_kegiatan'    => $this->_validation('waktu_kegiatan', 'Waktu Kegiatan', 'required'),
            'tempat_kegiatan'    => $this->_validation('tempat_kegiatan', 'Tempat Kegiatan', 'required'),
        ];
        $json['select'] = [
            'type_kegiatan'     => $this->_validation('type_kegiatan', 'Type Kegiatan', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $nama_kegiatan  = _getVar($this->request->getVar('nama_kegiatan'));
            $tgl_kegiatan   = _getVar($this->request->getVar('tgl_kegiatan'));
            $waktu_kegiatan = _getVar($this->request->getVar('waktu_kegiatan'));
            $type_kegiatan  = _getVar($this->request->getVar('type_kegiatan'));
            $tempat_kegiatan  = _getVar($this->request->getVar('tempat_kegiatan'));
            $data = [
                'nama_kegiatan'  => $nama_kegiatan,
                'type_kegiatan'  => $type_kegiatan,
                'tgl_kegiatan'   => $tgl_kegiatan,
                'waktu_kegiatan' => $waktu_kegiatan,
                'tempat_kegiatan' => $tempat_kegiatan,
                'created_by'      => _session('nama'),
                'created_at'      => time()
            ];
            $add = addData('tb_informasi', $data);
            if ($add) {
                $json['success'] = $add;
            } else {
                $json['error'] = 'data gagal ditambahkan';
            }
        }
        $json['rscript']    = csrf_hash();
        return $this->respond($json);
    }
    public function informasi_edit($id_informasi)
    {
        $informasi = getData('tb_informasi', ['id_informasi' => $id_informasi])->get()->getRow();
        if ($informasi) {
            $data = [
                'status'    => true,
                'data'      => $informasi
            ];
        } else {
            $data = [
                'status'    => false,
                'data'      => ''
            ];
        }
        echo json_encode($data);
    }
    public function update()
    {
        $id_informasi = _getVar($this->request->getVar('e_id_informasi'));
        $json['input'] = [
            'e_nama_kegiatan'     => $this->_validation('e_nama_kegiatan', 'Nama Kegiatan', 'required'),
            'e_tgl_kegiatan'      => $this->_validation('e_tgl_kegiatan', 'Tanggal Kegiatan', 'required'),
            'e_waktu_kegiatan'    => $this->_validation('e_waktu_kegiatan', 'Waktu Kegiatan', 'required'),
            'e_tempat_kegiatan'    => $this->_validation('e_tempat_kegiatan', 'Tempat Kegiatan', 'required'),
        ];
        $json['select'] = [
            'e_type_kegiatan'     => $this->_validation('e_type_kegiatan', 'Type Kegiatan', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $nama_kegiatan  = _getVar($this->request->getVar('e_nama_kegiatan'));
            $tgl_kegiatan   = _getVar($this->request->getVar('e_tgl_kegiatan'));
            $waktu_kegiatan = _getVar($this->request->getVar('e_waktu_kegiatan'));
            $type_kegiatan  = _getVar($this->request->getVar('e_type_kegiatan'));
            $tempat_kegiatan  = _getVar($this->request->getVar('e_tempat_kegiatan'));
            $data = [
                'e_nama_kegiatan'  => $nama_kegiatan,
                'e_type_kegiatan'  => $type_kegiatan,
                'e_tgl_kegiatan'   => $tgl_kegiatan,
                'e_waktu_kegiatan' => $waktu_kegiatan,
                'e_tempat_kegiatan' => $tempat_kegiatan,
            ];
            $update = updateData('tb_informasi', $data, ['id_informasi' => $id_informasi]);
            if ($update) {
                $json['success'] = $update;
            } else {
                $json['error'] = 'data gagal ditambahkan';
            }
        }
        $json['rscript']    = csrf_hash();
        return $this->respond($json);
    }
    public function delete($id_informasi)
    {
        $informasi = getData('tb_informasi', ['id_informasi' => $id_informasi])->get()->getRow();
        if (!$informasi) {
            $json['msg'] = 'data Booking tidak ditemukan';
        } else {
            $delete = deleteData('tb_informasi', ['id_informasi' => $id_informasi]);
            if ($delete) {
                $json['success']    = 1;
            } else {
                $json['msg']        = $delete;
            }
        }
        return $this->respond($json);
    }
    public function inventaris()
    {
        $data['barang']     = selectBarangSecurity();
        $data['kondisi']    = selectKondisiBarang();
        $data['inventaris'] = getData('tb_inventaris')->get()->getResult();
        return _tempHTML('keamanan/inventaris', $data);
    }
    public function inventaris_save()
    {
        $json['input'] = [
            'tgl_pengadaan_barang'      => $this->_validation('tgl_pengadaan_barang', 'Tanggal Pengadaan Barang', 'required|valid_date'),
            'tempat_barang_disimpan'    => $this->_validation('tempat_barang_disimpan', 'Tempat Barang Disimpan', 'required'),
            'keterangan'                => $this->_validation('keterangan', 'Keterangan', 'required'),
        ];
        $json['select'] = [
            'id_barang'     => $this->_validation('id_barang', 'Nama Barang', 'required'),
            'id_kondisi'    => $this->_validation('id_kondisi', 'Kondisi', 'required'),
            // 'posisi_barang' => $this->_validation('posisi_barang', 'Posisi Barang', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $tgl = _getVar($this->request->getVar('tgl_pengadaan_barang'));
            $tempat = _getVar($this->request->getVar('tempat_barang_disimpan'));
            $ket    = _getVar($this->request->getVar('keterangan'));
            $barang = getData('ms_barang_security', ['id_barang' => _getVar($this->request->getVar('id_barang'))])->get()->getRow();
            $kondisi = getData('ms_barang_kondisi', ['id_kondisi' => _getVar($this->request->getVar('id_kondisi'))])->get()->getRow();
            $posisi = _getVar($this->request->getVar('posisi_barang'));
            if (!$barang) {
                $json['select']['id_barang'] = 'barang tidak ditemukan';
            } else if (!$kondisi) {
                $json['select']['id_kondisi'] = 'kondisi tidak ditemukan';
            } else {
                $data = [
                    'id_barang'                 => $barang->id_barang,
                    'nama_barang'               => $barang->nama_barang,
                    'tgl_pengadaan_barang'      => $tgl,
                    'id_kondisi'                => $kondisi->id_kondisi,
                    'kondisi'                   => $kondisi->kondisi,
                    'tempat_barang_disimpan'    => $tempat,
                    'posisi_barang'             => $posisi,
                    'keterangan'                => $ket,
                    'created_by'                => _session('nama'),
                    'created_at'                => time(),
                ];
                $add = addData('tb_inventaris', $data);
                if ($add) {
                    $json['success'] = $add;
                } else {
                    $json['error'] = 'data gagal ditambahkan';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function inventaris_edit($id_inventaris)
    {
        $inventaris = getData('tb_inventaris', ['id_inventaris' => $id_inventaris])->get()->getRow();
        if ($inventaris) {
            $data = [
                'status'    => true,
                'data'      => $inventaris
            ];
        } else {
            $data = [
                'status'    => false,
                'data'      => ''
            ];
        }
        echo json_encode($data);
    }
    public function inventaris_update()
    {
        $id_inventaris = _getVar($this->request->getVar('e_id_inventaris'));
        $json['input'] = [
            'e_tgl_pengadaan_barang'      => $this->_validation('e_tgl_pengadaan_barang', 'Tanggal Pengadaan Barang', 'required|valid_date'),
            'e_tempat_barang_disimpan'    => $this->_validation('e_tempat_barang_disimpan', 'Tempat Barang Disimpan', 'required'),
            'e_keterangan'                => $this->_validation('e_keterangan', 'Keterangan', 'required'),
        ];
        $json['select'] = [
            'e_id_barang'     => $this->_validation('e_id_barang', 'Nama Barang', 'required'),
            'e_id_kondisi'    => $this->_validation('e_id_kondisi', 'Kondisi', 'required'),
            'e_posisi_barang' => $this->_validation('e_posisi_barang', 'Posisi Barang', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $tgl = _getVar($this->request->getVar('e_tgl_pengadaan_barang'));
            $tempat = _getVar($this->request->getVar('e_tempat_barang_disimpan'));
            $ket    = _getVar($this->request->getVar('e_keterangan'));
            $barang = getData('ms_barang_security', ['id_barang' => _getVar($this->request->getVar('e_id_barang'))])->get()->getRow();
            $kondisi = getData('ms_barang_kondisi', ['id_kondisi' => _getVar($this->request->getVar('e_id_kondisi'))])->get()->getRow();
            $posisi = _getVar($this->request->getVar('e_posisi_barang'));
            if (!$barang) {
                $json['select']['e_id_barang'] = 'barang tidak ditemukan';
            } else if (!$kondisi) {
                $json['select']['e_id_kondisi'] = 'kondisi tidak ditemukan';
            } else {
                $data = [
                    'id_barang'                 => $barang->id_barang,
                    'nama_barang'               => $barang->nama_barang,
                    'tgl_pengadaan_barang'      => $tgl,
                    'id_kondisi'                => $kondisi->id_kondisi,
                    'kondisi'                   => $kondisi->kondisi,
                    'tempat_barang_disimpan'    => $tempat,
                    'posisi_barang'             => $posisi,
                    'keterangan'                => $ket,
                    'created_by'                => _session('nama'),
                    'created_at'                => time(),
                ];
                $update = updateData('tb_inventaris', $data, ['id_inventaris' => $id_inventaris]);
                if ($update) {
                    $json['success'] = $update;
                } else {
                    $json['error'] = 'data gagal ditambahkan';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function inventaris_delete($id_inventaris)
    {
        $inventaris = getData('tb_inventaris', ['id_inventaris' => $id_inventaris])->get()->getRow();
        if (!$inventaris) {
            $json['msg'] = 'data Booking tidak ditemukan';
        } else {
            $delete = $this->model->delete($inventaris);
            if ($delete) {
                $json['success']    = 1;
            } else {
                $json['msg']        = $delete;
            }
        }
    }
}
