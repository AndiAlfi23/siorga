<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bendahara extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index() //peraturan keuangan / cash rule
    {
        $this->form_validation->set_rules('cash_rule', 'cash_rule', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] =  "Peraturan Keuangan";
            $data['user'] = $this->mydb->select_user($this->session->userdata('user'));
            $data['app'] = $this->mydb->orga();
            $data['cr'] = $this->mydb->cash_rule(' ');
            $this->load->view('template/header', $data);
            $this->load->view('bendahara/index', $data);
            $this->load->view('template/footer');
        } else {
            date_default_timezone_set('Asia/Jakarta');
            $time = date("Y-m-d H:i:s");
            $data = array(
                'cash_rule' => $this->input->post('cash_rule'),
                'created_at' => $time,
                'updated_at' => $time
            );
            $this->mydb->input_dt($data, 't_cash_rule');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penambahan Peraturan Keuangan Berhasil!!!</div>');
            redirect(base_url("Bendahara"));
        }
    }
    public function e_cr()
    {
        $id = $this->uri->segment(3);
        if ($id == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Peraturan keuangan tidak ada yang dipilih!!!</div>');
            redirect(base_url("Bendahara"));
        }
        $this->form_validation->set_rules('nm_cr', 'Cash Rule', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] =  "Edit Peraturan Keuangan";
            $data['user'] = $this->mydb->select_user($this->session->userdata('user'));
            $data['app'] = $this->mydb->orga();
            $data['cr'] = $this->mydb->cash_rule($id);
            $data['role'] = $this->db->get('t_role')->result_array();
            $this->load->view('template/header', $data);
            $this->load->view('bendahara/e_cr', $data);
            $this->load->view('template/footer');
        } else {
            date_default_timezone_set('Asia/Jakarta');
            $time = date("Y-m-d H:i:s");
            $data = array(
                'cash_rule' => $this->input->post('nm_cr'),
                'updated_at' => $time
            );
            $where = ['id_cr' => $id];
            $this->mydb->update_dt($where, $data, 't_cash_rule');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update Peraturan Keuangan Berhasil!!!</div>');
            redirect(base_url("Bendahara"));
        }
    }
    function del_cr()
    {
        $id = $this->uri->segment(3);
        if ($id == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Peraturan keuangan tidak ada yang dipilih!!!</div>');
            redirect(base_url("Bendahara"));
        }
        $cr = $this->mydb->getCashRule($id);
        if ($cr) {
            $where = array('id_cr' => $cr['id_cr']);
            $this->mydb->del($where, 't_cash_rule');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Peraturan Keuangan berhasil dihapus!!</div>');
            redirect(base_url("Bendahara"));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak Ada Peraturan Keuangan yang dipilih!!</div>');
            redirect(base_url("Bendahara"));
        }
    }
    //tagihan
    public function tagihan()
    {
        rules_tagihan();
        if ($this->form_validation->run() == false) {
            $data['title'] =  "Daftar Tagihan";
            $data['user'] = $this->mydb->select_user($this->session->userdata('user'));
            $data['app'] = $this->mydb->orga();
            $data['tg'] = $this->mydb->tagihan(' ');
            $this->load->view('template/header', $data);
            $this->load->view('bendahara/tagihan', $data);
            $this->load->view('template/footer');
        } else {
            $data = array(
                'nama_tagihan' => $this->input->post('nm_tg'),
                'jml_tagihan' => $this->input->post('jml_tg'),
                'created_at' => $this->input->post('cr_at'),
                'expired_at' => $this->input->post('exp')
            );
            $this->mydb->input_dt($data, 't_tagihan');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penambahan Tagihan Berhasil!!!</div>');
            redirect(base_url("Bendahara/tagihan"));
        }
    }
    public function e_tg()
    {
        $id = $this->uri->segment(3);
        if ($id == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tagihan tidak ada yang dipilih!!!</div>');
            redirect(base_url("Bendahara/tagihan"));
        }
        rules_tagihan();
        if ($this->form_validation->run() == false) {
            $data['title'] =  "Edit Tagihan";
            $data['user'] = $this->mydb->select_user($this->session->userdata('user'));
            $data['app'] = $this->mydb->orga();
            $data['tg'] = $this->mydb->tagihan($id);
            $this->load->view('template/header', $data);
            $this->load->view('bendahara/e_tg', $data);
            $this->load->view('template/footer');
        } else {
            $data = array(
                'nama_tagihan' => $this->input->post('nm_tg'),
                'jml_tagihan' => $this->input->post('jml_tg'),
                'created_at' => $this->input->post('cr_at'),
                'expired_at' => $this->input->post('exp')
            );
            $where = ['no_tg' => $id];
            $this->mydb->update_dt($where, $data, 't_tagihan');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Edit Tagihan Berhasil!!!</div>');
            redirect(base_url("Bendahara/tagihan"));
        }
    }
    function del_tg()
    {
        $no = $this->uri->segment(3);
        if ($no == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tagihan tidak ada yang dipilih!!!</div>');
            redirect(base_url("Bendahara/tagihan"));
        }
        $tg = $this->mydb->tagihan($no);
        if ($tg) {
            $where = array('no_tg' => $tg['no_tg']);
            $this->mydb->del($where, 't_tagihan_anggota');
            $this->mydb->del($where, 't_tagihan');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tagihan berhasil dihapus!!</div>');
            redirect(base_url("Bendahara/tagihan"));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak Ada Tagihan yang dipilih!!</div>');
            redirect(base_url("Bendahara/tagihan"));
        }
    }
    function del_tg_a()
    {
        $no_ta = $this->uri->segment(4);
        $no_tg = $this->uri->segment(3);
        if ($no_tg == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tagihan tidak ada yang dipilih!!!</div>');
            redirect(base_url("Bendahara/tagihan/" . $no_tg));
        }
        $ta = $this->mydb->tagihan_anggota2($no_ta);
        if ($ta) {
            $where = array('no_ta' => $no_ta);
            $this->mydb->del($where, 't_tagihan_anggota');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tagihan Anggota berhasil dihapus!!</div>');
            redirect(base_url("Bendahara/s_tg/" . $no_tg));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak Ada Tagihan Anggota yang dipilih!!</div>');
            redirect(base_url("Bendahara/s_tg/" . $no_tg));
        }
    }
    function del_pb()
    {
        $no = $this->uri->segment(3);
        if ($no == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pembayaran tidak ada yang dipilih!!!</div>');
            redirect(base_url("Member/history_pb"));
        }
        $pb = $this->mydb->s_pb($no);
        if ($pb) {
            $data['tg'] = $this->mydb->s_ta($pb['no_tg'], $pb['id_mhs']);
            $dibayar = $data['tg']['dibayar'] - $pb['nominal_bayar'];
            $data = ['dibayar' => $dibayar];
            $where1 = ['no_tg' => $pb['no_tg'], 'id_mhs' => $pb['id_mhs']];
            $where2 = ['no_pb' => $pb['no_pb']];
            $this->mydb->update_dt($where1, $data, 't_tagihan_anggota');
            $this->mydb->del($where2, 't_pembayaran');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pembayaran berhasil dihapus!!</div>');
            redirect(base_url("Member/history_pb"));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak Ada Pembayaran yang dipilih!!</div>');
            redirect(base_url("Member/history_pb"));
        }
    }
    function s_tg()
    {
        $no = $this->uri->segment(3);
        if ($no == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tagihan Anggota tidak ada yang dipilih!!!</div>');
            redirect(base_url("Bendahara/tagihan"));
        }
        $data['user'] = $this->mydb->select_user($this->session->userdata('user'));
        $data['app'] = $this->mydb->orga();
        $data['tg'] = $this->mydb->tagihan($no);
        $data['ta'] = $this->mydb->tagihan_anggota($no);
        $data['title'] = $data['tg']['nama_tagihan'];
        $data['no'] = $no;
        $data['anggota'] = $this->mydb->anggota();
        $this->load->view('template/header', $data);
        $this->load->view('bendahara/s_tg', $data);
        $this->load->view('template/footer');
    }
    function p_tg()
    {
        $no = $this->input->post('no_tg');
        $mhs = $this->input->post('id_mhs');
        if ($no == null || $mhs == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tagihan Anggota tidak ada yang dipilih!!!</div>');
            redirect(base_url("Bendahara/tagihan"));
        } else {
            $ttl = count($mhs);
            for ($i = 0; $i < $ttl; $i++) {
                $data = array(
                    'id_mhs' => $mhs[$i],
                    'no_tg' => $no,
                    'dibayar' => '0',
                    'pesan' => '0'
                );
                $this->mydb->input_dt($data, 't_tagihan_anggota');
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penambahan Tagihan Anggota Berhasil!!!</div>');
            redirect(base_url("Bendahara/s_tg/" . $no));
        }
    }
    function bayar()
    {
        $no = $this->uri->segment(3);
        $id = $this->uri->segment(4);
        if ($no == null || $id == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tagihan tidak ada yang dipilih!!!</div>');
            redirect(base_url("Bendahara/tagihan"));
        }
        $this->form_validation->set_rules('nominal', 'Nominal', 'required|trim|numeric', [
            'required' => 'Nominal bayar belum di isi',
            'numeric' => 'Nominal yang anda masukkan bukan angka'
        ]);
        if ($this->form_validation->run() == false) {
            $data['title'] =  "Proses Pembayaran";
            $data['user'] = $this->mydb->select_user($this->session->userdata('user'));
            $data['app'] = $this->mydb->orga();
            $data['ta'] = $this->mydb->s_ta($no, $id);
            $this->load->view('template/header', $data);
            $this->load->view('bendahara/i_pb', $data);
            $this->load->view('template/footer');
        } else {
            $nominal = $this->input->post('nominal');
            $cek_tg = $this->mydb->tagihan($no);
            $cek_ta = $this->mydb->cek_ta($no, $id);
            $sisa = $cek_tg['jml_tagihan'] - $cek_ta['dibayar'];
            if ($nominal > $sisa) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Nominal yang dimasukkan terlalu besar!!!</div>');
                redirect(base_url("Bendahara/bayar/" . $no . '/' . $id));
            } else {
                //input pembayaran
                $data1 = array(
                    'no_tg' => $no,
                    'id_mhs' => $id,
                    'nominal_bayar' => $nominal,
                    'tgl_bayar' => $this->input->post('tgl')
                );
                $this->mydb->input_dt($data1, 't_pembayaran');
                //update tagihan anggota
                $dibayar = $cek_ta['dibayar'] + $nominal;
                $data2 = ['dibayar' => $dibayar];
                $where = ['no_tg' => $no, 'id_mhs' => $id];
                $this->mydb->update_dt($where, $data2, 't_tagihan_anggota');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Pembayaran tagihan Berhasil!!!</div>');
                redirect(base_url("Bendahara/s_tg/" . $no));
            }
        }
    }
    //PENGELUARAN
    public function i_pk()
    {
        rules_pengeluaran();
        if ($this->form_validation->run() == false) {
            $data['title'] =  "Tambah Pengeluaran";
            $data['user'] = $this->mydb->select_user($this->session->userdata('user'));
            $data['app'] = $this->mydb->orga();
            $this->load->view('template/header', $data);
            $this->load->view('bendahara/i_pk', $data);
            $this->load->view('template/footer');
        } else {
            $data2 = array(
                'tgl_pk' => $this->input->post('tgl_pk'),
                'nama_pengeluaran' => $this->input->post('nama_pk'),
                'jml_pk' => $this->input->post('jml_pk')
            );
            $this->mydb->input_dt($data2, 't_pengeluaran');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Tambah Pengeluaran Berhasil!!!</div>');
            redirect(base_url("Member/history_pk"));
        }
    }
    function del_pk()
    {
        $no = $this->uri->segment(3);
        if ($no == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Data Pengeluaran tidak ada yang dipilih!!!</div>');
            redirect(base_url("Member/history_pk"));
        }
        $pk = $this->mydb->s_pk($no);
        if ($pk) {
            $where = ['no_pk' => $pk['no_pk']];
            $this->mydb->del($where, 't_pengeluaran');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Pengeluaran berhasil dihapus!!</div>');
            redirect(base_url("Member/history_pk"));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Tidak Ada Pengeluaran yang dipilih!!</div>');
            redirect(base_url("Member/history_pk"));
        }
    }
}
