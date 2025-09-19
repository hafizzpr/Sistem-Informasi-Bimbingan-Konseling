<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_auth');
		$this->login->cek_auth(); 
	}

	public function ceklogin(){
		$session = $this->session->userdata('isLogin');
    	if (($session == FALSE) || ($session == NULL))
    	{
      		$this->load->view('auth');
    	}
	}

	function index(){
		 
		 	$ambil_akun = $this->m_auth->ambil_user(
			$this->session->userdata('username'),
			$this->session->userdata('user_id'),
			$this->session->userdata('email'),
		);
	
		
		$data = array(
			'user' => $ambil_akun
		);
	
		
		$stat = $this->session->userdata('role');
	
		
		if($stat=='admin'){
			redirect('admin');
		}else if($stat=='guru'){ 
			redirect('guru');
		} else if($stat=='siswa'){ 
			redirect('siswa');
        }else { 
			redirect('auth');
		}
	}

	function login(){
		$session = $this->session->userdata('isLogin');
		if($session == FALSE){
			$this->load->view('v_login');
		}else{
			redirect('dashboard');
		}
	}

	public function logout() {
		$session_id = $this->session->userdata('session_id');
		$user_id = $this->session->userdata('user_id');
		$this->m_auth->logout_user($session_id);
		$this->m_auth->update_last_logout($user_id);
		$this->session->sess_destroy();
		redirect('auth');
	}

}