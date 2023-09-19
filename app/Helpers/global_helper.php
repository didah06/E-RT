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
                $view       != 'user/index'
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
            return view('login/index', $data_tmp);
        }
    } else {
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
function getData($table, $where = [], $order = '', $select = '*')
{
    $db             = \Config\Database::connect();
    $builder        = $db->table($table);
    $builder->select($select);
    $builder->where($where);
    $builder->orderBy($order);
    return $builder;
}
function getAccess()
{
    $uri        = current_url(true);
    $num        = 0;
    $url        = $uri->getSegment(2);
    $menu       = getData('ms_menu', ['links LIKE "%(' . $url . ')%"' => null, 'is_aktif' => 1])->get();
    $submenu    = getData('ms_menu_sub', ['links LIKE "%(' . $url . ')%"' => null, 'is_aktif' => 1])->get();

    if (count($menu->getResult()) > 0) {
        $num        += getData('tb_access_menu', ['id_menu' => $menu->getRow()->id, '(role = "' . _session('role') . '" OR id_user =' . _session('id') . ')' => null])->countAllResults();
    }
    if (count($submenu->getResult()) > 0) {
        $num        += getData('tb_access_menu', ['id_menu' => $menu->getRow()->id, '(role = "' . _session('role') . '" OR id_user =' . _session('id') . ')' => null])->countAllResults();
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
    $db->where("role NOT IN ('Driver', 'Satpam', 'Dapur')");
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
            $menu = getData('ms_menu', ['is_aktif' => 1, 'ms_menu.id IN(1,2,3)' => null], 'sort ASC')->get()->getResult();
        } elseif ($segmen == 'sistem_manajemen') {
            $menu = getData('ms_menu', ['is_aktif' => 1, 'ms_menu.id IN(4,5,6,7,8)' => null], 'sort ASC')->get()->getResult();
        } else {
            $db = connectDb('ms_menu');
            $db->select('ms_menu.*');
            $db->join('tb_access_menu', 'id_menu = ms_menu.id');
            if ($segmen == 'user_pengguna') {
                $db->where(['ms_menu.id IN(1,2,3)' => null]);
            } else if ($segmen == 'sistem_manajemen') {
                $db->where(['ms_menu.id IN(4,5,6,7,8)' => null]);
            }
            $db->where(['role = "' . session('role') . '" OR id_user = ' . session('id') . ')' => null, 'is_aktif' => 1]);
            $db->groupBy('id_menu');
            $db->orderBy('sort ASC');
            $menu = $db->get()->getResult();
        }
        return $menu;
    }
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
        $db->join('tb_access_menu', 'tb_access_menu.id_sub_menu = ms_menu_sub.id');
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
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Characters to use

    $randomPart = '';
    for ($i = 0; $i < $length; $i++) {
        $randomPart .= $characters[rand(0, strlen($characters) - 1)];
    }

    $kode_booking = $prefix . '-' . $randomPart;

    return $kode_booking;
}
