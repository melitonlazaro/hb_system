<?php 

class Main_model extends CI_Model {
			
			public function __construct() {
				parent::__construct();
			}

	public function login_mdl($username, $password)
	{
		$credentials = array('username' => $username, 'password' => $password);
		$this->db->select('*');
		$this->db->where($credentials);
		$query = $this->db->get('user_account');
		return $query->row();
	}
}
?>