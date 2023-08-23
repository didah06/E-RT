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
