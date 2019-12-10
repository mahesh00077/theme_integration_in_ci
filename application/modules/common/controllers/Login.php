<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

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
	public function __construct() {
		parent::__construct();
		$this->load->model('Login_model');
	}
	// login page show
	public function index() {
		$sess_items = array('reg_id', 'username', 'mobile_no', 'email_id');
		$this->session->unset_userdata($sess_items);
		$this->form_validation->set_rules('ume', 'U/M/E', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[10]');
		if ($this->form_validation->run() == true) {
			$username = $this->input->post('ume');
			$password = $this->input->post('password');
			$remember_me = $this->input->post('remember_me');

			$result = $this->Login_model->getByData($username);
			if ($result) {
				$hash = $result->password;
				$this->session->set_userdata('reg_id', $result->id);
				if (password_verify($password, $hash)) {
					$newdata = array(
						// 'id' => $result->id,
						'username' => $result->username,
						'mobile_no' => $result->mobile_no,
						'email_id' => $result->email_id,

					);

					$this->session->set_userdata($newdata);
					if ($this->session->has_userdata('reg_id') && $this->session->has_userdata('email_id') && $this->session->has_userdata('username')) {
						/*if($remember_me==1)
							{

								$cookie=array(
									'name' => 'remember_me_token',
									'value' => '122',
									'expire' => time()+15,
									'domain' => base_url(),
									// 'path' => '/',
									 );
								setcookie($cookie);
						*/

						$data_lg = array(
							'last_login' => date('Y-m-d H:i:s'),
							// 'remember_me' => $remember_me ? $remember_me : 0,
						);
						$res = $this->Login_model->update_last_login($result->id, $data_lg);
						if ($res) {
							// $this->logactivity->add_activity($_SESSION['lu_id'], "login", "Successfully Logged In");
							$this->session->set_flashdata('success', "Successfully Logged In");
							return redirect(base_url());
						} else {
							$this->session->set_flashdata('error', "Something Went Wrong.Please try again");
							return redirect(base_url('login'));
						}
					}
				} else {
					$this->session->set_flashdata('error', "Invalid Password Please check it");
					return redirect(base_url('login'));
				}
			} else {
				// $this->session->set_flashdata('error', "Something Went Wrong.Please try again");
				$this->session->set_flashdata('error', "Invalid Credentials Please check it");
				return redirect(base_url('login'));
			}
		}
		$this->load->view('login/login_header');
		$this->load->view('login/login_index');
		$this->load->view('login/login_footer');
	}
	// logout
	public function logout() {
		// $this->logactivity->add_activity($_SESSION['lu_id'], "logout", "Logged Out Successfully");
		$this->session->sess_destroy();
		return redirect(base_url('login'));
	}
	// register page show
	public function register_page() {
		$this->load->view('login/login_header');
		$this->load->view('login/login_register');
		$this->load->view('login/login_footer');
	}
	// register page data insert
	public function add_register() {
		$this->form_validation->set_rules('name', 'Full Name', 'trim|alpha_numeric_spaces|required');
		$this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|numeric|required|max_length[10]');
		$this->form_validation->set_rules('email_id', 'Email id', 'trim|required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric_spaces|max_length[10]|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[10]|min_length[3]');
		$this->form_validation->set_rules('c_password', 'Confirm Password', 'trim|required|max_length[10]|min_length[3]|matches[password]');

		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('error', "fdfdgdfg");
			// return redirect(base_url('register'));
		} else {
			$password = crypt($this->input->post('password'), '143ci');
			$data = array(
				'name' => $this->input->post('name'),
				'mobile_no' => $this->input->post('mobile_no'),
				'email_id' => $this->input->post('email_id'),
				'username' => $this->input->post('username'),
				'password' => $password,
				'status' => 1,
				'created_at' => date('Y-m-d H:i:s'),
			);
			$result = $this->Login_model->add($data);
			if ($result) {
				$this->session->set_flashdata('success', "Registerd Successfully!");
				return redirect(base_url('register'));
			} else {
				$this->session->set_flashdata('error', "Failed to Register! Please Try Again.");
				return redirect(base_url('register'));
			}

		}
		$this->load->view('login/login_header');
		$this->load->view('login/login_register');
		$this->load->view('login/login_footer');

	}
	public function forgot_page() {
		$this->load->view('login/login_header');
		$this->load->view('login/login_forgot');
		$this->load->view('login/login_footer');
	}
}
