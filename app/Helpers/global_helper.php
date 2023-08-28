<?php

function _tempHTML($view, $data = [])
{
    $data_tmp = [];
    $username = _session('username');
    $user     = getUser(['username' => $username, 'is_aktif' => 1])->getRow();

    if ($user) {
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
function getUser($where = [], $order = '')
{
    $db = connectdb('ms_user');
    $db->where($where);
    $db->orderBy($order);
    $db->join('ms_role', 'ms_role.role = ms_user.role');
    $db->join('db_master.ms_user', 'db_master.ms_user.user_id = ms_user.master_id');
    return $db->get();
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
function selectRole()
{
    $db = connectDb('ms_role');
    $db->select('role AS id, role AS text');
    $db->where(['role !=' => 'Developer']);
    $db->orderBy('role', 'ASC');
    return $db->get()->getResult();
}
function selectJabatan()
{
    $db = connectdb('ms_jabatan');
    $db->select('jabatan AS id, jabatan AS text');
    $db->orderBy('jabatan', 'ASC');
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
