<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model  = new UserModel();
    }
    public function index()
    {
        $data['rekan'] = getUser(['jabatan' => _session('jabatan'), 'id !=' => _session('id')])->getResult();
        return _tempHTML('user/index', $data);
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
            return redirect()->to(base_url() . '/user/profile_edit')->withInput();
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
            return redirect()->to('/user')->with('success', 'Data updated successfully');
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
    public function user_security()
    {
        $data['user'] = getUser(['ms_user.id_jabatan' => 3, 'is_aktif' => 1])->getResult();
        return _tempHTML('user/security/index', $data);
    }
    public function security_add()
    {
        $data['jabatan'] = selectJabatan();
        return _tempHTML('user/security/add');
    }
    public function security_save()
    {
    }
    //OfficeBoy
    public function user_officeBoy()
    {
        $data['user'] = getUser(['ms_user.id_jabatan' => 4, 'is_aktif' => 1])->getResult();
        return _tempHTML('user/office-boy/index', $data);
    }
    //Driver
    public function user_driver()
    {
        $data['user'] = getUser(['ms_user.id_jabatan' => 5, 'is_aktif' => 1])->getResult();
        return _tempHTML('user/driver/index', $data);
    }
    //user akses
    public function akses()
    {
        return _tempHTML('user/user_akses');
    }
}
