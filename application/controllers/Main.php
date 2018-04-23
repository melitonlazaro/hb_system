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
			$session_data = array(
									'username' => $username,
									'name' => $user_name,
									'account_type' => $account_type
								 );
			$this->session->set_userdata($session_data);
			if($account_type === "Admin")
			{
				$this->load->view('admin/admin_dashboard');	
			}
			elseif($account_type === "Employee")
			{
				$this->load->view('employee/employee_dashboard');
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
    	$this->session->unset_userdata('username');
    	$this->session->unset_userdata('name');
      	redirect('Main');
 	}

	public function admin_dashboard()
	{
		$this->load->view('admin/admin_dashboard');
	}
}
