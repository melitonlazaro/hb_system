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

	public function count_vacant_fr()
	{
		$availability = "Available";
		$this->db->select('*');
		$this->db->from('flat_rate');
		$this->db->where("availability", $availability);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_fr()
	{
		$this->db->select('*');
		$this->db->from('flat_rate');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_vacant_deluxe()
	{
		$availability = "Available";
		$this->db->select('*');
		$this->db->from('deluxe');
		$this->db->where("availability", $availability);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_deluxe()
	{
		$this->db->select('*');
		$this->db->from('deluxe');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_vacant_sd()
	{
		$availability = "Available";
		$this->db->select('*');
		$this->db->from('super_deluxe');
		$this->db->where("availability", $availability);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_sd()
	{
		$this->db->select('*');
		$this->db->from('super_deluxe');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_flat_rate()
	{
		$this->db->select('*');
		$this->db->from('flat_rate');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_deluxe()
	{
		$this->db->select('*');
		$this->db->from('deluxe');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_super_deluxe()
	{
		$this->db->select('*');
		$this->db->from('super_deluxe');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_accommodation()
	{
		$this->db->select('*');
		$this->db->from('accommodation');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_fr_price()
	{
		$this->db->select('*');
		$this->db->from('flat_rate');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_deluxe_price()
	{
		$this->db->select('*');
		$this->db->from('deluxe');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_sd_price()
	{
		$this->db->select('*');
		$this->db->from('super_deluxe');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_today_checkout($date_today)
	{
		$this->db->select('*');
		$this->db->from('accommodation');
		$this->db->where('checkout_date', $date_today);
		$query = $this->db->get();
		return $query->result();
	}

}
?>