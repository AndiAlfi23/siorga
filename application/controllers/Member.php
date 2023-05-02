<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}
	public function index() //dashboard member
	{
		$data['title'] =  "Dashboard";
		$data['user'] = $this->mydb->select_user($this->session->userdata('user'));
		$data['app'] = $this->mydb->orga();
		$data['cr'] = $this->mydb->cash_rule(' ');
		$data['jA'] = $this->mydb->jmlAnggota();
		$data['jK'] = $this->mydb->jmlKegiatan();
		$data['pm'] = $this->mydb->bar_pm();
		//akses tagihan anggota
		$lvl = $this->session->userdata('role_id');
		$query = $this->db->get_where('t_menu', ['menu' => 'Bendahara'])->row_array();
		$userAccess = $this->db->get_where('t_menu_access', [
			'level' => $lvl, 'id_menu' => $query['id_menu']
		]);
		$data['UA'] = $userAccess;
		$data['nggk'] = $this->mydb->nunggak();
		$this->load->view('template/header', $data);
		$this->load->view('user/index', $data);
		$this->load->view('template/footer');
	}
	public function anggota()
	{
		$data['title'] =  "Data Anggota";
		$data['user'] = $this->mydb->select_user($this->session->userdata('user'));
		$data['app'] = $this->mydb->orga();
		$data['anggota'] = $this->mydb->anggota();
		$lvl = $this->session->userdata('role_id');
		$menu = $this->db->get_where('t_menu', ['menu' => 'Anggota'])->row_array(); //Menu anggota
		$userAccess = $this->db->get_where('t_menu_access', [
			'level' => $lvl, 'id_menu' => $menu['id_menu']
		]);
		$data['UA'] = $userAccess;
		$this->load->view('template/header', $data);
		$this->load->view('user/anggota', $data);
		$this->load->view('template/footer');
	}
	public function s_anggota()
	{
		$npm = $this->uri->segment(3);
		if ($npm == null) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anggota tidak ada yang dipilih!!!</div>');
			redirect(base_url("Member/anggota"));
		}
		$data['user'] = $this->mydb->select_user($this->session->userdata('user'));
		$data['app'] = $this->mydb->orga();
		$data['t_user'] = $this->mydb->select_user($npm);
		$data['title'] =  $data['t_user']['nama'];
		$data['absen'] = $this->mydb->selectAbsen($npm);
		$data['tAbsen'] = $this->db->query("select count(no_kegiatan) as total_absen 
								from t_absen a, t_anggota b 
								where a.id_mhs = b.id_mhs
								and b.npm='" . $npm . "'")->row_array();
		$data['tHadir'] = $this->db->query("select count(no_kegiatan) as total_hadir
								from t_absen a, t_anggota b 
								where a.id_mhs = b.id_mhs
								and status='Hadir' 
								and b.npm='" . $npm . "'")->row_array();
		$lvl = $this->session->userdata('role_id');
		$query1 = $this->db->get_where('t_menu', ['menu' => 'Admin'])->row_array();
		$userAccess1 = $this->db->get_where('t_menu_access', [
			'level' => $lvl, 'id_menu' => $query1['id_menu']
		]);
		$query2 = $this->db->get_where('t_menu', ['menu' => 'Anggota'])->row_array();
		$userAccess2 = $this->db->get_where('t_menu_access', [
			'level' => $lvl, 'id_menu' => $query2['id_menu']
		]);
		$data['UA1'] = $userAccess1;
		$data['UA2'] = $userAccess2;
		$this->load->view('template/header', $data);
		$this->load->view('user/s_anggota', $data);
		$this->load->view('template/footer');
	}
	public function kegiatan()
	{
		$data['title'] =  "Kegiatan";
		$data['user'] = $this->mydb->select_user($this->session->userdata('user'));
		$data['app'] = $this->mydb->orga();
		$data['kegiatan'] = $this->mydb->kegiatan(' ');
		$lvl = $this->session->userdata('role_id');
		$menu = $this->db->get_where('t_menu', ['menu' => 'Kegiatan'])->row_array(); //Menu anggota
		$userAccess = $this->db->get_where('t_menu_access', [
			'level' => $lvl, 'id_menu' => $menu['id_menu']
		]);
		$data['UA'] = $userAccess;
		$this->load->view('template/header', $data);
		$this->load->view('user/kegiatan', $data);
		$this->load->view('template/footer');
	}
	public function detail_kegiatan($no)
	{
		$data['title'] =  "Detail Kegiatan";
		$data['user'] = $this->mydb->select_user($this->session->userdata('user'));
		$data['app'] = $this->mydb->orga();
		$data['kegiatan'] = $this->mydb->getKegiatan($no);
		
		$data['hadir'] = $this->mydb->getHadir($no);
		$data['no_hadir'] = $this->mydb->getNonHadir($no);
		$data['total'] = $this->mydb->totalAbsen($no);
		$data['jml'] = $this->mydb->jmlAnggota();
		$data['total_no_hadir'] = $this->mydb->totalNonHadir($no);
		
		$lvl = $this->session->userdata('role_id');
		$query = $this->db->get_where('t_menu', ['menu' => 'Kegiatan'])->row_array();
		$userAccess = $this->db->get_where('t_menu_access', [
			'level' => $lvl, 'id_menu' => $query['id_menu']
		]);
		$data['UA'] = $userAccess;
		$this->load->view('template/header', $data);
		$this->load->view('user/absen', $data);
		$this->load->view('template/footer');
	}
	//PROFILE
	public function profile()
	{
		$npm = $this->session->userdata('user');
		$data['title'] =  "My Profile";
		$data['user'] = $this->mydb->select_user($npm);
		$data['app'] = $this->mydb->orga();
		$data['absen'] = $this->mydb->selectAbsen($npm);
		$data['tAbsen'] = $this->db->query("select count(no_kegiatan) as total_absen 
								from t_absen a, t_anggota b 
								where a.id_mhs = b.id_mhs
								and b.npm='" . $npm . "'")->row_array();
		$data['tHadir'] = $this->db->query("select count(no_kegiatan) as total_hadir
								from t_absen a, t_anggota b 
								where a.id_mhs = b.id_mhs
								and status='Hadir' 
								and b.npm='" . $npm . "'")->row_array();
		$this->load->view('template/header', $data);
		$this->load->view('user/profile', $data);
		$this->load->view('template/footer');
	}
	public function edit()
	{
		$data['title'] =  "Edit Profile";
		$data['user'] = $this->mydb->select_user($this->session->userdata('user'));
		$data['app'] = $this->mydb->orga();
		rules_edit_anggota();
		$this->load->view('template/header', $data);
		$this->load->view('user/edit', $data);
		$this->load->view('template/footer');
	}
	function p_e_anggota()
	{
		$data['user'] = $this->mydb->select_user($this->session->userdata('user'));
		$where = ['username' => $this->session->userdata('user')];
		$upload_image = $_FILES['image']['name'];
		if ($upload_image) {
			$config['upload_path'] = './assets/images/users/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']     = '2048';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {
				$old_image = $data['user']['picture'];
				if ($old_image != '1.jpg') {
					unlink(FCPATH . 'assets/images/users/' . $old_image);
				}
				$data = ['picture' => $this->upload->data('file_name')];
				$this->mydb->update_dt($where, $data, 't_anggota');
			} else {
				echo $this->upload->display_errors();
			}
		}
		date_default_timezone_set('Asia/Jakarta');
		$time = date("Y-m-d H:i:s");
		$data = array(
			'npm' => $this->input->post('npm'),
			'nama' => $this->input->post('fnama'),
			'email' => $this->input->post('email'),
			'telp' => $this->input->post('telp'),
			'alamat' => $this->input->post('alamat'),
			'update_at' => $time
		);
		$this->mydb->update_dt($where, $data, 't_anggota');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!!</div>');
		redirect(base_url('Member/profile'));
	}
	public function changepassword()
	{
		$data['title'] =  "Change Password";
		$data['user'] = $this->mydb->select_user($this->session->userdata('user'));
		$data['app'] = $this->mydb->orga();
		$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
		$this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]');
		$this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]');

		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('user/changepassword', $data);
			$this->load->view('template/footer');
		} else {
			$current = $this->input->post('current_password');
			$new = $this->input->post('new_password1');
			if (!password_verify($current, $data['user']['password'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!!</div>');
				redirect(base_url('Member/changepassword'));
			} else {
				if ($current == $new) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New Password cannot be the same as current password!!</div>');
					redirect(base_url('Member/changepassword'));
				} else {
					$password_hash = password_hash($new, PASSWORD_DEFAULT);
					$this->db->set('password', $password_hash);
					$this->db->where('username', $this->session->userdata('user'));
					$this->db->update('t_anggota');
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Changed!!</div>');
					redirect(base_url('Member/changepassword'));
				}
			}
		}
	}
	// histori login
	// public function history()
	// {
		// $npm = $this->session->userdata('user');
		// $data['title'] =  "Histori Login";
		// $data['user'] = $this->mydb->select_user($npm);
		// $data['app'] = $this->mydb->orga();
		// $data['login'] = $this->mydb->getHistory($npm, ' ');
		// $lvl = $this->session->userdata('role_id');
		// $query = $this->db->get_where('t_menu', ['menu' => 'Kegiatan'])->row_array();
		// $userAccess = $this->db->get_where('t_menu_access', [
			// 'level' => $lvl, 'id_menu' => $query['id_menu']
		// ]);
		// $data['UA'] = $userAccess;
		// $this->load->view('template/header', $data);
		// $this->load->view('user/history_login', $data);
		// $this->load->view('template/footer');
	// }
	
	// tagihan
	public function history_tg()
	{
		$npm = $this->session->userdata('user');
		$data['title'] =  "Histori Tagihan";
		$data['user'] = $this->mydb->select_user($npm);
		$data['app'] = $this->mydb->orga();
		$data['tg'] = $this->mydb->s_tagihan($npm);
		$this->load->view('template/header', $data);
		$this->load->view('bendahara/histori_tagihan', $data);
		$this->load->view('template/footer');
	}
	public function history_pb()
	{
		$npm = $this->session->userdata('user');
		$lvl = $this->session->userdata('role_id');
		$data['title'] =  "Histori Pembayaran";
		$data['user'] = $this->mydb->select_user($npm);
		$data['app'] = $this->mydb->orga();
		$query = $this->db->get_where('t_menu', ['menu' => 'Bendahara'])->row_array();
		$userAccess = $this->db->get_where('t_menu_access', [
			'level' => $lvl, 'id_menu' => $query['id_menu']
		]);
		if ($userAccess->num_rows() < 1) {
			$data['pb'] = $this->mydb->s_pembayaran($npm);
		} else {
			$data['pb'] = $this->mydb->s_pembayaran('no');
		}
		$data['UA'] = $userAccess;
		$this->load->view('template/header', $data);
		$this->load->view('bendahara/histori_pembayaran', $data);
		$this->load->view('template/footer');
	}
	public function history_pk()
	{
		$npm = $this->session->userdata('user');
		$data['title'] =  "Histori Pengeluaran";
		$data['user'] = $this->mydb->select_user($npm);
		$data['app'] = $this->mydb->orga();
		$lvl = $this->session->userdata('role_id');
		$query = $this->db->get_where('t_menu', ['menu' => 'Bendahara'])->row_array();
		$userAccess = $this->db->get_where('t_menu_access', [
			'level' => $lvl, 'id_menu' => $query['id_menu']
		]);
		$data['UA'] = $userAccess;
		$data['pb'] = $this->mydb->pengeluaran();
		$this->load->view('template/header', $data);
		$this->load->view('bendahara/histori_pengeluaran', $data);
		$this->load->view('template/footer');
	}
	public function about()
	{
		$npm = $this->session->userdata('user');
		$data['title'] =  "Tentang";
		$data['user'] = $this->mydb->select_user($npm);
		$data['app'] = $this->mydb->orga();
		$this->load->view('template/header', $data);
		$this->load->view('template/about', $data);
		$this->load->view('template/footer');
	}
}
