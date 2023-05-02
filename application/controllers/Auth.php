<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function index()
	{
		if ($this->session->userdata('user')) {
			redirect(base_url("Member"));
		}

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == false) {
			$data['title'] = "Login Page";
			$data['app'] = $this->mydb->orga();
			$this->load->view('template/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('template/auth_footer');
		} else {
			$this->_login();
		}
	}
	private function _login()
	{
		$username = htmlspecialchars($this->input->post('username', true));
		$password = htmlspecialchars($this->input->post('password', true));
		$user = $this->mydb->select_user($username);
		if ($user) {
			if (password_verify($password, $user['password'])) {
				$data = [
					'user' => $user['username'],
					'role_id' => $user['level'],
					'nama' => $user['nama'],
					'id_mhs' => $user['id_pmb']
				];
				$this->session->set_userdata($data);
				
				if ($user['level'] == '1') {
					redirect(base_url('Admin'));
				} else {
					redirect(base_url('Member'));
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password!!</div>');
				redirect(base_url('Auth'));
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username not is registered!</div>');
			redirect(base_url('Auth'));
		}
	}
	
	
	
	
	
	
	
	// VIEW FORGOT PASSWORD
	public function forgotPassword()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if ($this->form_validation->run() == false) {
			$data['title'] = "Lupa Password";
			$data['app'] = $this->mydb->orga();
			$this->load->view('template/auth_header', $data);
			$this->load->view('auth/forgot');
			$this->load->view('template/auth_footer');
		} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('t_anggota', ['email' => $email, 'is_active' => 1])->row_array();

			if ($user) {
				//INPUT TOKEN
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];
				$this->db->insert('t_token', $user_token);
				$this->_setEmail($token, 'forgot');

				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please check email to reset your password</div>');
				redirect(base_url('Auth/forgotPassword'));
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered or activated!</div>');
				redirect(base_url('Auth/forgotPassword'));
			}
		}
	}
	//CONFIGURASI EMAIL
	private function _setEmail($token, $type) 
	{
		$this->load->library('encrypt');
		$config = [
			'protocol' => 'smtp',
			// 'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_host' => 'smtp.gmail.com',
			'smtp_user' => 'hmifunma@gmail.com',
			'smtp_pass' => 'HMIF2020',
			'smtp_port' => '465',
			'smtp_crypto' => 'ssl',
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];

		$this->load->library('email', $config);
		$this->email->from('hmifunma@gmail.com', 'HMIF UNMA');
		$this->email->to($this->input->post('email'));

		if ($type == 'verify') {
			$this->email->subject('Account Verification');
			$this->email->message('Kepada Yth. Click this link to verify your account : <a href="' . base_url() . 'Auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activated</a>');
		} 
		else if ($type == 'forgot') {
			$this->email->subject('Reset Password');
			$this->email->message('Kepada Yth. Click this link to reset your password : <a href="' . base_url() . 'Auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activated</a>');
		}

		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}
	// LOGIKA RESET PASSWORD
	public function resetpassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('t_anggota', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('t_token', ['token' => $token])->row_array();
			if ($user_token) {
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong token!</div>');
				redirect(base_url('Auth'));
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong email!</div>');
			redirect(base_url('Auth'));
		}
	}
	// VIEW UBAH PASSWORD
	public function changePassword()
	{
		// $this->session->set_userdata('reset_email', 'Andialfi90@gmail.com');
		if (!$this->session->userdata('reset_email')) {
			redirect(base_url("Auth"));
		}
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]');
		$this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|min_length[6]|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['title'] = "Ubah Password";
			$this->load->view('template/auth_header', $data);
			$this->load->view('auth/change');
			$this->load->view('template/auth_footer');
		} else {
			$pass = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->db->set('password', $pass);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->unset_userdata('reset_email');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed! Please login!</div>');
			redirect(base_url('Auth'));
		}
		// $this->session->unset_userdata('reset_email');
	}
	
	
	
	
	
	
	
	
	
	
	//VERIFY TOKEN
	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('t_anggota', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('t_token', ['token' => $token])->row_array();
			if ($user_token) {
				if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('t_anggota');
					
					$this->db->delete('t_token', ['email' => $email]);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' has been activated</div>');
					redirect(base_url('Auth'));
				} else {
					$this->db->delete('t_angggota', ['email' => $email]);
					$this->db->delete('t_token', ['email' => $email]);
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Token expired</div>');
					redirect(base_url('Auth'));
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong token!</div>');
				redirect(base_url('Auth'));
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong email!</div>');
			redirect(base_url('Auth'));
		}
	}
	public function logout()	//LOGOUT
	{
		$this->session->unset_userdata('user');
		$this->session->unset_userdata('role_id');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('id_mhs');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						Kamu telah Logout!</div>');
		redirect(base_url('Auth'));
	}
	public function blocked()
	{
		$this->load->view('auth/blocked');
	}
}
