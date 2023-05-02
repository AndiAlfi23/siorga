<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggota extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['title'] =  "Tambah Anggota";
        $data['user'] = $this->mydb->select_user($this->session->userdata('user'));
        $data['app'] = $this->mydb->orga();
        $data['jabatan'] = $this->mydb->jabatan();
        rules_anggota();
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('user/tambah_anggota', $data);
            $this->load->view('template/footer');
        } else {
            $npm = $this->input->post('npm');
            date_default_timezone_set('Asia/Jakarta');
            $time = date("Y-m-d H:i:s");
            $data = array(
                'username' => $npm,
                'password' => password_hash($npm, PASSWORD_DEFAULT),
                'level' => '4',
                'npm' => $npm,
                'picture' => '1.jpg',
                'nama' => strtoupper($this->input->post('fnama')),
                'id_jabatan' => $this->input->post('jabatan'),
                'created_at' => $time,
                'update_at' => $time,
                'is_active' => '1'
            );
            $this->mydb->input_dt($data, 't_anggota');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penambahan Data Anggota Berhasil!!!</div>');
            redirect(base_url("Member/anggota"));
        }
    }
    function del($id)
    {
        $user = $this->mydb->select_user($id);
        if ($user) {
            date_default_timezone_set('Asia/Jakarta');
            $time = date("Y-m-d H:i:s");
            $where = array('npm' => $id);
            $data = array(
                'level' => '0',
                'update_at' => $time
            );
            $this->mydb->update_dt($where, $data, 't_anggota');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Anggota berhasil dihapus!!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Tidak Ada Anggota yang dipilih!!</div>');
        }
        redirect(base_url("Member/anggota"));
    }
    function e_jabatan()
    {
        $npm = $this->uri->segment(3);
        if ($npm == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anggota tidak ada yang dipilih!!!</div>');
            redirect(base_url("Member/anggota"));
        }
        $data['title'] =  "Edit Jabatan";
        $data['user'] = $this->mydb->select_user($this->session->userdata('user'));
        $data['app'] = $this->mydb->orga();
        $data['anggota'] = $this->mydb->select_user($npm);
        $data['role'] = $this->db->get('t_jabatan')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('user/e_jabatan', $data);
        $this->load->view('template/footer', $data);
    }
    function p_e_jabatan()
    {
        $npm = $this->uri->segment(3);
        if ($npm == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anggota tidak ada yang dipilih!!!</div>');
            redirect(base_url("Member/anggota"));
        }
        date_default_timezone_set('Asia/Jakarta');
        $time = date("Y-m-d H:i:s");
        $data = [
            'id_jabatan' => $this->input->post('jabatan'),
            'update_at' => $time
        ];
        $where = ['id_mhs' => $this->input->post('id_mhs')];
        $this->mydb->update_dt($where, $data, 't_anggota');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update Level Berhasil!!!</div>');
        redirect(base_url("Member/s_anggota/" . $npm));
    }
}
