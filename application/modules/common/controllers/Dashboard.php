<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct() {
		parent::__construct();
		if (!$this->session->userdata('reg_id')) {
			return redirect(base_url('login'));
		}
	}
	public function index() {
		$this->load->view('theme/theme_header');
		$this->load->view('theme/theme_sidebar');
		$this->load->view('theme/theme_index');
		$this->load->view('theme/theme_footer');
	}
}
