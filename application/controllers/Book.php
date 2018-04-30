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
		$this->load->library('form_validation');
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$middle_initial = $this->input->post('middle_initial');
		$contact_number = $this->input->post('contact_number');
		$date_of_birth = $this->input->post('date_of_birth');
		$email = $this->input->post('email');
		$date_registered = date('Y-m-d');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|is_unique[guest_profile.email]');
		$this->load->helper('email');
		if(valid_email($email))
		{
			$this->load->model('Book_model');
			if($email_result)
			{
				$data = array(
						'guest_id' => NULL,
						'first_name' => $first_name,
						'last_name' => $last_name,
						'middle_initial' => $middle_initial,
						'contact_number' => $contact_number,
						'date_of_birth' => $date_of_birth,
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
			else
			{
				$this->session->set_flashdata('taken_email', 'Email already taken. Please enter another email.');
				redirect('Book');
			}
		}	
		else
		{
			$this->sessin->set_flashdata('invalid_email', 'Invalid email. Please enter a valid email');
			redirect('Book');
		}
	}

	public function email_form_validation()
	{
		$this->load->library('form_validation');
		$this->load->helper('email');
		$email = $this->input->post('email');
			$this->form_validation->set_rules('email', 'Email', 'is_unique[guest_profile.email]');
			if($this->form_validation->run() == FALSE)
			{
				// $validates = validation_errors();
				$validates = 1;
			}
			else
			{
				$validates = 0;
			}
			echo $validates;
			exit;
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
			$availability = "Occupied";
			$this->Book_model->change_availability($rt, $vr, $availability);
			
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
		$acc_id = $this->input->post('accommodation_id');
		$acc_gid = $this->input->post('acc_guest_id');
		$acc_gn = $this->input->post('acc_guest_name');
		$acc_rmid =$this->input->post('acc_room_id');
		$acc_rt = $this->input->post('acc_room_type');
		$acc_adult = $this->input->post('acc_adult');
		$acc_children = $this->input->post('acc_children');
		$acc_ci_date = $this->input->post('acc_ci_date');
		$acc_ci_time = $this->input->post('acc_ci_time');
		$acc_co_date = $this->input->post('acc_co_date');
		$acc_co_time = $this->input->post('acc_co_time');
		$acc_pph = $this->input->post('acc_price_per_hour');
		$acc_tp = $this->input->post('acc_total_price');

		$data = array(
						'checkout_id' => NULL,
						'accommodation_id' => $acc_id,
						'guest_id' => $acc_gid,
						'guest_name' => $acc_gn,
						'room_type' => $acc_rt,
						'room_id' => $acc_rmid,
						'price_per_hour' => $acc_pph,
						'adult' => $acc_adult,
						'children' => $acc_children,
						'check_in_date' => $acc_ci_date, 
						'check_in_time' => $acc_ci_time,
						'checkout_date' => $acc_co_date,
						'checkout_time' => $acc_co_time,
						'total_price'	=> $acc_tp,
					 );
		$this->load->model('Book_model');
		$result =$this->Book_model->checkout_mdl($data);
		 
		if($result)
		{
			$result1 = $this->Book_model->remove_accommodation($acc_id);
			if($result1)
			{
				$rt = $acc_rt;
				$vr = $acc_rmid;
				$availability = "Available";
				$result2 = $this->Book_model->change_availability($rt, $vr, $availability);
				if($result2)
				{
					redirect('Main/admin_dashboard');
				}
				else
				{
					exit;
				}
			}
			else
			{
				exit;
			}
		}
		else
		{
			exit;
		}
		
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
		// $this->load->model('Book_model');
		// date_default_timezone_set('Asia/Manila');
		// $date_today = date('Y-m-d');
		// $time_today = date('H:i');

		// $data = $this->Main_model->get_today_checkout($date_today);
		// print_r($data);
		$email = $this->input->post('email');
		$this->load->helper('email');
		if(valid_email($email))
		{
			$this->load->model('Book_model');
			$result = $this->Book_model->check_email_availability_mdl($email);
			if($result)
			{
				echo "Email already taken. please enter another email.";
			}
			else
			{
				echo "valid email";
			}
		}
		else
		{
			echo "invalid email";
		}
	}

	public function test2()
	{
		$this->load->view('for_test');
	}
}
?>