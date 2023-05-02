<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        rules_jabatan();
        if ($this->form_validation->run() == false) {
            $data['title'] =  "Jabatan";
            $data['user'] = $this->mydb->select_user($this->session->userdata('user'));
            $data['app'] = $this->mydb->orga();
            $data['jabatan'] = $this->mydb->jabatan();
            $this->load->view('template/header', $data);
            $this->load->view('admin/jabatan', $data);
            $this->load->view('template/footer');
        } else {
            $data = array(
                'nama_jabatan' => $this->input->post('nm_jabatan'),
            );
            $this->mydb->input_dt($data, 't_jabatan');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penambahan Jabatan Berhasil!!!</div>');
            redirect(base_url("Jabatan"));
        }
    }
    public function e_jabatan($id)
    {
        rules_jabatan();
        if ($this->form_validation->run() == false) {
            $data['title'] =  "Edit Jabatan";
            $data['user'] = $this->mydb->select_user($this->session->userdata('user'));
            $data['app'] = $this->mydb->orga();
            $data['jabatan'] = $this->mydb->getJabatan($id);
            $data['role'] = $this->db->get('t_role')->result_array();
            $this->load->view('template/header', $data);
            $this->load->view('admin/e_jabatan', $data);
            $this->load->view('template/footer');
        } else {
            $data = array(
                'nama_jabatan' => $this->input->post('nm_jabatan')
            );
            $where = ['id_jabatan' => $id];
            $this->mydb->update_dt($where, $data, 't_jabatan');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update Jabatan Berhasil!!!</div>');
            redirect(base_url("Jabatan"));
        }
    }
    function del_jabatan($id)
    {
        $jabatan = $this->mydb->getJabatan($id);
        if ($jabatan) {
            $where = array('id_jabatan' => $jabatan['id_jabatan']);
            $this->mydb->del($where, 't_jabatan');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jabatan berhasil dihapus!!</div>');
            redirect(base_url("Jabatan"));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak Ada jabatan yang dipilih!!</div>');
            redirect(base_url("Jabatan"));
        }
    }
}
