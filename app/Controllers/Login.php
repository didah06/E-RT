<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        return _tempHTML('login/index', []);
    }
    public function prosesLogin()
    {
        $Rules = [
            'username'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} harus diisi'
                ],
            ],
            'password'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} harus diisi'
                ],
            ]
        ];

        if (!$this->validate($Rules)) {
            $Rules = \Config\Services::validation();
            session()->setFlashdata($Rules->getErrors());
            return redirect()->to(base_url() . '/login')->withInput();
        }

        $username = _getVar($this->request->getVar('username'));
        $password = _getVar($this->request->getVar('password'));

        $user = getUser(['username' => $username])->getRow();

        if ($user) {
            if (password_verify($password, $user->password)) {
                if ($user->is_aktif == 1) {
                    $data = [
                        'id'            => $user->id,
                        'user_id'       => $user->user_id,
                        'username'      => $user->username,
                        'nama'          => $user->nama,
                        'foto'          => $user->foto,
                        'jenis'         => $user->jenis,
                        'role'          => $user->role,
                        'last_login'    => $user->last_login,
                        'last_history'  => $user->last_history,
                    ];
                    session()->set($data);
                    return redirect()->back();
                } else {
                    session()->setFlashdata('error', 'Akun anda tidak aktif!');
                    return redirect()->back()->withInput();
                }
            } else {
                session()->setFlashdata('error', 'Password salah!');
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata('error', 'Username <strong>' . $username . '</strong> tidak terdaftar!');
            return redirect()->back()->withInput();
        }
    }
    public function logout()
    {
        updateData('ms_user', ['last_login' => time()], ['id' => _session('id')]);
        $data = [
            'id',
            'user_id',
            'username',
            'nama',
            'foto',
            'jenis',
            'role',
            'last_login',
            'last_history',
        ];
        session()->remove($data);
        return redirect()->back();
    }
}
