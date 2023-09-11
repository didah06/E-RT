<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DirektoratModel;
use App\Models\DivisiModel;
use App\Models\DepartemenModel;


class User extends BaseController
{
    protected $model;
    protected $modeldirektorat;
    protected $modeldivisi;
    protected $modeldept;

    public function __construct()
    {
        $this->model  = new UserModel();
        $this->modeldirektorat = new DirektoratModel();
        $this->modeldivisi = new DivisiModel();
        $this->modaldept = new DepartemenModel();
    }
    public function index()
    {
        $data['ms_user']    = selectMasterUser();
        $data['direktorat'] = selectDirektorat();
        $data['divisi']     = selectDivisi();
        $data['departemen'] = selectDepartemen();
        $data['role']       = selectRole();
        $data['user']       = getUser(['ms_user.role NOT IN("Satpam", "Driver", "Dapur", "Developer")' => null, 'is_aktif' => 1])->getResult();
        return _tempHTML('user/index', $data);
    }
    public function user_save()
    {
        $json['input'] = [
            'nama'              => $this->_validation('nama', 'Nama', 'required|min_length[5]'),
            'jabatan'           => $this->_validation('jabatan', 'Jabatan', 'required|min_length[2]'),
            'tmpt_lahir'        => $this->_validation('tmpt_lahir', 'Tempat Lahir', 'required'),
            'tgl_lahir'         => $this->_validation('tgl_lahir', 'Tanggal Lahir', 'required|valid_date[Y-m-d]'),
        ];
        $json['select'] = [
            'user_id'           => $this->_validation('user_id', 'User', 'required|is_natural|is_unique[ms_user.master_id]'),
            'id_direktorat'     => $this->_validation('id_direktorat', 'Direktorat', 'required|is_natural'),
            'jk'                => $this->_validation('jk', 'Jenis Kelamin', 'required'),
        ];
        if (!empty($this->request->getVar('hp'))) {
            $json['input']['hp']    = $this->_validation('hp', 'No. Handphone', 'min_length[8]|is_natural');
        }
        if (!empty($this->request->getVar('role'))) {
            $role = $this->request->getVar('role');
            if ($role == 'Kadiv') {
                $json['select'] = [
                    'id_direktorat'     => $this->_validation('id_direktorat', 'Direktorat', 'required|is_natural'),
                    'id_divisi'         => $this->_validation('id_divisi', 'Divisi', 'required|is_natural'),
                ];
                if (!empty($this->request->getVar('id_divisi'))) {
                    $divisi    = getData('ms_divisi', ['id_divisi' => _getVar($this->request->getVar('id_divisi'))])->get()->getRow();
                    if (!$divisi) {
                        $json['select'] = [
                            'id_divisi'        => "Pilihan data tidak ditemukan",
                        ];
                    }
                }
            } else if ($role == 'Kadep' || $role == 'Staf' || $role == 'TU') {
                $json['select'] = [
                    'id_direktorat'     => $this->_validation('id_direktorat', 'Direktorat', 'required|is_natural'),
                    'id_divisi'         => $this->_validation('id_divisi', 'Divisi', 'required|is_natural'),
                    'id_dept'           => $this->_validation('id_dept', 'Departemen', 'required|is_natural'),
                ];
                if (!empty($this->request->getVar('id_dept'))) {
                    $divisi    = getData('ms_divisi', ['id_divisi' => _getVar($this->request->getVar('id_divisi'))])->get()->getRow();
                    $departemen    = getData('ms_departemen', ['id_dept' => _getVar($this->request->getVar('id_dept'))])->get()->getRow();
                    if (!$divisi) {
                        $json['select'] = [
                            'id_divisi' => 'Pilihan data tidak ditemukan',
                        ];
                    } else if (!$departemen) {
                        $json['select'] = [
                            'id_dept' => 'Pilihan data tidak ditemukan',
                        ];
                    }
                }
            } else {
                $json['select']['role'] = $this->_validation('role', 'Role', 'required');
            }
        }
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $user          = getData('db_master.ms_user', ['user_id' => _getVar($this->request->getVar('user_id'))])->get()->getRow();
            $role          = _getVar($this->request->getVar('role'));
            $direktorat    = getData('ms_direktorat', ['id_direktorat' => _getVar($this->request->getVar('id_direktorat'))])->get()->getRow();
            if (!$user) {
                $json['select'] = [
                    'user_id'             => 'Pilihan data tidak ditemukan',
                ];
            } else if (!$direktorat) {
                $json['select'] = [
                    'id_direktorat'       => 'Pilihan data tidak ditemukan',
                ];
            } else {
                $data = [
                    'master_id'         => $user->user_id,
                    'id_direktorat'     => $direktorat->id_direktorat,
                    'id_divisi'         => $role != 'Direktur' ? $divisi->id_divisi : null,
                    'id_dept'           => $role != 'Direktur' && $role != 'Divisi' ? $departemen->id_dept : null,
                    'role'              => $role,
                ];
                $add = $this->model->insert($data);
                if ($add > 0) {
                    $nama        = _getVar($this->request->getVar('nama'));
                    $jabatan    = _getVar($this->request->getVar('jabatan'));
                    $jk            = _getVar($this->request->getVar('jk'));
                    $hp            = !empty($this->request->getVar('hp')) ? _noHP(_getVar($this->request->getVar('hp'))) : '';
                    $tmpt_lahir    = _getVar($this->request->getVar('tmpt_lahir'));
                    $tgl_lahir    = _getVar($this->request->getVar('tgl_lahir'));
                    $data        = [
                        'nama'            => $nama,
                        'jabatan'        => $jabatan,
                        'jk'            => $jk,
                        'hp'            => $hp,
                        'tmpt_lahir'    => $tmpt_lahir,
                        'tgl_lahir'        => $tgl_lahir,
                    ];
                    updateData('db_master.ms_user', $data, ['user_id'     => $user->user_id]);
                    $json['success']    = $add;
                } else {
                    $json['error']        = 'Tambah user gagal';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function user_update()
    {
        $json['input'] = [
            'e_nama'              => $this->_validation('e_nama', 'Nama', 'required|min_length[5]'),
            'e_jabatan'           => $this->_validation('e_jabatan', 'Jabatan', 'required|min_length[2]'),
            'e_tmpt_lahir'        => $this->_validation('e_tmpt_lahir', 'Tempat Lahir', 'required'),
            'e_tgl_lahir'         => $this->_validation('e_tgl_lahir', 'Tanggal Lahir', 'required|valid_date[Y-m-d]'),
        ];
        $json['select'] = [
            'e_user_id'           => $this->_validation('e_user_id', 'User', 'required|is_natural|is_unique[ms_user.master_id]'),
            'e_id_direktorat'     => $this->_validation('e_id_direktorat', 'Direktorat', 'required|is_natural'),
            'e_jk'                => $this->_validation('e_jk', 'Jenis Kelamin', 'required'),
        ];
        if (!empty($this->request->getVar('e_hp'))) {
            $json['input']['hp']    = $this->_validation('e_hp', 'No. Handphone', 'min_length[8]|is_natural');
        }
        if (!empty($this->request->getVar('e_role'))) {
            $role = $this->request->getVar('e_role');
            if ($role == 'Kadiv') {
                $json['select']['e_id_divisi'] = $this->_validation('e_id_divisi', 'Divisi', 'required|is_natural');
                if (!empty($this->request->getVar('e_id_divisi'))) {
                    $divisi = getData('ms_divisi', ['id_divisi' => _getVar($this->request->getVar('e_id_divisi'))])->get()->getRow();
                    $json['select']['id_divisi'] = 'Pilihan data tidak ditemukan';
                }
            } else if ($role == 'Kadep' || $role == 'Staf' || $role == 'TU') {
                $json['select'] = [
                    'e_id_direktorat'     => $this->_validation('e_id_direktorat', 'Direktorat', 'required|is_natural'),
                    'e_id_divisi'         => $this->_validation('e_id_divisi', 'Divisi', 'required|is_natural'),
                    'e_id_dept'           => $this->_validation('e_id_dept', 'Departemen', 'required|is_natural'),
                ];
                if (!empty($this->request->getVar('e_id_dept'))) {
                    $divisi        = getData('ms_divisi', ['id_divisi' => _getVar($this->request->getVar('e_id_divisi'))])->get()->getRow();
                    $departemen    = getData('ms_departemen', ['id_dept' => _getVar($this->request->getVar('e_id_dept'))])->get()->getRow();
                    if (!$divisi) {
                        $json['select']['id_divisi'] = 'Pilihan data tidak ditemukan';
                    } else if (!$departemen) {
                        $json['select']['id_dept']   = 'Pilihan data tidak ditemukan';
                    }
                }
            } else {
                $json['select']['e_role'] = $this->_validation('e_role', 'Role', 'required');
            }
        }
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $user          = getData('db_master.ms_user', ['user_id' => _getVar($this->request->getVar('e_user_id'))])->get()->getRow();
            $role          = _getVar($this->request->getVar('e_role'));
            $direktorat    = getData('ms_direktorat', ['id_direktorat' => _getVar($this->request->getVar('e_id_direktorat'))])->get()->getRow();
            if (!$user) {
                $json['select'] = [
                    'e_user_id'             => 'Pilihan data tidak ditemukan',
                ];
            } else if (!$direktorat) {
                $json['select'] = [
                    'id_direktorat'         => 'Pilihan data tidak ditemukan',
                ];
            } else {
                $nama           = _getVar($this->request->getVar('e_nama'));
                $jabatan        = _getVar($this->request->getVar('e_jabatan'));
                $jk             = _getVar($this->request->getVar('e_jk'));
                $hp             = !empty($this->request->getVar('e_hp')) ? _noHP(_getVar($this->request->getVar('e_hp'))) : '';
                $tmpt_lahir     = _getVar($this->request->getVar('e_tmpt_lahir'));
                $tgl_lahir      = _getVar($this->request->getVar('e_tgl_lahir'));
                $data        = [
                    'nama'              => $nama,
                    'jabatan'           => $jabatan,
                    'jk'                => $jk,
                    'hp'                => $hp,
                    'tmpt_lahir'        => $tmpt_lahir,
                    'tgl_lahir'         => $tgl_lahir,

                ];
                $update = updateData('db_master.ms_user', $data, ['user_id'     => $user->user_id]);
                $data = [
                    'master_id'         => $user->user_id,
                    'id_direktorat'     => $direktorat->id_direktorat,
                    'id_divisi'         => $role != 'Direktur' ? $divisi->id_divisi : null,
                    'id_dept'           => $role != 'Direktur' && $role != 'Divisi' ? $departemen->id_dept : null,
                    'role'              => $role,
                ];
                $update = updateData('ms_user', $data, ['master_id'     => $user->user_id]);
                $update += $this->model->db->affectedRows();
                if ($update > 0) {
                    $json['success']      = $update;
                } else {
                    $json['error']        = 'Tidak ada data yang berubah';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function user_delete()
    {
        $json['input']['user_id'] = $this->_validation('user_id', 'User', 'required|is_natural');
        if (_validationHasErrors(array_merge($json['input']))) {
            $user = getUser(['user_id' => _getVar($this->request->getVar('user_id'))])->getRow();
            if (!$user) {
                $json['msg'] = 'User tidak ditemukan';
            } else {
                $delete = $this->model->delete($user->id);
                if ($delete) {
                    $json['success']    = 1;
                } else {
                    $json['msg']        = $delete;
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    public function profile()
    {
        $data['rekan'] = getUser(['jabatan' => _session('jabatan'), 'id !=' => _session('id')])->getResult();
        return _tempHTML('user/profile', $data);
    }
    public function profile_edit()
    {
        $data['user']    = getUser(['id' => _session('id')])->getRow();
        return _tempHTML('user/profile_edit', $data);
    }
    public function profile_update()
    {
        $rules = [
            'foto'          => 'mime_in[foto,image/jpg,image/jpeg,image/png]|is_image[foto]',
            'nama'          => 'required|min_length[5]',
            'jabatan'       => 'required',
            'jk'            => 'required',
            'hp'            => 'required|is_natural|min_length[10]',
            'tmpt_lahir'    => 'required',
            'tgl_lahir'     => 'required|valid_date[Y-m-d]',
        ];
        if (!$this->validate($rules)) {
            $rules = \Config\Services::validation();
            session()->setFlashdata($rules->getErrors());
            // dd(session()->getFlashdata('foto'));
            return redirect()->to(base_url('profile_edit'))->withInput();
        }
        $nama       = _getVar($this->request->getVar('nama'));
        $jabatan    = _getVar($this->request->getVar('jabatan'));
        $jk         = _getVar($this->request->getVar('jk'));
        $hp         = _getVar($this->request->getVar('hp'));
        $tmpt_lahir = _getVar($this->request->getVar('tmpt_lahir'));
        $tgl_lahir  = _getVar($this->request->getVar('tgl_lahir'));
        $photo      = $this->request->getFile('foto');
        $user       = getUser(['id' => _session('id')])->getRow();
        if ($photo->getError() == 0) {
            $foto   = $photo->getRandomName();
            $photo->move(FCPATH . '../master/assets/img/profile/thumb', $foto);
            if ($photo->hasMoved()) {
                if (file_exists(FCPATH . '../master/assets/img/profile/thumb' . $user->foto) && $user->foto != 'default.jpg') {
                    unlink(FCPATH . '../master/assets/img/profile/thumb' . $user->foto);
                }
                if (file_exists(FCPATH . '../master/assets/img/profile/thumb' . $user->foto) && $user->foto != 'default.jpg') {
                    unlink(FCPATH . '../master/assets/img/profile/thumb' . $user->foto);
                }
            } else {
                echo 'foto gagal upload';
            }
        } else {
            $foto = $user->foto;
        }
        $data = [
            'foto'          => $foto,
            'nama'          => $nama,
            'jabatan'       => $jabatan,
            'jk'            => $jk,
            'hp'            => $hp,
            'tmpt_lahir'    => $tmpt_lahir,
            'tgl_lahir'     => $tgl_lahir,
        ];
        $update = updateData('db_master.ms_user', $data, ['user_id' => _session('user_id')]);
        if ($update) {
            return redirect()->to('profile')->with('success', 'Data updated successfully');
        } else {
            echo $update;
        }
    }
    public function change_password()
    {
        $rules = [
            'password'          => 'required',
            'new_password'      => 'required|min_length[8]',
            'confirm_password'  => 'required|matches[new_password]',
        ];
        if (!$this->validate($rules)) {
            $rules     = \Config\Services::validation();
            $json['input']    = $rules->getErrors();
        } else {
            $user            = getUser(['username' => _session('username')])->getRow();
            $password        = _getVar($this->request->getVar('password'));
            $new_password    = _getVar($this->request->getVar('new_password'));

            if (!password_verify($password, $user->password)) {
                $json['input']    = ['password' => 'Password salah'];
            } else if (password_verify($new_password, $user->password)) {
                $json['input']    = ['new_password' => 'Password baru sama dengan password lama'];
            } else {
                $password_hash    = password_hash($new_password, PASSWORD_DEFAULT);
                $update         = updateData('db_master.ms_user', ['password' => $password_hash], ['user_id' => _session('user_id')]);
                if ($update > 0) {
                    $json['success']      = $update;
                } else {
                    $json['error']        = 'Ganti password gagal';
                }
            }
        }
        $json['rscript']    = csrf_hash();
        echo json_encode($json);
    }
    //security
    public function security()
    {
        $data['security'] = getUser(['ms_user.role' => "Satpam", 'is_aktif' => 1])->getResult();
        return _tempHTML('user/security', $data);
    }
    public function security_add()
    {
        return _tempHTML('user/security_add');
    }
    public function security_save()
    {
    }
    //Driver
    public function driver()
    {
        $data['ms_user']    = selectDriverUser();
        $data['direktorat'] = selectDirektorat();
        $data['divisi']     = selectDivisi();
        $data['departemen'] = selectDepartemen();
        $data['user'] = getUser(['ms_user.role' => "driver", 'is_aktif' => 1])->getResult();
        return _tempHTML('user/driver', $data);
    }
    public function driver_save()
    {
        $json['input'] = [
            'nama'              => $this->_validation('nama', 'Nama', 'required|min_length[5]'),
            'jabatan'           => $this->_validation('jabatan', 'Jabatan', 'required|min_length[2]'),
            'tmpt_lahir'        => $this->_validation('tmpt_lahir', 'Tempat Lahir', 'required'),
            'tgl_lahir'         => $this->_validation('tgl_lahir', 'Tanggal Lahir', 'required|valid_date[Y-m-d]'),
        ];
        $json['select'] = [
            'user_id'           => $this->_validation('user_id', 'User', 'required|is_natural|is_unique[ms_user.master_id]'),
            'id_dept'           => $this->_validation('id_dept', 'Departemen', 'required|is_natural'),
            'jk'                => $this->_validation('jk', 'Jenis Kelamin', 'required'),
        ];
        if (!empty($this->request->getVar('hp'))) {
            $json['input']['hp']    = $this->_validation('hp', 'No. Handphone', 'min_length[8]|is_natural');
        }
        if (_validationHasErrors(array_merge($json['input'], $json['select']))) {
            $user          = getData('db_master.ms_user', ['user_id' => _getVar($this->request->getVar('user_id'))])->get()->getRow();
            $departemen    = getData('ms_departemen', ['id_dept' => _getVar($this->request->getVar('id_dept'))])->get()->getRow();
            if (!$user) {
                $json['select'] = [
                    'user_id'       => 'Pilihan data tidak ditemukan',
                ];
            } else if (!$departemen) {
                $json['select'] = [
                    'id_dept' => 'Pilihan data tidak ditemukan',
                ];
            } else {
                $data = [
                    'master_id'         => $user->user_id,
                    'id_direktorat'     => $departemen->id_direktorat,
                    'id_divisi'         => $departemen->id_divisi,
                    'id_dept'           => $departemen->id_dept,
                    'role'              => 'Driver',
                ];
                $add = $this->model->insert($data);
                if ($add > 0) {
                    $nama           = _getVar($this->request->getVar('nama'));
                    $jabatan        = _getVar($this->request->getVar('jabatan'));
                    $jk             = _getVar($this->request->getVar('jk'));
                    $hp             = !empty($this->request->getVar('hp')) ? _noHP(_getVar($this->request->getVar('hp'))) : '';
                    $tmpt_lahir     = _getVar($this->request->getVar('tmpt_lahir'));
                    $tgl_lahir      = _getVar($this->request->getVar('tgl_lahir'));
                    $data           = [
                        'nama'              => $nama,
                        'jabatan'           => $jabatan,
                        'jk'                => $jk,
                        'hp'                => $hp,
                        'tmpt_lahir'        => $tmpt_lahir,
                        'tgl_lahir'         => $tgl_lahir,
                    ];
                    updateData('db_master.ms_user', $data, ['user_id'     => $user->user_id]);
                    $json['success']    = $add;
                } else {
                    $json['error']        = 'Tambah user gagal';
                }
            }
            $json['rscript']    = csrf_hash();
            echo json_encode($json);
        }
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
    public function select_divisi($id_direktorat)
    {
        $defaultNull    = _getVar($this->request->getVar('df'));
        $divisi         = $this->modeldivisi->where('id_direktorat', $id_direktorat)->get()->getResult();
        if ($defaultNull == '') {
            $select    = '<option value="" selected disabled>--Pilih Divisi--</option>';
        } else if ($defaultNull == 1) {
            $select    = '<option value="" selected>--Semua Divisi--</option>';
        }
        foreach ($divisi as $item) {
            $select    .= '<option value="' . $item->id_divisi . '">' . $item->divisi . '</option>';
        }
        echo $select;
    }
    public function select_departemen($id_divisi)
    {
        $defaultNull    = _getVar($this->request->getVar('df'));
        $departemen     = $this->modaldept->where('id_divisi', $id_divisi)->get()->getResult();
        if ($defaultNull == '') {
            $select    = '<option value="" selected disabled>--Pilih Departemen--</option>';
        } else if ($defaultNull == 1) {
            $select    = '<option value="" selected>--Semua Departemen--</option>';
        }
        foreach ($departemen as $item) {
            $select    .= '<option value="' . $item->id_dept . '">' . $item->departemen . '</option>';
        }
        echo $select;
    }
    public function user_edit($user_id)
    {
        $user        = getUser(['user_id' => $user_id])->getRow();
        $user->hp    = str_replace('+62', '0', $user->hp);
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
    //user akses
    public function akses()
    {
        return _tempHTML('user/user_akses');
    }
}
