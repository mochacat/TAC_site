<?php
class login_model extends CI_Model{
	
	public function login($email, $pass){
		
		$this->db->select('user_email, user_pass');
		$this->db->from('admin_users');
		$this->db->where('user_email', $email);
		$this->db->where('user_pass', $pass);
		
		$query = $this->db->get();
		
		if ($query->num_rows() == 1){
			return true;
		}else{
			return false;
		}
	}
}
?>