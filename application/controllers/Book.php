<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CI_Controller {


	public function index()
	{
		$this->load->model('Book_model');
		$data["guest_list"] = $this->Book_model->get_guest_profile();
		$this->load->view('employee/book', $data);
	}

	public function guest_profiling()
	{
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$middle_initial = $this->input->post('middle_initial');
		$contact_number = $this->input->post('contact_number');
		$email = $this->input->post('email');
		$date_registered = date('Y-m-d');

		$data = array(
						'guest_id' => NULL,
						'first_name' => $first_name,
						'last_name' => $last_name,
						'middle_initial' => $middle_initial,
						'contact_number' => $contact_number,
						'email' => $email,
						'date_registered' => $date_registered
					 );
		$this->load->model('Book_model');
		$result = $this->Book_model->guest_profiling_mdl($data);
		if($result)
		{
			// return $result;
			// echo json_encode(['res' => $result]);
			// exit;
			echo $result;
		}
		else
		{
			$this->db->error();
		}
	}

	public function check_email_availability()
	{
		$this->load->model('Book_model');
		$email = $this->input->post('email');
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))	
		{
			echo '<label class="text-danger">
					<span><i class="fa fa-times"></i> Email not valid </span>
				  </label>
				  ';
		}
		else
		{
			$result = $this->Book_model->check_email_availability_mdl($email);
			if($result)
			{
				echo 
				'
					<label class="text-danger">
						<span><i class="fa fa-times"></i> Email already registered. </span>
				    </label>
				';
			}
			else
			{
				echo 
				'
				<label class="text-success">
					<span><i class="fa fa-check"></i> Email is available.</span>
				</label>
				';
			}
		}
	}

	public function get_vacant_room()
	{
		$room_type = $this->input->post('room_type');
		$this->load->model('Book_model');
		$data =	$this->Book_model->get_vacant_room_mdl($room_type);
		echo json_encode($data);
	}

	public function get_room_price()
	{
		$room_type = $this->input->post('room_type');
		$this->load->model('Book_model');
		$data =	$this->Book_model->get_room_price_mdl($room_type);
		echo json_encode($data);
	}

	public function guest_accommodation()
	{
		$guest_id = $this->input->post('guest_id');
		$first_name = $this->input->post('guest_first_name');
		$last_name = $this->input->post('guest_last_name');
		$mi = $this->input->post('guest_middle_initial');
		$full_name = "$first_name $mi. $last_name";
		$cn = $this->input->post('guest_contact_number');
		$rt = $this->input->post('room_type');
		$vr = $this->input->post('vacant_room');
		$cd = $this->input->post('checkin_date');
		$ct = $this->input->post('checkin_time');
		$cod = $this->input->post('checkout_date');
		$cot = $this->input->post('checkout_time');
		$ac = $this->input->post('adult_count');
		$cc = $this->input->post('child_count');
		
		$this->load->model('Book_model');
		$data = array(
						'accommodation_id' => NULL,
						'guest_id' => $guest_id,
						'guest_name' => $full_name,
						'room_id' => $vr,
						'room_type' => $rt,
						'contact_number' => $cn,
						'adult' => $ac,
						'children' => $cc,
						'check_in_date' => $cd,
						'check_in_time' => $ct,
						'checkout_date' => $cod,
						'checkout_time' => $cot
					 );
		$result = $this->Book_model->insert_accommodation($data);
		if($result)
		{
			$this->Book_model->change_availability($rt, $vr);
			
		}
		else
		{
			$this->db->error();
		}
	}

	public function change_room_price()
	{
		$room_type = $this->input->post('room_type');
		$price_per_hour = $this->input->post('price_per_hour');
		
		$result = $this->Book_model->change_room_price_mdl($room_type, $price_per_hour);

		if($result)
		{
			$this->session->set_flashdata('price_update', 'You have successfully updated the room price.');
			redirect('Main/room_prices_setting');
		}
	}

	public function checkout()
	{
		$this->input->post('');
	}
	
	public function test()
	{
		//a function for testing
		// $room_type = "deluxe";
		// $this->load->model('Book_model');
		// $data = $this->Book_model->get_vacant_room_mdl($room_type);
		// echo json_encode($data);
		// echo json_encode($data[14]["price_per_hour"]);
		// $room_type = "flat_rate";
		// $this->load->model('Book_model');
		// $result = $this->Book_model->get_room_price_mdl($room_type);
		// print_r($result);
		$this->load->model('Book_model');
		date_default_timezone_set('Asia/Manila');
		$date_today = date('Y-m-d');
		$time_today = date('H:i');

		$data = $this->Main_model->get_today_checkout($date_today);
		print_r($data);
	}

	public function test2()
	{
		$this->load->view('for_test');
	}
}
?>