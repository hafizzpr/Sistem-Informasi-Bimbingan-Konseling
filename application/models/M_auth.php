<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_auth extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->tbl = "users";
	}
	
	public function update_session_id($user_id, $session_id) {
		$data = array('session_id' => $session_id);
		$this->db->where('user_id', $user_id);
		$this->db->update('users', $data);
	}

	public function logout_user($session_id) {
		$data = array('session_id' => NULL);
		$this->db->where('session_id', $session_id);
		$this->db->update('users', $data);
	}

	function cek_user($username="", $password="", $status_akun="1") {
		
		$query = $this->db->get_where($this->tbl, array('username' => $username, 'status_akun' => $status_akun));
		$user = $query->row_array(); 
		
		if ($user) {
			
			if (password_verify($password, $user['password'])) {
				return $user; 
			} else {
				return false; 
			}
		}
		
		return false; 
	}
	

	  function ambil_user($username, $email, $user_id) {
		
		$query = $this->db->get_where($this->tbl, array(
			'username' => $username,
			'user_id'  => $user_id,
			'email'  => $email
		));
	
		
		$result = $query->result_array();
	
		
		if (!empty($result)) {
			return $result[0];
		} else {
			
			return null; 
		}
	}

	public function update_last_login($user_id) {
		$this->db->where('user_id', $user_id)
		->update('users', ['current_login' => date('Y-m-d H:i:s')]);
	}

	public function update_last_logout($user_id) {
		$this->db->where('user_id', $user_id)
		->update('users', ['last_login' => date('Y-m-d H:i:s')]);
	}
	
}