<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Fotocopy extends BaseController
{
    // inventaris barang fotokopi
    public function index()
    {
        $data['inventaris'] = getData('tb_inventaris_fotokopi')->get()->getResult();
        return _tempHTML('fotocopy/inventaris', $data);
    }
    public function inventaris_save()
    {
        $json['input'] = [
            'nama_barang'           => $this->_validation('nama_barang', 'Nama Barang', 'required'),
            'merk'                  => $this->_validation('merk', 'Merk Barang', 'required'),
            'no_serial'             => $this->_validation('no_serial', 'No Serial', 'required'),
            'tgl_pengadaan_barang'  => $this->_validation('tgl_pengadaan_barang', 'Tanggal Pengadaan Barang', 'required|valid_date'),
            'lokasi_penyimpanan'    => $this->_validation('lokasi_penyimpanan', 'Lokasi Penyimpanan', 'required'),
            'foto'                  => $this->_validation('foto', 'foto', 'uploaded[foto]|max_size[foto, 1024]|mime_in[foto,image/jpeg,image/png,image/jpg]'),
        ];
        $json['select'] = [
            'kondisi'               => $this->_validation('kondisi', 'Kondisi', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $kode_barang          = generate_kode_barang();
            $nama_barang          = _getVar($this->request->getVar('nama_barang'));
            $merk                 = _getVar($this->request->getVar('merk'));
            $no_serial            = _getVar($this->request->getVar('no_serial'));
            $tgl_pengadaan_barang = _getVar($this->request->getVar('tgl_pengadaan_barang'));
            $lokasi_penyimpanan   = _getVar($this->request->getVar('lokasi_penyimpanan'));
            $kondisi              = _getVar($this->request->getVar('kondisi'));
            $foto                 = $this->request->getFile('foto');
            if ($foto->getError() == 0 && $foto->isValid() && !$foto->hasMoved()) {
                $photo             = $foto->getRandomName();
                ($foto->move(FCPATH . './public/assets/images/fotocopy/barang', $photo));
                $data = [
                    'kode_barang'           => $kode_barang,
                    'nama_barang'           => $nama_barang,
                    'merk'                  => $merk,
                    'no_serial'             => $no_serial,
                    'tgl_pengadaan_barang'  => $tgl_pengadaan_barang,
                    'kondisi'               => $kondisi,
                    'lokasi_penyimpanan'    => $lokasi_penyimpanan,
                    'foto'                  => $photo,
                    'status'                => 'inventaris',
                    'created_by'            => _session('nama'),
                    'created_at'            => time(),
                ];
                $add = addData('tb_inventaris_fotokopi', $data);
                if ($add) {
                    $json['success'] = $add;
                } else {
                    $json['error'] = 'data fotokopi gagal dipesan';
                }
            } else {
                $json['input']['select'] = 'foto gagal upload';
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function transaksi_fotokopi()
    {
        $data['transaksi'] = getData('tb_transaksi_fotokopi')->get()->getResult();
        return _tempHTML('fotocopy/transaksi', $data);
    }
    public function get_inventaris($id_inventaris_fotokopi)
    {
        $inventaris = getData('tb_inventaris_fotokopi', ['id_inventaris_fotokopi' => $id_inventaris_fotokopi])->get()->getRow();
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
    public function pengajuan_save()
    {
        $id_inventaris_fotokopi = _getVar($this->request->getVar('id_inventaris_fotokopi'));
        $json['input'] = [
            'tanggal'              => $this->_validation('tanggal', 'Tanggal', 'required|valid_date'),
            'jml_barang'           => $this->_validation('jml_barang', 'Jumlah Barang', 'required'),
            'harga'                => $this->_validation('harga', 'Harga', 'required|decimal'),
            'struk'                => $this->_validation('struk', 'Struk', 'uploaded[struk]|max_size[struk, 1024]|mime_in[struk,image/jpeg,image/png,image/jpg]'),
            'foto'                 => $this->_validation('foto', 'foto', 'uploaded[foto]|max_size[foto, 1024]|mime_in[foto,image/jpeg,image/png,image/jpg]'),
        ];
        if (_validationHasErrors($json['input'])) {
            $inventaris_fotokopi = getData('tb_inventaris_fotokopi', ['id_inventaris_fotokopi' => $id_inventaris_fotokopi])->get()->getRow();
            $jenis_pengajuan      = _getVar($this->request->getVar('jenis_pengajuan'));
            $tgl                  = _getVar($this->request->getVar('tanggal'));
            $jml_barang           = _getVar($this->request->getVar('jml_barang'));
            $harga                = _getVar($this->request->getVar('harga'));
            $struk                = $this->request->getFile('struk');
            $foto                 = $this->request->getFile('foto');
            if (!$inventaris_fotokopi) {
                echo 'data inventaris tidak ditemukan';
            } else {
                if ($struk->getError() == 0 && $struk->isValid() && !$struk->hasMoved()) {
                    $nota = $struk->getRandomName();
                    $struk->move(FCPATH . './public/assets/images/fotocopy/struk_pembelian_barang', $nota);
                }
                if ($foto->getError() == 0 && $foto->isValid() && !$foto->hasMoved()) {
                    $photo             = $foto->getRandomName();
                    ($foto->move(FCPATH . './public/assets/images/fotocopy/foto_pembelian_barang', $photo));
                }
                $data = [
                    'kode_barang'           => $inventaris_fotokopi->kode_barang,
                    'nama_barang'           => $inventaris_fotokopi->nama_barang,
                    'merk'                  => $inventaris_fotokopi->merk,
                    'no_serial'             => $inventaris_fotokopi->no_serial,
                    'jenis_pengajuan'       => $jenis_pengajuan,
                    'tanggal'               => $tgl,
                    'jml_barang'            => $jml_barang,
                    'harga'                 => $harga,
                    'struk'                 => $nota,
                    'foto'                  => $photo,
                    'status'                => $jenis_pengajuan,
                    'created_by'            => _session('nama'),
                    'created_at'            => time(),
                ];
                $add = addData('tb_pembelian_barang_fotokopi', $data);
                if ($add > 0) {
                    $data = [
                        'status'  => $jenis_pengajuan,
                    ];
                    updateData('tb_inventaris_fotokopi', ['id_inventaris_fotokopi' => $id_inventaris_fotokopi]);
                    $json['success'] = $add;
                } else {
                    $json['error'] = 'pengajuan  barang fotocopy gagal';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    // public function perawatan_save()
    // {
    //     $id_inventaris_fotokopi = _getVar($this->request->getVar('id_inventaris_fotokopi'));
    //     $json['input'] = [
    //         'tgl_perawatan_barang' => $this->_validation('tgl_perawatan_barang', 'Tanggal Perawatan Barang', 'required|valid_date'),
    //         'jml_perawatan_barang' => $this->_validation('jml_perawatan_barang', 'Jumlah Perawatan Barang', 'required'),
    //         'harga'                => $this->_validation('harga', 'Harga', 'required|decimal'),
    //         'struk'                => $this->_validation('struk', 'Struk', 'uploaded[struk]|max_size[struk, 1024]|mime_in[struk,image/jpeg,image/png,image/jpg]'),
    //         'foto'                 => $this->_validation('foto', 'foto', 'uploaded[foto]|max_size[foto, 1024]|mime_in[foto,image/jpeg,image/png,image/jpg]'),
    //     ];
    //     if (_validationHasErrors($json['input'])) {
    //         $inventaris_fotokopi = getData('tb_inventaris_fotokopi', ['id_inventaris_fotokopi' => $id_inventaris_fotokopi])->get()->getRow();
    //         $tgl_perawatan_barang = _getVar($this->request->getVar('tgl_perawatan_barang'));
    //         $jml_perawatan_barang = _getVar($this->request->getVar('jml_perawatan_barang'));
    //         $harga                = _getVar($this->request->getVar('harga'));
    //         $struk                = $this->request->getFile('struk');
    //         $foto                 = $this->request->getFile('foto');
    //         if (!$inventaris_fotokopi) {
    //             echo 'data inventaris tidak ditemukan';
    //         } else {
    //             if ($struk->getError() == 0 && $struk->isValid() && !$struk->hasMoved()) {
    //                 $nota = $struk->getRandomName();
    //                 $struk->move(FCPATH . './public/assets/images/fotocopy/struk_perawatan_barang', $nota);
    //             }
    //             if ($foto->getError() == 0 && $foto->isValid() && !$foto->hasMoved()) {
    //                 $photo             = $foto->getRandomName();
    //                 ($foto->move(FCPATH . './public/assets/images/fotocopy/foto_perawatan_barang', $photo));
    //             }
    //             $data = [
    //                 'kode_barang'           => $inventaris_fotokopi->kode_barang,
    //                 'nama_barang'           => $inventaris_fotokopi->nama_barang,
    //                 'merk'                  => $inventaris_fotokopi->merk,
    //                 'no_serial'             => $inventaris_fotokopi->no_serial,
    //                 'tgl_perawatan_barang'  => $tgl_perawatan_barang,
    //                 'jml_perawatan_barang'  => $jml_perawatan_barang,
    //                 'harga'                 => $harga,
    //                 'struk'                 => $nota,
    //                 'foto'                  => $photo,
    //                 'status'                => 'pengajuan perawatan',
    //                 'created_by'            => _session('nama'),
    //                 'created_at'            => time(),
    //             ];
    //             $add = addData('tb_pembelian_barang_fotokopi', $data);
    //             if ($add > 0) {
    //                 $data = [
    //                     'status'  => 'proses pengajuan perawatan',
    //                 ];
    //                 updateData('tb_inventaris_fotokopi', ['id_inventaris_fotokopi' => $id_inventaris_fotokopi]);
    //                 $json['success'] = $add;
    //             } else {
    //                 $json['error'] = 'pengajuan pembelian barang fotocopy gagal';
    //             }
    //         }
    //     }
    //     $json['rscript']    = csrf_hash();
    //     echo json_encode($json);
    // }
    // transaksi
    // pembelian perawatan
    public function pembelian_perawatan()
    {
        $data['pembelian_perawatan'] = getData('tb_pembelian_barang_fotokopi')->get()->getResult();
        return _tempHTML('fotocopy/pembelian_perawatan', $data);
    }
    public function approve()
    {
        $id_pembelian_barang = _getVar($this->request->getVar('id_pembelian_barang'));
        $pembelian = getData('tb_pembelian_barang_fotokopi', ['id_pembelian_barang' => $id_pembelian_barang])->get()->getRow();
        if (!$pembelian) {
            $json['msg'] = 'data Pembelian tidak ditemukan';
        } else {
            $data = [
                'status'       => 'approved pembelian',
            ];
            $update = updateData('tb_pembelian_barang_fotokopi', $data, ['id_pembelian_barang' => $id_pembelian_barang]);
            if ($update) {
                $json['success']    = $update;
            } else {
                $json['msg']        = 'data pembelian dan perawatan gagal diupdate';
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function tolak()
    {
        $id_pembelian_barang = _getVar($this->request->getVar('id_pembelian_barang'));
        $pembelian = getData('tb_pembelian_barang_fotokopi', ['id_pembelian_barang' => $id_pembelian_barang])->get()->getRow();
        if (!$pembelian) {
            $json['msg'] = 'data Pembelian tidak ditemukan';
        } else {
            $data = [
                'status'       => 'ditolak',
            ];
            $update = updateData('tb_pembelian_barang_fotokopi', $data, ['id_pembelian_barang' => $id_pembelian_barang]);
            if ($update) {
                $json['success']    = $update;
            } else {
                $json['msg']        = 'data pembelian dan perawatan gagal diupdate';
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function proses()
    {
        $id_pembelian_barang = _getVar($this->request->getVar('id_pembelian_barang'));
        $pembelian = getData('tb_pembelian_barang_fotokopi', ['id_pembelian_barang' => $id_pembelian_barang])->get()->getRow();
        if (!$pembelian) {
            $json['msg'] = 'data Pembelian tidak ditemukan';
        } else {
            $data = [
                'status'       => 'pembelian',
            ];
            $update = updateData('tb_pembelian_barang_fotokopi', $data, ['id_pembelian_barang' => $id_pembelian_barang]);
            if ($update) {
                $json['success']    = $update;
            } else {
                $json['msg']        = 'data pembelian dan perawatan gagal diupdate';
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function selesai()
    {
        $id_pembelian_barang = _getVar($this->request->getVar('id_pembelian_barang'));
        $pembelian = getData('tb_pembelian_barang_fotokopi', ['id_pembelian_barang' => $id_pembelian_barang])->get()->getRow();
        if (!$pembelian) {
            $json['msg'] = 'data Pembelian tidak ditemukan';
        } else {
            $data = [
                'status'       => 'selesai',
            ];
            $update = updateData('tb_pembelian_barang_fotokopi', $data, ['id_pembelian_barang' => $id_pembelian_barang]);
            if ($update) {
                $json['success']    = $update;
            } else {
                $json['msg']        = 'data pembelian dan perawatan gagal diupdate';
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
}
