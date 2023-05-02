<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['title'] =  "Tambah Kegiatan";
        $data['user'] = $this->mydb->select_user($this->session->userdata('user'));
        $data['app'] = $this->mydb->orga();
        rules_kegiatan();
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('user/tambah_kegiatan', $data);
            $this->load->view('template/footer');
        } else {
            $data = array(
                'tgl_kegiatan' => $this->input->post('tgl'),
                'nama_kegiatan' => $this->input->post('kegiatan')
            );
            $this->mydb->input_dt($data, 't_kegiatan');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penambahan Data Kegiatan Berhasil!!!</div>');
            redirect(base_url("Member/kegiatan"));
        }
    }
    function e_kegiatan($no)
    {
        $data['title'] =  "Edit Kegiatan";
        $data['user'] = $this->mydb->select_user($this->session->userdata('user'));
        $data['app'] = $this->mydb->orga();
        rules_kegiatan();
        $data['k'] = $this->mydb->selectKegiatan($no);
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('user/e_kegiatan', $data);
            $this->load->view('template/footer');
        } else {
            $data = array(
                'tgl_kegiatan' => $this->input->post('tgl'),
                'nama_kegiatan' => $this->input->post('kegiatan')
            );
            $where = ['no_kegiatan' => $no];
            $this->mydb->update_dt($where, $data, 't_kegiatan');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Kegiatan Berhasil di Ubah!!!</div>');
            redirect(base_url("Member/detail_kegiatan/" . $no));
        }
    }
    public function absensi($no)
    {
        $total = $this->mydb->totalAbsen($no);
        $jml = $this->mydb->jmlAnggota();
        if ($total['total'] != $jml['jmlAnggota']) {
            $data['title'] =  "Proses Absensi";
            $data['user'] = $this->mydb->select_user($this->session->userdata('user'));
            $data['app'] = $this->mydb->orga();
            $data['kegiatan'] = $this->mydb->getKegiatan($no);
            $data['anggota'] = $this->mydb->anggota();
            $this->load->view('template/header', $data);
            $this->load->view('user/proses_absen', $data);
            $this->load->view('template/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Proses Absensi sudah dilakukan!!</div>');
            redirect(base_url('Member/detail_kegiatan/' . $no));
        }
    }
    function proses_absensi()
    {
        $kegiatan = $this->input->post('kegiatan');
        $mhs = $this->input->post('mhs');
        $status = $this->input->post('status');
        $ttl = count($mhs);
        for ($i = 0; $i < $ttl; $i++) {
            $data = array(
                'no_kegiatan' => $kegiatan,
                'id_mhs' => $mhs[$i],
                'status' => $status[$i]
            );
            $this->mydb->input_dt($data, 't_absen');
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Proses Absensi Berhasil!!</div>');
        redirect(base_url('Member/detail_kegiatan/' . $kegiatan));
    }
    public function scan()
    {
        $no = $this->uri->segment('3');
        $data['title'] =  "Scan QR-Code";
        $data['user'] = $this->mydb->select_user($this->session->userdata('user'));
        $data['app'] = $this->mydb->orga();
        $data['hadir'] = $this->mydb->getHadir($no);
        $data['no_hadir'] = $this->mydb->getNonHadir($no);
        $data['total'] = $this->mydb->totalAbsen($no);
        $data['total_no_hadir'] = $this->mydb->totalNonHadir($no);
        $lvl = $this->session->userdata('role_id');
        $query = $this->db->get_where('t_menu', ['menu' => 'Kegiatan'])->row_array();
        $userAccess = $this->db->get_where('t_menu_access', [
            'level' => $lvl, 'id_menu' => $query['id_menu']
        ]);
        $data['UA'] = $userAccess;
        $this->load->view('template/header', $data);
        $this->load->view('user/scan', $data);
        $this->load->view('template/footer');
    }
    function hasil_scan()
    {
        $no = $this->uri->segment('3');
        $id_mhs = $this->input->post('no_qr');
        $kegiatan = $this->db->get_where('t_kegiatan', ['no_kegiatan' => $no])->row_array();
        if ($kegiatan) {
            $cek_mhs = $this->db->get_where('t_anggota', ['id_mhs' => $id_mhs])->row_array();
            if ($cek_mhs) {
                $data = [
                    'no_kegiatan' => $no,
                    'id_mhs' => $id_mhs,
                    'status' => 'Hadir'
                ];
                $this->db->insert('t_absen', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    <h4><strong>' . $cek_mhs['nama'] . '</strong> Hadir !!</h4></div>');
                redirect(base_url('Kegiatan/scan/' . $no));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    <h4><strong>QR-Code</strong> tidak terdaftar !!</h4></div>');
                redirect(base_url('Kegiatan/scan/' . $no));
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                <h4><strong>Kegiatan</strong> Tidak Terdaftar !!!</h4></div>');
            redirect(base_url('Member/Kegiatan'));
        }
    }
    function e_absen($no, $id)
    {
        $data['title'] =  "Edit Absen";
        $data['user'] = $this->mydb->select_user($this->session->userdata('user'));
        $data['app'] = $this->mydb->orga();
        rules_kegiatan();
        $data['k'] = $this->mydb->editAbsen($no, $id);
        $this->load->view('template/header', $data);
        $this->load->view('user/e_absen', $data);
        $this->load->view('template/footer');
    }
    function p_e_absen($no, $id)
    {
        $data = array(
            'status' => $this->input->post('status')
        );
        $where = ['no_kegiatan' => $no, 'id_mhs' => $id];
        $this->mydb->update_dt($where, $data, 't_absen');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Absen Berhasil di Ubah!!!</div>');
        redirect(base_url("Member/detail_kegiatan/" . $no));
    }
    function del($id)
    {
        $kegiatan = $this->mydb->getKegiatan($id);
        if ($kegiatan) {
            $where = array('no_kegiatan' => $id);
            $this->mydb->del($where, 't_absen');
            $this->mydb->del($where, 't_kegiatan');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kegiatan berhasil dihapus!!</div>');
            redirect(base_url("Member/kegiatan"));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak Ada Kegiatan yang dipilih!!</div>');
            redirect(base_url("Member/kegiatan"));
        }
    }
    function del_absen($no, $id)
    {
        $kegiatan = $this->mydb->getKegiatan($no);
        if ($kegiatan) {
            $where = array('no_kegiatan' => $no, 'id_mhs' => $id);
            $this->mydb->del($where, 't_absen');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Salah satu data kehadiran mahasiswa berhasil dihapus!!</div>');
            redirect(base_url("Member/detail_kegiatan/" . $no));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak Ada Kegiatan yang dipilih!!</div>');
            redirect(base_url("Member/detail_kegiatan/" . $no));
        }
    }
}
