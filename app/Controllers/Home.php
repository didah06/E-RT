<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['booking'] = getData('tb_booking_transport')->get()->getResult();
        return _tempHTML('dashboard/index', $data);
    }
}
