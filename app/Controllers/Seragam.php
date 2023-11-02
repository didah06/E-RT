<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Seragam extends BaseController
{
    public function index()
    {
        $data['departemen'] = selectDepartemen();
        $data['seragam']    = getData('tb_seragam')->get()->getResult();
        return _tempHTML('seragam/seragam', $data);
    }
    public function seragam_save()
    {
        $json['input'] = [
            'jenis_seragam'   => $this->_validation('jenis_seragam', 'Jenis Seragam', 'required'),
            'gambar'          => $this->_validation('gambar', 'Gambar', 'uploaded[gambar]|max_size[gambar, 1024]|mime_in[gambar,image/jpeg,image/png,image/jpg]'),
        ];
        $json['select'] = [
            'id_dept'         => $this->_validation('id_dept', 'Departemen', 'required'),
            'ukuran'          => $this->_validation('ukuran', 'Ukuran', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $departemen = getData('ms_departemen', ['id_dept' => _getVar($this->request->getVar('id_dept'))])->get()->getRow();
            $jenis_seragam = _getVar($this->request->getVar('jenis_seragam'));
            $gambar = $this->request->getFile('gambar');
            if (!$departemen) {
                $json['select']['id_dept'] = 'departemen tidak ditemukan';
            } else {
                if ($gambar->getError() == 0 && $gambar->isValid() && !$gambar->hasMoved()) {
                    $design        = $gambar->getRandomName();
                    $gambar->move(FCPATH . './public/assets/images/seragam/gambar', $design);
                    $data = [
                        'departemen'    => $departemen->departemen,
                        'jenis_seragam' => $jenis_seragam,
                        'gambar'        => $design,
                    ];
                    $add = addData('tb_seragam', $data);
                    if ($add) {
                        $json['success'] = 'data seragam berhasil ditambahkan';
                    } else {
                        $json['error'] = 'data seragam gagal ditambahkan';
                    }
                } else {
                    $json['input']['gambar'] = 'gambar gagal upload';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function data_vendor()
    {
        $data['vendor'] = getData('tb_vendor')->get()->getResult();
        return _tempHTML('seragam/vendor', $data);
    }
    public function data_vendor_save()
    {
        $json['input'] = [
            'vendor'    => $this->_validation('vendor', 'Vendor', 'required'),
            'alamat'    => $this->_validation('alamat', 'Alamat', 'required'),
            'telp'      => $this->_validation('telp', 'Telepon', 'required|decimal|min_length[12]')
        ];
        if (_validationHasErrors($json['input'])) {
            $vendor = _getVar($this->request->getVar('vendor'));
            $alamat = _getVar($this->request->getVar('alamat'));
            $telp   = _getVar($this->request->getVar('telp'));
            $data = [
                'vendor' => $vendor,
                'alamat' => $alamat,
                'telp'   => $telp,
            ];
            $add = addData('tb_vendor', $data);
            if ($add) {
                $json['success'] = $add;
            } else {
                $json['error'] = 'Data Vendor gagal disimpan';
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function pemesanan_seragam()
    {
        $data['seragam']   = selectSeragam();
        $data['vendor']    = selectVendor();
        $data['pemesanan'] = getData('tb_pemesanan_seragam')->get()->getResult();
        $data['pengiriman'] = getData('tb_pemesanan_seragam')->get()->getRow();
        return _tempHTML('seragam/pemesanan', $data);
    }
    public function pemesanan_save()
    {
        $json['input'] = [
            'tgl_pemesanan'  => $this->_validation('tgl_pemesanan', 'Tanggal Pemesanan', 'required|valid_date'),
            'jumlah_pesanan' => $this->_validation('jumlah_pesanan', 'Jumlah Pesanan', 'required|decimal'),
            'biaya'          => $this->_validation('biaya', 'Biaya', 'required|decimal'),
        ];
        $json['select'] = [
            'id_seragam'    => $this->_validation('id_seragam', 'Seragam', 'required'),
            'id_vendor'     => $this->_validation('id_vendor', 'Vendor', 'required'),
            'ukuran'        => $this->_validation('ukuran', 'Ukuran', 'required'),
        ];
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $seragam        = getData('tb_seragam', ['id_seragam' => _getVar($this->request->getVar('id_seragam'))])->get()->getRow();
            $vendor         = getData('tb_vendor', ['id_vendor' => _getVar($this->request->getVar('id_vendor'))])->get()->getRow();
            $tgl_pemesanan  = _getVar($this->request->getVar('tgl_pemesanan'));
            $jumlah_pesanan = _getVar($this->request->getVar('jumlah_pesanan'));
            $biaya          = _getVar($this->request->getVar('biaya'));
            $ukuran         = _getVar($this->request->getVar('ukuran'));
            if (!$seragam) {
                $json['select']['seragam'] = 'data seragam tidak ditemukan';
            } else if (!$vendor) {
                $json['select']['vendor'] = 'data vendor tidak ditemukan';
            } else {
                $data = [
                    'id_seragam'        => $seragam->id_seragam,
                    'jenis_seragam'     => $seragam->jenis_seragam,
                    'departemen'        => $seragam->departemen,
                    'id_vendor'         => $vendor->id_vendor,
                    'vendor'            => $vendor->vendor,
                    'tgl_pemesanan'     => $tgl_pemesanan,
                    'ukuran'            => $ukuran,
                    'jumlah_pesanan'    => $jumlah_pesanan,
                    'sisa_pesanan'      => $jumlah_pesanan,
                    'biaya'             => $biaya,
                    'status'            => 'dipesan',
                    'created_by'        => _session('nama'),
                    'created_at'        => time(),
                ];
                $add = addData('tb_pemesanan_seragam', $data);
                if ($add) {
                    $json['success'] = $add;
                } else {
                    $json['error'] = 'data seragam gagal dipesan';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function update_status($id_pemesanan)
    {
        $pemesanan = getData('tb_pemesanan_seragam', ['id_pemesanan' => $id_pemesanan])->get()->getRow();
        if ($pemesanan) {
            $data = [
                'status'    => true,
                'data'      => $pemesanan
            ];
        } else {
            $data = [
                'status'    => false,
                'data'      => ''
            ];
        }
        echo json_encode($data);
    }
    public function update_dikirim()
    {
        $id_pemesanan   = _getVar($this->request->getVar('id_pemesanan'));
        $json['input'] = [
            'tgl_pengiriman' =>  $this->_validation('tgl_pengiriman', 'Tanggal Pengiriman', 'required'),
            'jumlah_dikirim' =>  $this->_validation('jumlah_dikirim', 'Jumlah dikirim', 'required|is_natural_no_zero'),
            'sisa_pesanan'   => $this->_validation('sisa_pesanan', 'Sisa Pesanan', 'required'),
        ];
        if (_validationHasErrors($json['input'])) {
            $pemesanan      = getData('tb_pemesanan_seragam', ['id_pemesanan' => $id_pemesanan])->get()->getRow();
            $tgl_pengiriman = _getVar($this->request->getVar('tgl_pengiriman'));
            $jumlah_dikirim = _getVar($this->request->getVar('jumlah_dikirim'));
            $sisa_pesanan   = $pemesanan->jumlah_pesanan - ($jumlah_dikirim + $pemesanan->jumlah_dikirim);
            $status = 'dipesan';

            if ($sisa_pesanan < 0) {
                $json['error'] = 'jumlah kirim melebihi jumlah pesanan';
                echo json_encode($json);
                die;
            }
            if ($sisa_pesanan == 0) {
                $status = 'dikirim';
            }
            $data = [
                'tgl_pengiriman'        => $tgl_pengiriman,
                'jumlah_dikirim'        => $jumlah_dikirim + $pemesanan->jumlah_dikirim,
                'sisa_pesanan'          => $sisa_pesanan,
                'status'                => $status,
                'created_pengiriman_by' => _session('nama'),
                'created_pengiriman_at' => time(),
            ];
            // $json['data'] = $data;
            $update = updateData('tb_pemesanan_seragam', $data, ['id_pemesanan' => $id_pemesanan]);
            if ($update) {
                $json['success'] = $update;
            } else {
                $json['error'] = 'gagal update';
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function update_diterima()
    {
        $id_pemesanan   = _getVar($this->request->getVar('id_pemesanan'));
        $json['input'] = [
            'tgl_diterima'    => $this->_validation('tgl_diterima', 'Tanggal Diterima', 'required'),
            'jumlah_diterima' => $this->_validation('jumlah_diterima', 'Jumlah Diterima', 'required'),
        ];
        if (_validationHasErrors($json['input'])) {
            $tgl_diterima = _getVar($this->request->getVar('tgl_diterima'));
            $jumlah_diterima = _getVar($this->request->getVar('jumlah_diterima'));
            $data = [
                'tgl_diterima'          => $tgl_diterima,
                'jumlah_diterima'       => $jumlah_diterima,
                'stok_seragam'          => $jumlah_diterima,
                'status'                => 'diterima',
                'created_diterima_by'   => _session('nama'),
                'created_diterima_at'   => time(),
            ];
            $update = updateData('tb_pemesanan_seragam', $data, ['id_pemesanan' => $id_pemesanan]);
            if ($update) {
                $json['success'] = $update;
            } else {
                $json['error'] = 'gagal update';
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function persediaan()
    {
        $data['persediaan'] = getData('tb_pemesanan_seragam', ['status' => 'diterima'])->get()->getResult();
        $data['pemesanan'] = getData('tb_pemesanan_seragam', ['status' => 'diterima'])->get()->getRow();
        return _tempHTML('seragam/persediaan', $data);
    }
    public function get_pemesanan($id_pemesanan)
    {
        $pemesanan = getData('tb_pemesanan_seragam', ['id_pemesanan' => $id_pemesanan])->get()->getRow();
        if ($pemesanan) {
            $data = [
                'status'    => true,
                'data'      => $pemesanan
            ];
        } else {
            $data = [
                'status'    => false,
                'data'      => ''
            ];
        }
        echo json_encode($data);
    }
    public function pengeluaran()
    {
        $data['pengeluran'] = getData('tb_pengambilan_seragam')->get()->getResult();
        return _tempHTML('seragam/pengeluaran', $data);
    }
    public function pengeluaran_save()
    {
        $id_pemesanan = _getVar($this->request->getVar('id_pemesanan'));
        $json['input'] = [
            'tgl_pengambilan_seragam' => $this->_validation('tgl_pengambilan_seragam', 'Tanggal Pengambilan Seragam', 'required|valid_date'),
            'jumlah_ambil_seragam'    => $this->_validation('jumlah_ambil_seragam', 'Jumlah Ambil Seragam', 'required|decimal'),
            'foto'                    => $this->_validation('foto', 'foto', 'uploaded[foto]|max_size[foto, 1024]|mime_in[foto,image/jpeg,image/png,image/jpg]'),
        ];
        if (_validationHasErrors($json['input'])) {
            $pemesanan       = getData('tb_pemesanan_seragam', ['id_pemesanan' => $id_pemesanan])->get()->getRow();
            $tgl_pengambilan = _getVar($this->request->getVar('tgl_pengambilan_seragam'));
            $jml_pengambilan = _getVar($this->request->getVar('jumlah_ambil_seragam'));
            $stok            = $pemesanan->stok_seragam - $jml_pengambilan;
            $foto            = $this->request->getFile('foto');
            if (!$pemesanan) {
                echo 'data pemesanan tidak ditemukan';
            } else {
                if ($foto->getError() == 0 && $foto->isValid() && !$foto->hasMoved()) {
                    $photo             = $foto->getRandomName();
                    ($foto->move(FCPATH . './public/assets/images/seragam/pengambilan_seragam', $photo));
                    if ($pemesanan->stok_seragam == 0) {
                        $data = [
                            'status_stok'             => 'stok habis'
                        ];
                        updateData('tb_pemesanan_seragam', $data, ['id_pemesanan' => $id_pemesanan]);
                    }
                    if ($pemesanan->stok_seragam > 0) {
                        $data = [
                            'status_stok'             => 'stok tersedia'
                        ];
                        updateData('tb_pemesanan_seragam', $data, ['id_pemesanan' => $id_pemesanan]);
                    }
                    $data = [
                        'id_seragam'              => $pemesanan->id_seragam,
                        'jenis_seragam'           => $pemesanan->jenis_seragam,
                        'departemen'              => $pemesanan->departemen,
                        'tgl_pengambilan_seragam' => $tgl_pengambilan,
                        'jumlah_ambil_seragam'    => $jml_pengambilan,
                        'stok_seragam'            => $stok,
                        'foto'                    => $photo,
                        'created_by'              => _session('nama'),
                        'created_at'              => time(),
                    ];
                    $add = addData('tb_pengambilan_seragam', $data);
                    if ($add > 0) {
                        $data = [
                            'jumlah_diambil' => $jml_pengambilan,
                            'stok_seragam'   => $stok,
                        ];
                        updateData('tb_pemesanan_seragam', $data, ['id_pemesanan' => $pemesanan->id_pemesanan]);
                        $json['success'] = $add;
                    } else {
                        $json['error'] = 'pengambilan gagal';
                    }
                } else {
                    $json['input']['foto'] = 'foto gagal upload';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
}
