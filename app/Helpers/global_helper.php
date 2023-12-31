<?php

function _tempHTML($view, $data = [])
{
    $data_tmp = [];
    $username = _session('username');
    $user     = getUser(['username' => $username, 'is_aktif' => 1])->getRow();

    if ($user) {
        if (
            _session('id') == $user->id &&
            _session('username') == $user->username &&
            $user->is_aktif == 1
        ) {
            if (
                $user->role != 'Developer' &&
                $view       != 'dashboard/index' &&
                $view       != 'user/profile' &&
                $view       != 'user/profile_edit'
            ) {
                getAccess();
            }
            if ($view == 'login/index') {
                return redirect()->to(base_url());
            } else {
                $data['user_login']             = $user;
                $data_tmp['page_content']       = view($view, $data);
                return view('partials/template', $data_tmp);
            }
        } else {
            $data_tmp['jadwal_transport'] = getJadwalTranport(['status' => 'diproses']);
            return view('login/index', $data_tmp);
        }
    } else {
        $data_tmp['jadwal_transport'] = getJadwalTranport(['status' => 'diproses']);
        return view('login/index', $data_tmp);
    }
}
function appName()
{
    return 'E-Rumah Tangga';
}
function connectdb($table)
{
    $db = \config\Database::connect();
    $builder = $db->table($table);
    return $builder;
}
function _session($name)
{
    if ($name == 'username') {
        return session()->get($name);
    } else {
        return session()->get($name) ? session()->get($name) : 0;
    }
}
function getData($table, $where = [], $order = '', $group = '', $select = '*')
{
    $db             = \Config\Database::connect();
    $builder        = $db->table($table);
    $builder->select($select);
    $builder->where($where);
    $builder->orderBy($order);
    $builder->groupBy($group);
    return $builder;
}
function getJadwalTranport($where = [])
{
    $db = connectdb('tb_booking_transport');
    $db->select('status, jam_keberangkatan, jam_kembali, kode_booking');
    $db->where($where);
    return $db->get()->getResult();
}
function getAccess()
{
    $uri        = current_url(true);
    $num        = 0;
    $url        = $uri->getSegment(2);
    $menu       = getData('ms_menu', ['links LIKE "%(' . $url . ')%"' => null, 'is_aktif' => 1])->get();
    $submenu    = getData('ms_menu_sub', ['links LIKE "%(' . $url . ')%"' => null, 'is_aktif' => 1])->get();

    if (count($menu->getResult()) > 0) {
        $num        += getData('tb_access_menu', ['id_menu' => $menu->getRow()->id, '(role = "' . _session('role') . '" OR id_user = ' . _session('id') . ')' => null])->countAllResults();
    }
    if (count($submenu->getResult()) > 0) {
        $num    += getData('tb_access_menu', ['id_menu_sub' => $submenu->getRow()->id, '(role = "' . _session('role') . '" OR id_user = ' . _session('id') . ')' => null])->countAllResults();
    }
    if ($num == 0 && $uri != '' && _session('role') != 'Developer') {
        header('Location: ' . base_url());
        die;
    }
}
function _getVar($name)
{
    return str_replace(["'", '"'], ['', ''], trim($name));
}
function updateData($table, $set = [], $where = [])
{
    $db         = \Config\Database::connect();
    $builder    = $db->table($table);
    $builder->where($where);
    $builder->set($set);
    $builder->update();
    return $db->affectedRows();
}
function addData($table, $set = [])
{
    $db         = \Config\Database::connect();
    $builder    = $db->table($table);
    return $builder->insert($set);
}
function deleteData($table, $where = [])
{
    $db        = \Config\Database::connect();
    $builder   = $db->table($table);
    $builder->delete($where);
    return $db->affectedRows();
}
function selectDirektorat()
{
    $db = connectDb('ms_direktorat');
    $db->select("id_direktorat AS id, direktorat AS text");
    $db->orderBy('direktorat', 'ASC');
    return $db->get()->getResult();
}
function selectDivisi($id_direktorat = '')
{
    $db = connectDb('ms_divisi');
    $db->select("id_divisi AS id, divisi AS text");
    if ($id_direktorat != '') {
        $db->where('id_direktorat', $id_direktorat);
    }
    $db->orderBy('divisi', 'ASC');
    return $db->get()->getResult();
}

function selectDepartemen($id_divisi = '')
{
    $db = connectDb('ms_departemen');
    $db->select("id_dept AS id, departemen AS text");
    if ($id_divisi != '') {
        $db->where('id_divisi', $id_divisi);
    }
    $db->orderBy('departemen', 'ASC');
    return $db->get()->getResult();
}
function selectRole()
{
    $db = connectDb('ms_role');
    $db->select('role AS id, role AS text');
    $db->where(['role !=' => 'Developer']);
    $db->orderBy('role', 'ASC');
    return $db->get()->getResult();
}
function _siteUrl($uri = '')
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'] . '/';
    return $protocol . $domainName . $uri;
}
function str_between($str, $starting_word, $ending_word)
{
    $subtring_start = strpos($str, $starting_word);
    $subtring_start += strlen($starting_word);
    $size           = strpos($str, $ending_word, $subtring_start) - $subtring_start;
    return trim(substr($str, $subtring_start, $size));
}
function _validationHasErrors($array)
{
    $return = true;
    foreach ($array as $value) {
        if ($value != '') {
            $return = false;
        }
    }
    return $return;
}
function _userMenu($segmen)
{
    if (_session('role') == 'Developer') {
        if ($segmen == 'user_pengguna') {
            $menu = getData('ms_menu', ['is_aktif' => 1, 'ms_menu.id IN(1)' => null], 'sort ASC')->get()->getResult();
        } elseif ($segmen == 'sistem_manajemen') {
            $menu = getData('ms_menu', ['is_aktif' => 1, 'ms_menu.id IN(2,3,4,5,6)' => null], 'sort ASC')->get()->getResult();
        }
    } else {
        $db = connectDb('ms_menu');
        $db->select('ms_menu.*');
        $db->join('tb_access_menu', 'id_menu = ms_menu.id');
        if ($segmen == 'user_pengguna') {
            $db->where(['ms_menu.id IN(1)' => null]);
        } else if ($segmen == 'sistem_manajemen') {
            $db->where(['ms_menu.id IN(2,3,4,5,6)' => null]);
        }
        $db->where(['(role = "' . _session('role') . '" OR id_user = ' . _session('id') . ')' => null, 'is_aktif' => 1]);
        $db->groupBy('id_menu');
        $db->orderBy('sort ASC');
        $menu = $db->get()->getResult();
    }
    return $menu;
}
function _userSubMenu($id_menu)
{
    $db = connectdb('ms_menu');
    if (session('role') == 'Developer') {
        $db->select('ms_menu_sub.*');
        $db->join('ms_menu_sub', 'id_menu = ms_menu.id');
        $db->where(['ms_menu_sub.is_aktif' => 1, 'ms_menu_sub.id_menu' => $id_menu]);
        $db->orderBy('sort ASC');
        $menu = $db->get()->getResult();
    } else {
        $db->select('ms_menu_sub.*');
        $db->join('ms_menu_sub', 'ms_menu_sub.id_menu = ms_menu.id');
        $db->join('tb_access_menu', 'tb_access_menu.id_menu_sub = ms_menu_sub.id');
        $db->where(['(role = "' . session('role') . '" OR id_user = ' . session('id') . ')' => null, 'ms_menu_sub.is_aktif' => 1, 'ms_menu_sub.id_menu' => $id_menu]);
        $db->orderBy('sort ASC');
        $menu = $db->get()->getResult();
    }
    return $menu;
}
function is_menu_active($menuSegment)
{
    $currentSegment = service('request')->uri->getSegment(1);
    return ($menuSegment === $currentSegment) ? 'active' : '';
}
function getUser($where = [], $order = '')
{
    $db = connectdb('ms_user');
    $db->where($where);
    $db->orderBy($order);
    $db->select('*, ms_user.id_direktorat AS id_direktorat, ms_user.id_divisi AS id_divisi, ms_user.id_dept AS id_dept');
    $db->join('ms_direktorat', 'ms_direktorat.id_direktorat = ms_user.id_direktorat', 'LEFT');
    $db->join('ms_divisi', 'ms_divisi.id_divisi = ms_user.id_divisi', 'LEFT');
    $db->join('ms_departemen', 'ms_departemen.id_dept = ms_user.id_dept', 'LEFT');
    $db->join('ms_role', 'ms_role.role = ms_user.role');
    $db->join('db_master.ms_user', 'db_master.ms_user.user_id = ms_user.master_id');
    return $db->get();
}
function selectMasterUser()
{
    $db = connectDb('db_master.ms_user');
    $db->select("user_id AS id, CONCAT(nama, ' - (', jabatan, ')') AS text");
    $db->where('user_as', 'PTK');
    $db->whereNotIn('jabatan', ['Driver', 'Satpam', 'Staff Dapur', 'Helper Dapur', 'Supervisor Dapur']);
    $db->orderBy('nama', 'ASC');
    return $db->get()->getResult();
}
function selectDriverUser()
{
    $db = connectDb('db_master.ms_user');
    $db->select("user_id AS id, CONCAT(nama, ' - (', jabatan, ')') AS text");
    $db->where('user_as', 'PTK');
    $db->whereIn('jabatan', ['Driver']);
    $db->orderBy('nama', 'ASC');
    return $db->get()->getResult();
}
function _noHP($nohp)
{
    // kadang ada penulisan no hp 0811 239 345
    $nohp = str_replace(" ", "", $nohp);
    // kadang ada penulisan no hp (0274) 778787
    $nohp = str_replace("(", "", $nohp);
    // kadang ada penulisan no hp (0274) 778787
    $nohp = str_replace(")", "", $nohp);
    // kadang ada penulisan no hp 0811.239.345
    $nohp = str_replace(".", "", $nohp);

    // cek apakah no hp mengandung karakter + dan 0-9
    if (!preg_match('/[^+0-9]/', trim($nohp))) {
        // cek apakah no hp karakter 1-3 adalah +62
        if (substr(trim($nohp), 0, 3) == '+62') {
            $hp = trim($nohp);
        }
        // cek apakah no hp karakter 1 adalah 0
        elseif (substr(trim($nohp), 0, 1) == '0') {
            $hp = '+62' . substr(trim($nohp), 1);
        } elseif (substr(trim($nohp), 0, 1) > 0) {
            $hp = '+62' . trim($nohp);
        }
    }
    return $hp;
}
function getMasterUser($where = [])
{
    $db = connectdb('db_master.ms_user');
    $db->where($where);
    return $db->get()->getRow();
}
function selectKendaraan()
{
    $db = connectDb('ms_kendaraan');
    $db->select("id_kendaraan AS id, CONCAT(jenis_kendaraan, ' - (', merk, ')') AS text");
    $db->orderBy('jenis_kendaraan', 'ASC');
    return $db->get()->getResult();
}
function generateKodeBooking()
{
    $prefix = 'RT'; // Prefix for the booking code
    $length = 6; // Length of the random part
    $currentdate = date('Ymd');
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Characters to use

    $randomPart = '';
    for ($i = 0; $i < $length; $i++) {
        $randomPart .= $characters[rand(0, strlen($characters) - 1)];
    }

    $kode_booking = $prefix . '-' . $currentdate . $randomPart;

    return $kode_booking;
}
function selectKodeBooking()
{
    $db = connectDb('tb_booking_transport');
    $db->select("id_booking AS id, CONCAT(kode_booking, ' - (', tujuan, ')') AS text, TIME_FORMAT(jam_keberangkatan, '%H:%i') AS jam_keberangkatan_formatted");
    $db->where('status', 'diproses');
    $db->orderBy('id_booking', 'ASC');
    return $db->get()->getResult();
}
function selectJadwalStart($where = [])
{
    $db = connectdb('ms_jadwal');
    $db->select("id_jadwal_start as id, start_time as text");
    $db->orderBy('start_time', 'ASC');
    return $db->get()->getResult();
}
function selectJadwalEnd()
{
    $db = connectdb('ms_jadwal');
    $db->select("id_jadwal_end as id, end_time as text");
    $db->orderBy('end_time', 'ASC');
    return $db->get()->getResult();
}
function isJamKeberangkatanTerisi($tanggal_pemakaian, $jam_keberangkatan, $jam_kembali)
{
    $db = \config\Database::connect();
    // $db->where('status', 'proses');
    // $db->where('tanggal_pemakaian', $tanggal_pemakaian);
    // $db->where('jam_keberangkatan <=', $jam_pulang);
    // $db->where('jam_pulang >=', $jam_keberangkatan);
    // $count = $db->countAllResults();
    // return $count;
    $query = $db->query("SELECT COUNT(*) AS counttime FROM `tb_booking_transport` WHERE `tanggal_pemakaian` = '$tanggal_pemakaian'
    AND (
 (`jam_keberangkatan` <= '$jam_kembali' AND `jam_kembali` >= '$jam_kembali')
      OR (`jam_keberangkatan` >= '$jam_keberangkatan' AND `jam_kembali` <= '$jam_kembali')
    )");
    return $query->getRow()->counttime;
}
function _signatureKosong()
{
    return 'iVBORw0KGgoAAAANSUhEUgAAAPoAAACWCAYAAAD32pUcAAAAAXNSR0IArs4c6QAAA6ZJREFUeF7t0wEBAAAIwjDtX9oefjZgyI4jQOC9wL5PKCABAmPonoBAQMDQAyWLSMDQ/QCBgIChB0oWkYCh+wECAQFDD5QsIgFD9wMEAgKGHihZRAKG7gcIBAQMPVCyiAQM3Q8QCAgYeqBkEQkYuh8gEBAw9EDJIhIwdD9AICBg6IGSRSRg6H6AQEDA0AMli0jA0P0AgYCAoQdKFpGAofsBAgEBQw+ULCIBQ/cDBAIChh4oWUQChu4HCAQEDD1QsogEDN0PEAgIGHqgZBEJGLofIBAQMPRAySISMHQ/QCAgYOiBkkUkYOh+gEBAwNADJYtIwND9AIGAgKEHShaRgKH7AQIBAUMPlCwiAUP3AwQCAoYeKFlEAobuBwgEBAw9ULKIBAzdDxAICBh6oGQRCRi6HyAQEDD0QMkiEjB0P0AgIGDogZJFJGDofoBAQMDQAyWLSMDQ/QCBgIChB0oWkYCh+wECAQFDD5QsIgFD9wMEAgKGHihZRAKG7gcIBAQMPVCyiAQM3Q8QCAgYeqBkEQkYuh8gEBAw9EDJIhIwdD9AICBg6IGSRSRg6H6AQEDA0AMli0jA0P0AgYCAoQdKFpGAofsBAgEBQw+ULCIBQ/cDBAIChh4oWUQChu4HCAQEDD1QsogEDN0PEAgIGHqgZBEJGLofIBAQMPRAySISMHQ/QCAgYOiBkkUkYOh+gEBAwNADJYtIwND9AIGAgKEHShaRgKH7AQIBAUMPlCwiAUP3AwQCAoYeKFlEAobuBwgEBAw9ULKIBAzdDxAICBh6oGQRCRi6HyAQEDD0QMkiEjB0P0AgIGDogZJFJGDofoBAQMDQAyWLSMDQ/QCBgIChB0oWkYCh+wECAQFDD5QsIgFD9wMEAgKGHihZRAKG7gcIBAQMPVCyiAQM3Q8QCAgYeqBkEQkYuh8gEBAw9EDJIhIwdD9AICBg6IGSRSRg6H6AQEDA0AMli0jA0P0AgYCAoQdKFpGAofsBAgEBQw+ULCIBQ/cDBAIChh4oWUQChu4HCAQEDD1QsogEDN0PEAgIGHqgZBEJGLofIBAQMPRAySISMHQ/QCAgYOiBkkUkYOh+gEBAwNADJYtIwND9AIGAgKEHShaRgKH7AQIBAUMPlCwiAUP3AwQCAoYeKFlEAobuBwgEBAw9ULKIBAzdDxAICBh6oGQRCRi6HyAQEDD0QMkiEjB0P0AgIGDogZJFJGDofoBAQMDQAyWLSMDQ/QCBgIChB0oWkcABT0wAl2KoFgwAAAAASUVORK5CYII=';
}
function count_status($where = [])
{
    $db = db_connect();
    $builder = $db->table('tb_booking_transport');
    $builder->select('count(*)');
    $builder->where($where);
    $result = $builder->countAllResults();
    return $result;
}
function selectSecurityUser()
{
    $db = connectDb('db_master.ms_user');
    $db->select("user_id AS id, CONCAT(nama, ' - (', jabatan, ')') AS text");
    $db->where('user_as', 'PTK');
    $db->whereIn('jabatan', ['Satpam']);
    $db->orderBy('nama', 'ASC');
    return $db->get()->getResult();
}
function selectArea()
{
    $db = connectDb('ms_area');
    $db->select("id_area AS id, area AS text");
    $db->orderBy('area', 'ASC');
    return $db->get()->getResult();
}
function selectShift()
{
    $db = connectDb('ms_shift');
    $db->select("id_shift AS id, shift AS text");
    $db->orderBy('shift', 'ASC');
    return $db->get()->getResult();
}
function generateKodeKejadian()
{
    $prefix = 'KE'; // Prefix for the booking code
    $currentdate = date('Ymd');

    $kode_booking = $prefix . '-' . $currentdate;

    return $kode_booking;
}
function selectBarangSecurity()
{
    $db = connectDb('ms_barang_security');
    $db->select("id_barang AS id, nama_barang AS text");
    $db->orderBy('nama_barang', 'ASC');
    return $db->get()->getResult();
}
function selectKondisiBarang()
{
    $db = connectDb('ms_barang_kondisi');
    $db->select("id_kondisi AS id, kondisi AS text");
    $db->orderBy('kondisi', 'ASC');
    return $db->get()->getResult();
}
function selectSesiMenu()
{
    $db = connectDb('ms_sesi_menu');
    $db->select("id_sesi_menu AS id, sesi_menu AS text");
    $db->orderBy('sesi_menu', 'ASC');
    return $db->get()->getResult();
}
function selectDaftarMenu()
{
    $db = connectDb('tb_daftar_menu');
    $db->select("id_menu AS id, tgl_menu AS date, CONCAT(' - ', sesi_menu, '', '(', menu_1, ' - ', menu_2, ' - ', menu_3, ' - ', menu_4, ')') AS text");
    $db->orderBy('id_menu', 'ASC');
    return $db->get()->getResult();
}
function selectUserDapur()
{
    $db = connectDb('db_master.ms_user');
    $db->select("user_id AS id, CONCAT(nama, ' - (', jabatan, ')') AS text");
    $db->where('user_as', 'PTK');
    $db->like('jabatan', 'dapur');
    $db->orderBy('user_id', 'ASC');
    return $db->get()->getResult();
}
function isMenuPagiExist($tgl_menu)
{
    $db = connectdb('tb_daftar_menu');
    $db->where('tgl_menu', $tgl_menu);
    $db->where('id_sesi_menu', 1);
    return $db->countAllResults();
}
function isMenuSiangExist($tgl_menu)
{
    $db = connectdb('tb_daftar_menu');
    $db->where('tgl_menu', $tgl_menu);
    $db->where('id_sesi_menu', 2);
    return $db->countAllResults();
}
function isMenuMalamExist($tgl_menu)
{
    $db = connectdb('tb_daftar_menu');
    $db->where('tgl_menu', $tgl_menu);
    $db->where('id_sesi_menu', 3);
    return $db->countAllResults();
}
function getJadwal($tanggal_pemakaian)
{
    $db = connectdb('ms_jadwal');
    $db->select("ms_jadwal.*, 
    (SELECT id_booking FROM tb_booking_transport 
     WHERE (ms_jadwal.start_time BETWEEN tb_booking_transport.jam_keberangkatan AND tb_booking_transport.jam_kembali) 
     AND tb_booking_transport.jam_kembali != ms_jadwal.start_time
     AND tanggal_pemakaian = '" . $tanggal_pemakaian . "') AS id_booking,
    (SELECT departemen FROM tb_booking_transport WHERE (ms_jadwal.start_time BETWEEN tb_booking_transport.jam_keberangkatan AND tb_booking_transport.jam_kembali)
    AND tb_booking_transport.jam_kembali != ms_jadwal.start_time
    AND tanggal_pemakaian = '" . $tanggal_pemakaian . "')  AS departemen,
    (SELECT tujuan FROM tb_booking_transport 
    WHERE (ms_jadwal.start_time BETWEEN tb_booking_transport.jam_keberangkatan AND tb_booking_transport.jam_kembali)
    AND tb_booking_transport.jam_kembali != ms_jadwal.start_time
    AND tanggal_pemakaian = '" . $tanggal_pemakaian . "') AS tujuan");
    $db->orderBy('ms_jadwal.id_jadwal_start');
    $db->groupBy('ms_jadwal.id_jadwal_start');
    return $db->get();
}
function getJadwalEnd($tanggal_pemakaian)
{
   $db = connectdb('ms_jadwal');
    $db->select("ms_jadwal.*, 
    (SELECT id_booking FROM tb_booking_transport 
     WHERE (ms_jadwal.end_time BETWEEN tb_booking_transport.jam_keberangkatan AND tb_booking_transport.jam_kembali) 
     AND tb_booking_transport.jam_keberangkatan != ms_jadwal.end_time
     AND tanggal_pemakaian = '" . $tanggal_pemakaian . "') AS id_booking,
    (SELECT departemen FROM tb_booking_transport WHERE (ms_jadwal.end_time BETWEEN tb_booking_transport.jam_keberangkatan AND tb_booking_transport.jam_kembali) 
    AND tb_booking_transport.jam_keberangkatan != ms_jadwal.end_time 
    AND tanggal_pemakaian = '" . $tanggal_pemakaian . "')  AS departemen,
    (SELECT tujuan FROM tb_booking_transport 
    WHERE (ms_jadwal.end_time BETWEEN tb_booking_transport.jam_keberangkatan AND tb_booking_transport.jam_kembali) 
    AND tb_booking_transport.jam_keberangkatan != ms_jadwal.end_time
    AND tanggal_pemakaian = '" . $tanggal_pemakaian . "') AS tujuan");
    $db->orderBy('ms_jadwal.id_jadwal_start');
    $db->groupBy('ms_jadwal.id_jadwal_start');
    return $db->get();
}
function selectSeragam()
{
    $db = connectdb('tb_seragam');
    $db->select("id_seragam AS id, CONCAT(departemen, ' - (', jenis_seragam, ')') AS text");
    return $db->get()->getResult();
}
function selectVendor()
{
    $db = connectdb('tb_vendor');
    $db->select("id_vendor AS id, CONCAT(vendor) AS text");
    return $db->get()->getResult();
}
function getSeragam($where = [], $order = '')
{
    $db = connectdb('tb_pemesanan_seragam');
    $db->where($where);
    $db->orderBy($order);
    $db->select('tb_pemesanan_seragam.id_seragam, tb_pemesanan_seragam.departemen, tb_pemesanan_seragam.jenis_seragam, tb_pemesanan_seragam.tgl_pemesanan, tb_pemesanan_seragam.ukuran, tb_pemesanan_seragam.jumlah_pesanan, 
    tb_pemesanan_seragam.biaya, tb_vendor.vendor,tb_pemesanan_seragam.created_by, tb_pemesanan_seragam.created_at,
    tb_pemesanan_seragam.tgl_pengiriman, tb_pemesanan_seragam.jumlah_dikirim, tb_pemesanan_seragam.sisa_pesanan, tb_pemesanan_seragam.created_pengiriman_by, 
    tb_pemesanan_seragam.created_pengiriman_at, tb_pemesanan_seragam.tgl_diterima, tb_pemesanan_seragam.jumlah_diterima, tb_pemesanan_seragam.created_terima_by, tb_pemesanan_seragam.created_terima_at,
    tb_pengambilan_seragam.tgl_pengambilan_seragam, tb_pengambilan_seragam.jumlah_ambil_seragam, tb_pengambilan_seragam.stok_seragam, tb_pengambilan_seragam.foto, tb_pengambilan_seragam.created_by, tb_pengambilan_seragam.created_at');
    $db->join('tb_seragam', 'tb_seragam.id_seragam = tb_seragam.id_seragam', 'LEFT');
    $db->join('tb_vendor', 'tb_vendor.id_vendor = tb_pemesanan_seragam.id_vendor', 'LEFT');
    $db->join('tb_pengambilan_seragam', 'tb_pengambilan_seragam.id_seragam = tb_pemesanan_seragam.id_seragam', 'LEFT');
    return $db->get();
}
function generate_kode_barang()
{
    $prefix = 'INFC'; // Prefix for the barcode
    $length = 8; // Length of the random part
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Characters to use
    $charactersLength = strlen($characters);

    $randomPart = '';
    for ($i = 0; $i < $length; $i++) {
        $randomPart .= $characters[rand(0, $charactersLength - 1)];
    }

    $kode_barang = $prefix . '-' . $randomPart;

    return $kode_barang;
}
// function generate_no_serial()
// {
//     $prefix = 'inftcpy';
//     $length = 9;

//     for ($i = 0; $i < $length; $i++) {
//         $countFormatted = str_pad($i, 2, '0', STR_PAD_LEFT);
//     }
//     $no_serial = $prefix . '-' . $countFormatted;
//     return $no_serial;
// }
