<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('user')) {
        redirect(base_url("Auth"));
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment('1');

        $queryMenu = $ci->db->get_where('t_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id_menu'];

        $userAccess = $ci->db->get_where('t_menu_access', [
            'level' => $role_id,
            'id_menu' => $menu_id
        ]);
        if ($userAccess->num_rows() < 1) {
            redirect(base_url("Auth/blocked"));
        }
    }
}
function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('level', $role_id);
    $ci->db->where('id_menu', $menu_id);
    $result = $ci->db->get('t_menu_access');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
function rules_jabatan()
{
    $ieu = get_instance();
    $ieu->form_validation->set_rules('nm_jabatan', 'nm_jabatan', 'required|trim', [
        'required' => 'Nama Jabatan tidak boleh kosong'
    ]);
}
function rules_anggota()
{
    $ieu = get_instance();
    $ieu->form_validation->set_rules('npm', 'NPM', 'required|trim|is_unique[t_anggota.npm]', [
        'required' => 'NPM tidak boleh kosong',
        'is_unique' => 'NPM sudah digunakan'
    ]);
    $ieu->form_validation->set_rules('fnama', 'Nama Lengkap', 'required|trim|is_unique[t_anggota.nama]', [
        'required' => 'Nama tidak boleh kosong',
        'is_unique' => 'Nama sudah digunakan'
    ]);
    $ieu->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim', [
        'required' => 'Jabatan tidak boleh kosong'
    ]);
}
function rules_edit_anggota()
{
    $ieu = get_instance();
    $ieu->form_validation->set_rules('npm', 'NPM', 'required|trim', [
        'required' => 'NPM tidak boleh kosong'
    ]);
    $ieu->form_validation->set_rules('fnama', 'Nama Lengkap', 'required|trim', [
        'required' => 'Nama tidak boleh kosong'
    ]);
    $ieu->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim', [
        'required' => 'Jabatan tidak boleh kosong'
    ]);
    $ieu->form_validation->set_rules('email', 'Email', 'trim|valid_email', [
        'is_unique' => 'Email sudah dipakai!!!',
        'valid_email' => 'Tidak sesuai dengan format email'
    ]);
    $ieu->form_validation->set_rules('telp', 'Nomor Telepon', 'required|trim', [
        'required' => 'Nomor Telepon tidak boleh kosong'
    ]);
    $ieu->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
        'required' => 'Alamat tidak boleh kosong'
    ]);
}
function rules_kegiatan()
{
    $ieu = get_instance();
    $ieu->form_validation->set_rules('tgl', 'Tanggal', 'required|trim', [
        'required' => 'Tanggal Kegiatan tidak boleh kosong'
    ]);
    $ieu->form_validation->set_rules('kegiatan', 'Nama Kegiatan', 'required|trim', [
        'required' => 'Nama Kegiatan tidak boleh kosong'
    ]);
}
function rules_tagihan()
{
    $ieu = get_instance();
    $ieu->form_validation->set_rules('nm_tg', 'Nama Tagihan', 'required|trim', ['required' => 'Nama Tagihan Tidak Boleh Kosong']);
    $ieu->form_validation->set_rules('jml_tg', 'Jumlah Tagihan', 'required|trim|numeric', [
        'required' => 'Jumlah Tagihan Tidak Boleh Kosong',
        'numeric' => 'Jumlah Tagihan harus berupa numeric / bilangan'
    ]);
    $ieu->form_validation->set_rules('cr_at', 'Tanggal Pembuatan', 'required|trim', ['required' => 'Tanggal Pembuatan Tidak Boleh Kosong']);
    $ieu->form_validation->set_rules('exp', 'Expired', 'required|trim', ['required' => 'Expired Tidak Boleh Kosong']);
}
function rules_pengeluaran()
{
    $ieu = get_instance();
    $ieu->form_validation->set_rules('tgl_pk', 'Tanggal Pengeluaran', 'required|trim', ['required' => 'Tanggal Pengeluaran Tidak Boleh Kosong']);
    $ieu->form_validation->set_rules('nama_pk', 'Nama Pengeluaran', 'required|trim', ['required' => 'Nama Pengeluaran Tidak Boleh Kosong']);
    $ieu->form_validation->set_rules('jml_pk', 'Jumlah Pengeluaran', 'required|trim|numeric', [
        'required' => 'Jumlah Pengeluaran Tidak Boleh Kosong',
        'numeric' => 'Jumlah Pengeluaran harus berupa numeric / bilangan'
    ]);
}
