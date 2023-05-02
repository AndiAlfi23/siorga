<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}
	public function index()
	{
		$data['title'] =  "Dashboard";
		$data['user'] = $this->mydb->select_user($this->session->userdata('user'));
		$data['app'] = $this->mydb->orga();
		$data['cr'] = $this->mydb->cash_rule(' ');
		$data['jA'] = $this->mydb->jmlAnggota();
		$data['jK'] = $this->mydb->jmlKegiatan();
		$data['pm'] = $this->mydb->bar_pm();
		$this->load->view('template/header', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('template/footer');
	}
	public function settings()
	{
		$data['title'] =  "Pengaturan";
		$data['user'] = $this->mydb->select_user($this->session->userdata('user'));
		$data['app'] = $this->mydb->orga();
		$data['orga'] = $data['app'];
		$data['tbl'] = $this->db->get('list_table')->result_array();
		$this->form_validation->set_rules('fnama', 'Nama Organisasi', 'required', ['required' => 'Nama Organisasi Harus Diisi']);
		$this->form_validation->set_rules('snk', 'Singkatan Organisasi', 'required', ['required' => 'Singkatan Organisasi Harus Diisi']);
		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('admin/settings', $data);
			$this->load->view('template/footer');
		} else {
			$where = ['id_orga' => '1'];
			//upload logo
			$up_logo = $_FILES['logo']['name'];
			if ($up_logo) {
				$config['upload_path'] = './assets/logo/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '2048';
				$config['max_width'] 	= 1574;
				$config['max_height'] 	= 1574;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('logo')) {
					$old_logo = $data['orga']['logo'];
					if ($old_logo != 'Andi.jpg') {
						unlink(FCPATH . 'assets/logo/' . $old_logo);
					}
					$data1 = ['logo_organisasi' => $this->upload->data('file_name')];
					$this->mydb->update_dt($where, $data1, 't_orga');
				} else {
					echo $this->upload->display_errors();
				}
			}
			//upload logo topbar
			$up_img_tb = $_FILES['img_tb']['name'];
			if ($up_img_tb) {
				$config['upload_path'] = './assets/images/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '1024';
				$config['max_width'] 	= 23;
				$config['max_height'] 	= 23;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('img_tb')) {
					$old_img_tb = $data['orga']['img_topbar'];
					if ($old_img_tb != 'logo-icon.png') {
						unlink(FCPATH . 'assets/images/' . $old_img_tb);
					}
					$data2 = ['img_topbar' => $this->upload->data('file_name')];
					$this->mydb->update_dt($where, $data2, 't_orga');
				} else {
					echo $this->upload->display_errors();
				}
			}

			date_default_timezone_set('Asia/Jakarta');
			$time = date("Y-m-d H:i:s");
			$data = array(
				'nama_organisasi' => $this->input->post('fnama'),
				'singkatan_organisasi' => $this->input->post('snk'),
				'updated_at' => $time
			);
			$this->mydb->update_dt($where, $data, 't_orga');
			$this->session->set_flashdata('message', '<div class="alert alert-success" rZole="alert">App Information has been updated!!</div>');
			redirect(base_url('Admin/settings'));
		}
	}
	//Role
	public function role()
	{
		$data['title'] =  "Role Management";
		$data['user'] = $this->mydb->select_user($this->session->userdata('user'));
		$data['app'] = $this->mydb->orga();
		$data['role'] = $this->db->get('t_role')->result_array();
		$this->form_validation->set_rules('role', 'Role', 'required');
		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('admin/role', $data);
			$this->load->view('template/footer');
		} else {
			$level = $this->input->post('level');
			$cek_level = $this->mydb->select_role($level);
			if (!$cek_level) {
				$this->db->insert('t_role', [
					'level' => $level,
					'role' => $this->input->post('role')
				]);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Role added!!</div>');
				redirect(base_url('Admin/role'));
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Level Sudah Digunakan!!</div>');
				redirect(base_url('Admin/role'));
			}
		}
	}
	public function roleaccess()
	{
		$role_id = $this->uri->segment(3);
		if ($role_id == null) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Role tidak ada yang dipilih!!!</div>');
			redirect(base_url("Admin/role"));
		}
		$data['title'] =  "Role Access";
		$data['user'] = $this->mydb->select_user($this->session->userdata('user'));
		$data['app'] = $this->mydb->orga();
		$data['role'] = $this->db->get_where('t_role', ['level' => $role_id])->row_array();
		$this->db->where('id_menu !=', 1);
		$data['tmenu'] = $this->db->get('t_menu')->result_array();
		$this->load->view('template/header', $data);
		$this->load->view('admin/role-access', $data);
		$this->load->view('template/footer');
	}
	public function changeaccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'level' => $role_id,
			'id_menu' => $menu_id
		];

		$result = $this->db->get_where('t_menu_access', $data);

		if ($result->num_rows() < 1) {
			$this->db->insert('t_menu_access', $data);
		} else {
			$this->db->delete('t_menu_access', $data);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!!</div>');
	}
	function e_role()
	{
		$id = $this->uri->segment(3);
		if ($id == null) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Role tidak ada yang dipilih!!!</div>');
			redirect(base_url("Admin/role"));
		}
		$this->form_validation->set_rules('level', 'Level', 'required');
		$this->form_validation->set_rules('role', 'Role', 'required');
		if ($this->form_validation->run() == false) {
			$data['title'] =  "Edit Role";
			$data['user'] = $this->mydb->select_user($this->session->userdata('user'));
			$data['app'] = $this->mydb->orga();
			$data['role'] = $this->mydb->select_role($id);
			$this->load->view('template/header', $data);
			$this->load->view('admin/e_role', $data);
			$this->load->view('template/footer');
		} else {
			$data = array(
				'level' => $this->input->post('level'),
				'role' => $this->input->post('role'),
			);
			$where = ['level' => $id];
			$this->mydb->update_dt($where, $data, 't_role');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update Role Berhasil!!!</div>');
			redirect(base_url("Admin/role"));
		}
	}
	function e_lvl()
	{
		$npm = $this->uri->segment(3);
		if ($npm == null) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anggota tidak ada yang dipilih!!!</div>');
			redirect(base_url("Member/anggota"));
		}
		$this->form_validation->set_rules('level', 'Level', 'required');
		if ($this->form_validation->run() == false) {
			$data['title'] =  "Edit Level";
			$data['user'] = $this->mydb->select_user($this->session->userdata('user'));
			$data['app'] = $this->mydb->orga();
			$data['anggota'] = $this->mydb->select_user($npm);
			$data['role'] = $this->db->get('t_role')->result_array();
			$this->load->view('template/header', $data);
			$this->load->view('admin/e_lvl', $data);
			$this->load->view('template/footer');
		} else {
			$data = ['level' => $this->input->post('level')];
			$where = ['npm' => $npm];
			$this->mydb->update_dt($where, $data, 't_anggota');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update Level Berhasil!!!</div>');
			redirect(base_url("Member/s_anggota/" . $npm));
		}
	}
	//Menu
	public function menu()
	{
		$data['title'] =  "Controller Management";
		$data['user'] = $this->mydb->select_user($this->session->userdata('user'));
		$data['app'] = $this->mydb->orga();
		$data['menu'] = $this->mydb->getMenu();
		$this->form_validation->set_rules('menu', 'Menu', 'required');
		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('menu/index', $data);
			$this->load->view('template/footer');
		} else {
			$this->db->insert('t_menu', ['menu' => $this->input->post('menu')]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Controller baru berhasil ditambahkan!!</div>');
			redirect(base_url('Admin/menu'));
		}
	}
	public function submenu()
	{
		$data['title'] =  "Menu Management";
		$data['user'] = $this->mydb->select_user($this->session->userdata('user'));
		$data['app'] = $this->mydb->orga();
		$data['subm'] = $this->mydb->getSubMenu();
		$data['men'] = $this->db->get('t_menu')->result_array();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('menu_id', 'Menu', 'required');
		$this->form_validation->set_rules('url', 'URL', 'required');
		$this->form_validation->set_rules('icon', 'icon', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('menu/submenu', $data);
			$this->load->view('template/footer');
		} else {
			$data = [
				'title' => $this->input->post('title'),
				'id_menu' => $this->input->post('menu_id'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => '0'
			];
			$this->db->insert('t_sub_menu', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu baru berhasil ditambahkan!!</div>');
			redirect(base_url('Admin/submenu'));
		}
	}
	function s_submenu($id, $s)
	{
		$data = ['is_active' => $s];
		$where = ['id_sm' => $id];
		$d = $this->mydb->select_submenu($id);
		$this->mydb->update_dt($where, $data, 't_sub_menu');
		if ($s == '1') {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu ' . $d['title'] . ' di Aktifkan!!</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Submenu ' . $d['title'] . ' di Matikan!!</div>');
		}
		redirect(base_url('Admin/submenu'));
	}
	function e_submenu()
	{
		$id = $this->uri->segment(3);
		if ($id == null) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Menu tidak ada yang dipilih!!!</div>');
			redirect(base_url("Admin/submenu"));
		}
		$data['title'] =  "Edit Menu";
		$data['user'] = $this->mydb->select_user($this->session->userdata('user'));
		$data['app'] = $this->mydb->orga();
		$data['subm'] = $this->mydb->select_submenu($id);
		$data['men'] = $this->db->get('t_menu')->result_array();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('menu_id', 'Menu', 'required');
		$this->form_validation->set_rules('url', 'URL', 'required');
		$this->form_validation->set_rules('icon', 'icon', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('menu/e_submenu', $data);
			$this->load->view('template/footer');
		} else {
			$data = [
				'title' => $this->input->post('title'),
				'id_menu' => $this->input->post('menu_id'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon')
			];
			$where = ['id_sm' => $id];
			$this->mydb->update_dt($where, $data, 't_sub_menu');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update Data Menu berhasil!!</div>');
			redirect(base_url('Admin/submenu'));
		}
	}
	public function icon_mdi()
	{
		$data['title'] =  "ICON MDI";
		$data['user'] = $this->mydb->select_user($this->session->userdata('user'));
		$data['app'] = $this->mydb->orga();

		$this->load->view('template/header', $data);
		$this->load->view('menu/icon-mdi', $data);
		$this->load->view('template/footer');
	}
	//HAPUS
	function del_role()
	{
		$id = $this->uri->segment(3);
		if ($id == null) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Role tidak ada yang dipilih!!!</div>');
		}
		$role = $this->mydb->select_role($id);
		if ($role) {
			if ($role['level'] == '1') {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Role Admin tidak boleh dihapus!!</div>');
			} else {
				$where = array('level' => $id);
				$cek_user = $this->db->query("SELECT count(id_mhs) as jml FROM t_anggota WHERE level='$id'")->row_array();
				if ($cek_user['jml'] > 0) {
					$data = [
						'level' => '0'
					];
					$this->mydb->update_dt($where, $data, 't_anggota');
				}
				$this->mydb->del($where, 't_role');
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role berhasil dihapus!!</div>');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak Ada Role yang dipilih!!</div>');
		}
		redirect(base_url("Admin/role"));
	}
	function del_menu()
	{
		$id = $this->uri->segment(3);
		if ($id == null) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Controller tidak ada yang dipilih!!!</div>');
		}
		$menu = $this->mydb->select_menu($id);
		if ($menu) {
			if ($menu['menu'] == 'Admin') {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Controller Admin Tidak boleh dihapus!!</div>');
			} else {
				$where = array('id_menu' => $id);
				$this->mydb->del($where, 't_menu');
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Controller berhasil dihapus!!</div>');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak Ada Controller yang dipilih!!</div>');
		}
		redirect(base_url("Admin/menu"));
	}
	function del_submenu()
	{
		$id = $this->uri->segment(3);
		if ($id == null) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">SubMenu tidak ada yang dipilih!!!</div>');
		}
		$smenu = $this->mydb->select_submenu($id);
		if ($smenu) {
			$where = array('id_sm' => $id);
			$this->mydb->del($where, 't_sub_menu');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub Menu berhasil dihapus!!</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak Ada Sub Menu yang dipilih!!</div>');
		}
		redirect(base_url("Admin/submenu"));
	}
	function del_user()
	{
		$id = $this->uri->segment(3);
		if ($id == null) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Anggota tidak ada yang dipilih!!!</div>');
			redirect(base_url("Admin/settings"));
		}
		$ag = $this->db->query("SELECT count(id_mhs) as jml,username FROM t_anggota WHERE level='0' AND id_mhs='$id'")->row_array();
		if ($ag['jml'] > 0) {
			$where = array('id_mhs' => $id);
			$cek_absen = $this->db->query("SELECT count(no_absen) as jml FROM t_absen WHERE id_mhs='$id'")->row_array();
			if ($cek_absen['jml'] > 0) {
				$this->mydb->del($where, 't_absen');
			}
			$cek_tagihan = $this->db->query("SELECT count(no_ta) as jml FROM t_tagihan_anggota WHERE id_mhs='$id'")->row_array();
			if ($cek_tagihan['jml'] > 0) {
				$this->mydb->del($where, 't_pembayaran');
				$this->mydb->del($where, 't_tagihan_anggota');
			}
			$cek_history = $this->db->query("SELECT count(id_history) as jml FROM t_history WHERE username='$id'")->row_array();
			if ($cek_history['jml'] > 0) {
				$where = array('id_history' => $ag['username']);
				$this->mydb->del($where, 't_history');
			}
			$this->mydb->del($where, 't_anggota');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Anggota berhasil dihapus <b>Permanen</b>!!</div>');
			redirect(base_url("Admin/settings"));
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak Ada Data Anggota yang dipilih!!</div>');
			redirect(base_url("Admin/settings"));
		}
	}
	//TRUNCATE
	public function truncate()
	{
		$table = $this->uri->segment('3');
		if ($table == 't_history' || $table == 't_pengeluaran' || $table == 't_cash_rule' || $table == 't_absen') {
			$this->mydb->truncate($table);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data ' . $table . ' berhasil dikosongkan!!!</div>');
		} else if ($table == 't_kegiatan') {
			$cek_absen = $this->db->query('select count(no_absen) as jml from t_absen')->row_array();
			if ($cek_absen['jml'] == '0') {
				$this->mydb->truncate($table);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Kegiatan berhasil dikosongkan!!!</div>');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Kegiatan tidak bisa dikosongkan!!!, karena masih terdapat Data Absensi !!!</div>');
			}
		} else if ($table == 't_pembayaran') {
			$this->db->query("UPDATE t_tagihan_anggota SET dibayar='0' ");
			$this->mydb->truncate($table);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pemabayaran berhasil dikosongkan!!!</div>');
		} else if ($table == 't_tagihan_anggota') {
			$cek_pb = $this->db->query('select count(no_pb) as jml from t_pembayaran')->row_array();
			if ($cek_pb['jml'] == '0') {
				$this->mydb->truncate($table);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Tagihan Anggota berhasil dikosongkan!!!</div>');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Tagihan Anggota tidak bisa dikosongkan!!!, karena masih terdapat Data Pembayaran !!!</div>');
			}
		} else if ($table == 't_tagihan') {
			$cek_ta = $this->db->query('select count(no_ta) as jml from t_tagihan_anggota')->row_array();
			if ($cek_ta['jml'] == '0') {
				$this->mydb->truncate($table);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Tagihan berhasil dikosongkan!!!</div>');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Tagihan tidak bisa dikosongkan!!!, karena masih terdapat Data Tagihan Anggota !!!</div>');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data ' . $table . ' tidak bisa dikosongkan!!!</div>');
		}
		redirect(base_url("Admin/settings"));
	}
}
