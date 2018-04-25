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

	public function insert_accommodation($data)
	{
		$query = $this->db->insert('accommodation', $data);
		return $query;
	}

	public function change_availability($rt, $vr)
	{
		$availability = "Occupied";
		$this->db->set('availability', $availability);
		$this->db->where('room_id', $vr);
		$this->db->update($rt);
		return TRUE;
	}
}
?>