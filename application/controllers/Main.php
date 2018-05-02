<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('login');
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));

		$login_result = $this->Main_model->login_mdl($username, $password);
		if($login_result)
		{
			$user_name = $login_result->name;
			$account_type = $login_result->account_type;
			$account_id = $login_result->account_id;
			$session_data = array(
									'account_id' => $account_id,
									'username' => $username,
									'name' => $user_name,
									'account_type' => $account_type
								 );
			$this->session->set_userdata($session_data);
			$activity = "Logged in";
			$activity_id = "N/A";
			$this->Main_model->insert_activity_log($activity, $activity_id);

			if($account_type === "Admin")
			{
				redirect('Main/admin_dashboard');
				// $this->load->view('admin/admin_dashboard');	
			}
			elseif($account_type === "Employee")
			{
				redirect('Main/employee_dashboard');
				// $this->load->view('employee/employee_dashboard');
			}
		}	
		else
		{
			$this->session->flashdata('login_error', 'Login failed.');
			redirect('Main');
		}
	}

	public function logout()
  	{
  		$activity = "Logged out";
		$activity_id = "N/A";
		$this->Main_model->insert_activity_log($activity, $activity_id);
    	$this->session->unset_userdata('username');
    	$this->session->unset_userdata('name');
      	redirect('Main');
 	}

	public function admin_dashboard()
	{
		$data["fr_count"] = $this->Main_model->count_vacant_fr();
		$data["fr_total"] = $this->Main_model->count_all_fr();
		$data["deluxe_count"] = $this->Main_model->count_vacant_deluxe();
		$data["deluxe_total"] = $this->Main_model->count_all_deluxe();
		$data["sd_count"] = $this->Main_model->count_vacant_sd();
		$data["sd_total"] = $this->Main_model->count_all_sd();
		$data["fr_details"] = $this->Main_model->get_flat_rate();
		$data["deluxe_details"] = $this->Main_model->get_deluxe();
		$data["sd_details"] = $this->Main_model->get_super_deluxe();
		$data["accommodation"] = $this->Main_model->get_accommodation();
		$data["recent_checkout"] = $this->Main_model->get_recent_checkouts();
		date_default_timezone_set('Asia/Manila');
		$date_today = date('Y-m-d');
		$data["co_details"] = $this->Main_model->get_today_checkout($date_today);
		$this->load->view('admin/admin_dashboard', $data);
	}

	public function employee_dashboard()
	{
		$data["fr_count"] = $this->Main_model->count_vacant_fr();
		$data["fr_total"] = $this->Main_model->count_all_fr();
		$data["deluxe_count"] = $this->Main_model->count_vacant_deluxe();
		$data["deluxe_total"] = $this->Main_model->count_all_deluxe();
		$data["sd_count"] = $this->Main_model->count_vacant_sd();
		$data["sd_total"] = $this->Main_model->count_all_sd();
		$data["fr_details"] = $this->Main_model->get_flat_rate();
		$data["deluxe_details"] = $this->Main_model->get_deluxe();
		$data["sd_details"] = $this->Main_model->get_super_deluxe();
		$data["accommodation"] = $this->Main_model->get_accommodation();
		$data["recent_checkout"] = $this->Main_model->get_recent_checkouts();
		date_default_timezone_set('Asia/Manila');
		$date_today = date('Y-m-d');
		$data["co_details"] = $this->Main_model->get_today_checkout($date_today);
		$this->load->view('employee/employee_dashboard', $data);
	}

	public function room_prices_setting()
	{
		$data["fr_price"] = $this->Main_model->get_fr_price();
		$data["deluxe_price"] = $this->Main_model->get_deluxe_price();
		$data["sd_price"] = $this->Main_model->get_sd_price();
		$this->load->view('admin/price_setting', $data);
	}

	public function list_of_checkout()
	{
		$data["all_co"] = $this->Main_model->get_all_checkout();
		$this->load->view('checkout',$data);
	}

	public function create_soa($checkout_id)
	{
		$data["co_details"] = $this->Main_model->get_checkout_details($checkout_id);
		// print_r($data);
		$this->load->view('report/statement_of_account', $data);
	}

	public function activity_log()
	{
		$data["activity_log"] = $this->Main_model->activity_log_mdl();
		$this->load->view('admin/activity_log', $data);
	}

	public function activity_log_report_all()
	{
		$data["ac_records"] = $this->Main_model->ac_report_all_mdl();
		$this->load->view('report/activity_log_report', $data);
	}

	public function activity_log_selected_report()
	{
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$data["ac_records"] = $this->Main_model->ac_report_selected_mdl($from_date, $to_date);
		$this->load->view('report/activity_log_report', $data, $from_date, $to_date);
	}

}
?>