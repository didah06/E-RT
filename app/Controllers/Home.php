<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['baru']          = count_status(['status' => 'baru']);
        $data['diproses']      = count_status(['status' => 'diproses']);
        $data['selesai']      = count_status(['status' => 'selesai']);
        $data['ditolak']      = count_status(['status' => 'ditolak']);
        $data['booking']       = getData('tb_booking_transport')->get()->getResult();
        return _tempHTML('dashboard/index', $data);
    }
}
