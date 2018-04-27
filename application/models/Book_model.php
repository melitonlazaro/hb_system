<?php 
	
class Book_model extends CI_Model {

		public function __construct() {
			parent::__construct();
		}

	public function get_guest_profile()
	{
		$this->db->select('*');
		$this->db->from('guest_profile');
		$query = $this->db->get();
		return $query->result();
	}

	public function guest_profiling_mdl($data)
	{
		$this->db->insert('guest_profile', $data);
		return $this->db->insert_id();
	}

	public function get_vacant_room_mdl($room_type)
	{
		$response = array();
		$availability = "Available";
		$this->db->select('*');
		$this->db->from($room_type);
		$this->db->where('availability', $availability);
		$query = $this->db->get();
		$response = $query->result_array();
		return $response;
	}

	public function get_room_price_mdl($room_type)
	{
		$response = array();
		$this->db->select('price_per_hour');
		$this->db->from($room_type);
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function insert_accommodation($data)
	{
		$query = $this->db->insert('accommodation', $data);
		return $query;
	}

	public function change_availability($rt, $vr, $availability)
	{
		$this->db->set('availability', $availability);
		$this->db->where('room_id', $vr);
		$this->db->update($rt);
		return TRUE;
	}

	public function change_room_price_mdl($room_type, $price_per_hour)
	{
		$this->db->set('price_per_hour', $price_per_hour);
		$result = $this->db->update($room_type);
		return $result;
	}

	public function checkout_mdl($data)
	{
		$query = $this->db->insert('checkout', $data);
		return $query;
	}

	public function remove_accommodation($acc_id)
	{
		$data = array('accommodation_id' => $acc_id);
		$query = $this->db->delete('accommodation', $data);
		return $query;
	}

	public function check_email_availability_mdl($email)
	{
		$this->db->select('*');
		$this->db->from('guest_profile');
		$query = $this->db->where('email', $email);
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


}
?>