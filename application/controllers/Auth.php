<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->library('session');
        $this->load->helper('url');
		$this->load->model('m_auth');
	}

	function index() {

		$session = $this->session->userdata('isLogin');
		if ($session == FALSE) {
			$this->load->view('v_login'); 
		} else {
			redirect('dashboard');
		}
	}
	
	public function do_login() {
		$username = $this->input->post("uname");
		$password = $this->input->post("pass");

		$user = $this->m_auth->cek_user($username, $password);

		if ($user) {
			$this->m_auth->update_last_login($user['user_id']);

			if ($user['session_id'] != NULL) {
				$this->m_auth->logout_user($user['session_id']);
			}

			$new_session_id = session_id();
			$this->m_auth->update_session_id($user['user_id'], $new_session_id);

			$siswa = $this->db->get_where('siswa', ['user_id' => $user['user_id']])->row();

			$guru = $this->db->get_where('guru', ['user_id' => $user['user_id']])->row();

			$this->session->set_userdata(array(
				'isLogin'        => TRUE,
				'uname'          => $username,
				'role'           => $user['role'],
				'user_id'        => $user['user_id'],
				'session_id'     => $new_session_id,
				'current_login'  => $user['current_login'],
				'last_login'     => $user['last_login'],
				'siswa_id'       => ($siswa) ? $siswa->siswa_id : null,
				'nama_lengkap'   => ($siswa) ? $siswa->nama_lengkap : null,
				'guru_id'        => ($guru) ? $guru->guru_id : null,
				'nama_guru'      => ($guru) ? $guru->nama_guru : null,
				'status_guru'    => ($guru && isset($guru->status_guru)) ? $guru->status_guru : null
			));

			redirect('dashboard');
		} else {
			$this->session->set_flashdata('error', 'Username atau Password Salah!');
			redirect('auth');
		}
	}


}