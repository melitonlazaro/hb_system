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
		$query = $this->db->get();
		return $query->result();
	}

	public function get_recent_checkouts()
	{
		$this->db->select('*');
		$this->db->from('checkout');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result(); 
	}

	public function get_all_checkout()
	{
		$this->db->select('*');
		$this->db->from('checkout');
		$query = $this->db->get();
		return $query->result(); 
	}

	public function get_checkout_details($checkout_id)
	{
		$this->db->select('*');
		$this->db->where('checkout_id', $checkout_id);
		$this->db->from('checkout');
		$query = $this->db->get();
		return $query->row();
	}

	public function activity_log_mdl()
	{
		$this->db->select('*');
		$this->db->from('activity_log');
		$query = $this->db->get();
		return $query->result(); 
	}

	public function insert_activity_log($activity, $activity_id)
	{
		$employee_id = $this->session->userdata('account_id');
		$employee_name = $this->session->userdata('name');
		$account_type = $this->session->userdata('account_type');
		date_default_timezone_set('Asia/Manila');
		$date = date('Y-m-d');
		$time = date('H:i');
		$data = array(
						'log_id' => NULL,
						'employee_id' => $employee_id,
						'employee_name' => $employee_name,
						'account_type' => $account_type,
						'activity' => $activity,
						'activity_id' => $activity_id,
						'date' => $date,
						'time' => $time
					 );
		$this->db->insert('activity_log', $data);

	}

	public function ac_report_all_mdl()
	{
		$this->db->select('*');
		$this->db->from('activity_log');
		$query = $this->db->get();
		return $query->result();
	}

	public function ac_report_selected_mdl($from_date, $to_date)
	{
		$this->db->select('*');
		$this->db->where('date >=', $from_date);
		$this->db->where('date <=', $to_date);
		$this->db->from('activity_log');
		$query = $this->db->get();
		return $query->result();
	}
}
?>