<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login {


	public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->library('session');
        $this->ci->load->helper('url');
    }
	
	public function proteksi_login()
	{
		$this->ci =& get_instance();
		if ($this->ci->session->userdata('isLogin') == '' );
			$this->ci->session->userdata('role') == ''; {
			$this->ci->session->set_flashdata('error', 'Anda Belum Login');
			redirect('auth');
		}
	}

	public function cek_auth(){
		$this->ci =& get_instance();
		$this->sesi = $this->ci->session->userdata('isLogin');
		$this->hak = $this->ci->session->userdata('role');
		if($this->sesi != TRUE ){
		redirect('auth','refresh');
			exit();
		}
	}

	public function cek_akses($required_level)
    {
        $user_level = $this->ci->session->userdata('role');
        if ($user_level != $required_level) {
            echo "<script>alert('Anda tidak berhak mengakses halaman ini!');</script>";
            redirect('dashboard');
            exit();
        }
    }
}