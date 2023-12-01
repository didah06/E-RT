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
            'foto'                 => $this->_validation('foto', 'foto', 'uploaded[foto]|max_size[foto, 1024]|mime_in[foto,image/jpeg,image/png,image/jpg]'),
        ];
        if (_validationHasErrors($json['input'])) {
            $inventaris_fotokopi  = getData('tb_inventaris_fotokopi', ['id_inventaris_fotokopi' => $id_inventaris_fotokopi])->get()->getRow();
            $jenis_pengajuan      = _getVar($this->request->getVar('jenis_pengajuan'));
            $tgl                  = _getVar($this->request->getVar('tanggal'));
            $jml_barang           = _getVar($this->request->getVar('jml_barang'));
            $harga                = _getVar($this->request->getVar('harga'));
            $foto                 = $this->request->getFile('foto');
            if (!$inventaris_fotokopi) {
                echo 'data inventaris tidak ditemukan';
            } else {
                if ($foto->getError() == 0 && $foto->isValid() && !$foto->hasMoved()) {
                    $photo             = $foto->getRandomName();
                    ($foto->move(FCPATH . './public/assets/images/fotocopy/foto', $photo));
                    $data = [
                        'kode_barang'           => $inventaris_fotokopi->kode_barang,
                        'nama_barang'           => $inventaris_fotokopi->nama_barang,
                        'merk'                  => $inventaris_fotokopi->merk,
                        'no_serial'             => $inventaris_fotokopi->no_serial,
                        'jenis_pengajuan'       => $jenis_pengajuan,
                        'tanggal'               => $tgl,
                        'jml_barang'            => $jml_barang,
                        'harga'                 => $harga,
                        'foto'                  => $photo,
                        'status'                => 'pengajuan',
                        'created_by'            => _session('nama'),
                        'created_at'            => time(),
                    ];
                    $add = addData('tb_pembelian_barang_fotokopi', $data);
                    if ($add > 0) {
                        $dataInven = [
                            'status' => 'pengajuan',
                        ];
                        updateData('tb_inventaris_fotokopi', $dataInven, ['id_inventaris_fotokopi' => $id_inventaris_fotokopi]);
                        $json['success'] = $add;
                    } else {
                        $json['error'] = 'pengajuan  barang fotocopy gagal';
                    }
                } else {
                    $json['input']['foto'] = 'foto gagal di upload';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    // transaksi
    public function transaksi_fotokopi()
    {
        $data['departemen'] = selectDepartemen();
        $start_date = _getVar($this->request->getVar('start_date'));
        $end_date   = _getVar($this->request->getVar('end_date'));
        $filter_kebutuhan_transaksi = _getVar($this->request->getVar('kebutuhan_transaksi'));
        $data['shift']      = selectShift();
        $data['area']       = selectArea();
        $data['start_date'] = $start_date == "" ? date('Y-m-d') : $start_date;
        $data['end_date'] = $end_date == "" ? date('Y-m-t') : $end_date;
        $data['transaksi'] = getData('tb_transaksi_fotokopi', ['tanggal BETWEEN "' . $data['start_date'] . '" AND "' . $data['end_date'] . '"' => null])->get()->getResult();
        return _tempHTML('fotocopy/transaksi', $data);
    }
    public function transaksi_save()
    {
        $json['input'] = [
            'tanggal'           => $this->_validation('tanggal', 'Tanggal', 'required|valid_date'),
            'jml_halaman'       => $this->_validation('jml_halaman', 'Jumlah Halaman', 'required'),
            'pemakaian_kertas'        => $this->_validation('pemakaian_kertas', 'Pemakaian Kertas', 'required'),
        ];
        $json['select'] = [
            'id_dept'           => $this->_validation('id_dept', 'Departemen', 'required'),
            'jenis_user'        => $this->_validation('jenis_user', 'Jenis User', 'required'),
            'kebutuhan_transaksi' => $this->_validation('kebutuhan_transaksi', 'Kebutuhan Transaksi', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $tanggal = _getVar($this->request->getVar('tanggal'));
            $jml_halaman = _getVar($this->request->getVar('jml_halaman'));
            $keterangan = _getVar($this->request->getVar('keterangan'));
            $pemakaian_kertas = _getVar($this->request->getVar('pemakaian_kertas'));
            $jenis_user = _getVar($this->request->getVar('jenis_user'));
            $kebutuhan_transaksi = _getVar($this->request->getVar('kebutuhan_transaksi'));
            $departemen = getData('ms_departemen', ['id_dept' => _getVar($this->request->getVar('id_dept'))])->get()->getRow();
            if (!$departemen) {
                $json['select']['id_dept'] = 'departemen tidak ditemukan';
            } else {
                $data = [
                    'departemen'          => $departemen->departemen,
                    'jenis_user'          => $jenis_user,
                    'kebutuhan_transaksi' => $kebutuhan_transaksi,
                    'tanggal'             => $tanggal,
                    'jml_halaman'         => $jml_halaman,
                    'keterangan'          => $keterangan,
                    'pemakaian_kertas'    => $pemakaian_kertas,
                    'created_by'          => _session('nama'),
                    'created_at'          => time(),
                ];
                $add = addData('tb_transaksi_fotokopi', $data);
                if ($add) {
                    $json['success'] = $add;
                } else {
                    $json['error'] = 'Data transaksi gagal di input';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function get_transaksi($id_transaksi_fotokopi)
    {
        $transaksi = getData('tb_transaksi_fotokopi', ['id_transaksi_fotokopi' => $id_transaksi_fotokopi])->get()->getRow();
        if ($transaksi) {
            $data = [
                'status'    => true,
                'data'      => $transaksi
            ];
        } else {
            $data = [
                'status'    => false,
                'data'      => ''
            ];
        }
        echo json_encode($data);
    }
    public function transaksi_update()
    {
        $id_transaksi_fotokopi = _getVar($this->request->getVar('e_id_transaksi_fotokopi'));
        $json['input']  = [
            'e_tanggal'     => $this->_validation('e_tanggal', 'Tanggal', 'required|valid_date'),
        ];
        $json['select'] = [
            'e_id_dept'             => $this->_validation('e_id_dept', 'Departemen', 'required'),
            'e_kebutuhan_transaksi'   => $this->_validation('e_kebutuhan_transaksi', 'Kebutuhan Transaksi', 'required'),
            'e_jenis_user'            => $this->_validation('e_jenis_user', 'jenis_user', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $departemen         = getData('ms_departemen', ['id_dept' => _getVar($this->request->getVar('e_id_dept'))])->get()->getRow();
            $tanggal            = _getVar($this->request->getVar('e_tanggal'));
            $jml_halaman        = _getVar($this->request->getVar('e_jml_halaman'));
            $keterangan         = _getVar($this->request->getVar('e_keterangan'));
            $pemakaian_kertas    = _getVar($this->request->getVar('e_pemakaian_kertas'));
            $jenis_user          = _getVar($this->request->getVar('e_jenis_user'));
            $kebutuhan_transaksi = _getVar($this->request->getVar('e_kebutuhan_transaksi'));
            $data = [
                'id_dept'             => $departemen->id_dept,
                'departemen'          => $departemen->departemen,
                'jenis_user'          => $jenis_user,
                'kebutuhan_transaksi' => $kebutuhan_transaksi,
                'tanggal'             => $tanggal,
                'jml_halaman'         => $jml_halaman,
                'keterangan'          => $keterangan,
                'pemakaian_kertas'    => $pemakaian_kertas,
                'created_by'          => _session('nama'),
                'created_at'          => time(),
            ];
            $update = updateData('tb_transaksi_fotokopi', $data, ['id_transaksi_fotokopi' => $id_transaksi_fotokopi]);
            if ($update) {
                $json['success'] = $update;
            } else {
                $json['error'] = 'Data transaksi gagal di update';
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function transaksi_delete($id_transaksi_fotokopi)
    {
        $transaksi = getData('tb_transaksi_fotokopi', ['id_transaksi_fotokopi' => $id_transaksi_fotokopi])->get()->getRow();
        if (!$transaksi) {
            $json['msg'] = 'data transaksi tidak ditemukan';
        } else {
            $delete = deleteData('tb_transaksi_fotokopi', ['id_transaksi_fotokopi' => $id_transaksi_fotokopi]);
            if ($delete) {
                $json['success']    = 1;
            } else {
                $json['msg']        = $delete;
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    // pembelian perawatan
    public function pembelian_perawatan()
    {
        $data['pembelian_perawatan'] = getData('tb_pembelian_barang_fotokopi')->get()->getResult();
        return _tempHTML('fotocopy/pembelian_perawatan', $data);
    }
    public function pembelian_perawatan_save()
    {
        $json['input'] = [
            'nama_barang'   => $this->_validation('nama_barang', 'Nama Barang', 'required'),
            'merk'          => $this->_validation('merk', 'Merk', 'required'),
            'no_serial'     => $this->_validation('no_serial', 'No Serial', 'required'),
            'tanggal'       => $this->_validation('tanggal', 'Tanggal Pengajuan', 'required|valid_date'),
            'jml_barang'    => $this->_validation('jml_barang', 'Jumlah Barang', 'required'),
        ];
        $json['select'] = [
            'jenis_pengajuan'   => $this->_validation('jenis_pengajuan', 'Jenis Pengajuan', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $kode_barang          = generate_kode_barang();
            $nama_barang          = _getVar($this->request->getVar('nama_barang'));
            $merk                 = _getVar($this->request->getVar('merk'));
            $no_serial            = _getVar($this->request->getVar('no_serial'));
            $tanggal              = _getVar($this->request->getVar('tanggal'));
            $jml_barang             = _getVar($this->request->getVar('jml_barang'));
            $jenis_pengajuan            = _getVar($this->request->getVar('jenis_pengajuan'));
            $data = [
                'kode_barang'   => $kode_barang,
                'nama_barang'   => $nama_barang,
                'merk'          => $merk,
                'no_serial'     => $no_serial,
                'tanggal'       => $tanggal,
                'jml_barang'    => $jml_barang,
                'jenis_pengajuan' => $jenis_pengajuan,
                'status'          => 'pengajuan'
            ];
            $add = addData('tb_pembelian_barang_fotokopi', $data);
            if ($add) {
                $json['success'] = $add;
            } else {
                $json['error']  = 'pengajuan pembelian barang gagal ditambahkan';
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function get_pembelian_perawatan($kode_barang)
    {
        $pembelian_perawatan = getData('tb_pembelian_barang_fotokopi', ['kode_barang' => $kode_barang])->get()->getRow();
        if ($pembelian_perawatan) {
            $data = [
                'status'    => true,
                'data'      => $pembelian_perawatan
            ];
        } else {
            $data = [
                'status'    => false,
                'data'      => ''
            ];
        }
        echo json_encode($data);
    }
    public function approve($id_pembelian_barang)
    {
        if (!empty($this->request->getVar('signature'))) {
            $user                   = getUser(['id' => _session('id')])->getRow();
            $data_signature         = _getVar($this->request->getVar('signature'));
            $exp                    = explode(';base64,', $data_signature);
            $image_type             = str_replace('data:image/', '', $exp[0]);
            $signature_base64       = $exp[1];
            if ($signature_base64 == _signatureKosong() && (_getVar($this->request->getVar('old_check')) != 1 || $user->ttd == 'default.png')) {
                $json['error']    = 'Signature masih kosong';
            }
        }
        $pembelian = getData('tb_pembelian_barang_fotokopi', ['id_pembelian_barang' => $id_pembelian_barang])->get()->getRow();
        $user               = getUser(['id' => _session('id')])->getRow();
        $old_check          = _getVar($this->request->getVar('old_check'));
        if (!$pembelian) {
            $json['error'] = 'data Pembelian tidak ditemukan';
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
                'status'          => 'approved',
                'approved_RT_by'  => _session('nama'),
                'approved_RT_at'  => time(),
                'approved_RT_ttd' => $ttd,
            ];
            $update = updateData('tb_pembelian_barang_fotokopi', $data, ['id_pembelian_barang' => $id_pembelian_barang]);
            if ($update > 0) {
                $data_inventaris = [
                    'status'     => 'approved',
                ];
                updateData('tb_inventaris_fotokopi', $data_inventaris, ['kode_barang' => $pembelian->kode_barang]);
                $json['success']    = $update;
            } else {
                $json['error']        = 'data pembelian dan perawatan gagal diupdate';
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function tolak($id_pembelian_barang)
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
            $pembelian  = getData('tb_pembelian_barang_fotokopi', ['id_pembelian_barang' => $id_pembelian_barang])->get()->getRow();
            $reason     = _getVar($this->request->getVar('ditolak_ket'));
            $old_check  = _getVar($this->request->getVar('old_check'));
            if (!$pembelian) {
                $json['error'] = 'data Pembelian tidak ditemukan';
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
                    'status'       => 'ditolak',
                    'tolak_RT_by'  => _session('nama'),
                    'tolak_RT_ttd' => $ttd,
                    'tolak_ket'    => $reason,
                ];
                $update = updateData('tb_pembelian_barang_fotokopi', $data, ['id_pembelian_barang' => $id_pembelian_barang]);
                if ($update > 0) {
                    $data_inventaris = [
                        'status'     => 'ditolak',
                    ];
                    updateData('tb_inventaris_fotokopi', $data_inventaris, ['kode_barang' => $pembelian->kode_barang]);
                    $json['success']    = $update;
                } else {
                    $json['error']        = 'data pembelian dan perawatan gagal diupdate';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function proses($kode_barang)
    {
        $pembelian = getData('tb_pembelian_barang_fotokopi', ['kode_barang' => $kode_barang])->get()->getRow();
        if (!$pembelian) {
            $json['msg'] = 'data Pembelian tidak ditemukan';
        } else {
            $data = [
                'status'       => $pembelian->jenis_pengajuan,
            ];
            $update = updateData('tb_pembelian_barang_fotokopi', $data, ['kode_barang' => $kode_barang]);
            if ($update > 0) {
                $data_inventaris = [
                    'status'     => $pembelian->jenis_pengajuan,
                ];
                updateData('tb_inventaris_fotokopi', $data_inventaris, ['kode_barang' => $pembelian->kode_barang]);
                $json['success']    = $update;
            } else {
                $json['error']        = 'data pembelian dan perawatan gagal diupdate';
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function selesai()
    {
        $kode_barang = _getVar($this->request->getVar('e_kode_barang'));
        $pembelian = getData('tb_pembelian_barang_fotokopi', ['kode_barang' => $kode_barang])->get()->getRow();
        $tgl_pembelian  = _getVar($this->request->getVar('tgl_pembelian'));
        $struk          = $this->request->getFile('struk');
        if (!$pembelian) {
            $json['error'] = 'data Pembelian tidak ditemukan';
        } else {
            if ($struk->getError() == 0 && $struk->isValid() && !$struk->hasMoved()) {
                $nota             = $struk->getRandomName();
                ($struk->move(FCPATH . './public/assets/images/seragam/pengambilan_seragam', $nota));
                $data = [
                    'tgl_pembelian' => $tgl_pembelian,
                    'struk'         => $nota,
                    'status'        => 'selesai',
                ];
                $update = updateData('tb_pembelian_barang_fotokopi', $data, ['kode_barang' => $kode_barang]);
                if ($update > 0) {
                    $data_inventaris = [
                        'status' => 'selesai',
                    ];
                    updateData('tb_inventaris_fotokopi', $data_inventaris, ['kode_barang' => $kode_barang]);
                    $json['success'] = $update;
                } else {
                    $json['error'] = 'Data pembelian dan perawatan gagal diupdate';
                }
            } else {
                echo ' struk gagal upload';
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function pembelian_perawatan_update()
    {
        $json['input'] = [
            'e_nama_barang'   => $this->_validation('e_nama_barang', 'Nama Barang', 'required'),
            'e_merk'          => $this->_validation('e_merk', 'Merk', 'required'),
            'e_no_serial'     => $this->_validation('e_no_serial', 'No Serial', 'required'),
            'e_tanggal'       => $this->_validation('e_tanggal', 'Tanggal Pengajuan', 'required|valid_date'),
            'e_jml_barang'    => $this->_validation('e_jml_barang', 'Jumlah Barang', 'required'),
        ];
        $json['select'] = [
            'e_jenis_pengajuan'   => $this->_validation('e_jenis_pengajuan', 'Jenis Pengajuan', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $pembelian_perawatan  = getData('tb_pembelian_barang_fotokopi', ['kode_barang' => _getVar($this->request->getVar('e_kode_barang'))])->get()->getRow();
            $nama_barang          = _getVar($this->request->getVar('e_nama_barang'));
            $merk                 = _getVar($this->request->getVar('e_merk'));
            $no_serial            = _getVar($this->request->getVar('e_no_serial'));
            $tanggal              = _getVar($this->request->getVar('e_tanggal'));
            $jml_barang           = _getVar($this->request->getVar('e_jml_barang'));
            $harga                = _getVar($this->request->getVar('e_harga'));
            $jenis_pengajuan      = _getVar($this->request->getVar('e_jenis_pengajuan'));
            $data = [
                'nama_barang'     => $nama_barang,
                'merk'            => $merk,
                'no_serial'       => $no_serial,
                'tanggal'         => $tanggal,
                'jml_barang'      => $jml_barang,
                'harga'           => $harga,
                'jenis_pengajuan' => $jenis_pengajuan,
                'status'          => $pembelian_perawatan->status,
            ];
            $update = updateData('tb_pembelian_barang_fotokopi', $data, ['kode_barang' => $pembelian_perawatan->kode_barang]);
            if ($update) {
                $json['success'] = $update;
            } else {
                $json['error']  = 'update pengajuan barang gagal';
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function pembelian_perawatan_delete($id_pembelian_barang)
    {
        $pembelian_perawatan = getData('tb_pembelian_barang_fotokopi', ['id_pembelian_barang' => $id_pembelian_barang])->get()->getRow();
        if (!$pembelian_perawatan) {
            $json['msg'] = 'data pembelian tidak ditemukan';
        } else {
            $delete = deleteData('tb_pembelian_barang_fotokopi', ['id_pembelian_barang' => $id_pembelian_barang]);
            if ($delete) {
                $json['success']    = 1;
            } else {
                $json['msg']        = $delete;
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function laporan_transaksi()
    {
        $start_date = _getVar($this->request->getVar('start_date'));
        $end_date   = _getVar($this->request->getVar('end_date'));
        $filter_kebutuhan_transaksi = _getVar($this->request->getVar('kebutuhan_transaksi'));
        $data['shift']      = selectShift();
        $data['area']       = selectArea();
        $data['start_date'] = $start_date == "" ? date('Y-m-') . '01' : $start_date;
        $data['end_date'] = $end_date == "" ? date('Y-m-t') : $end_date;
        $data['laporan_transaksi'] = getData('tb_transaksi_fotokopi', ['tanggal BETWEEN "' . $data['start_date'] . '" AND "' . $data['end_date'] . '"' => null])->get()->getResult();
        return _tempHTML('fotocopy/laporan', $data);
    }
}
