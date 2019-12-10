<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unzip extends MY_Controller {

	public function __construct() {

		parent::__construct();
		if (!$this->session->userdata('reg_id')) {
			return redirect(base_url('login'));
		}
	}
	public function index() {
		$this->form_validation->set_rules('prj_name', 'Project Name', 'required');
		$this->form_validation->set_rules('sidebar_start', 'Sidebar Start', 'required');
		$this->form_validation->set_rules('sidebar_end', 'Sidebar End', 'required');
		if (empty($_FILES['file']['name'])) {
			$this->form_validation->set_rules('file', 'Upload Zip File', 'required');
		}

		if ($this->form_validation->run() == true) {
			// $this->session->set_flashdata('error', "Please fill below fields!!!");
			// } else {
			$prj_name = $this->input->post('prj_name');
			$sidebar_start = $this->input->post('sidebar_start');
			$sidebar_end = $this->input->post('sidebar_end');
			$this->load->helper('cpdir');
			$src = $_SERVER['DOCUMENT_ROOT'] . "/ci_atoz/"; //set ur current prj path
			$dst = $_SERVER['DOCUMENT_ROOT'] . "/" . $prj_name . "/"; //set destination path
			if (!file_exists($dst)) {
				mkdir($dst, 0777);
				chmod($dst, 0777);
			}
			copy_directory($src, $dst);
			$scan = scandir($dst);
			foreach ($scan as $ch_forf) {
				if ($ch_forf == 'application') {
					if (is_dir($ch_forf)) {
						$scan2 = scandir($ch_forf);
						foreach ($scan2 as $ch_forf2) {
							if ($ch_forf2 == 'modules') {
								$scan3 = scandir($ch_forf . '/' . $ch_forf2);
								foreach ($scan3 as $ch_forf3) {
									if ($ch_forf3 != '.' && $ch_forf3 != '..') {
										if ($ch_forf3 != 'common') {
											$path = $dst . '/' . $ch_forf . '/' . $ch_forf2 . '/' . $ch_forf3;
											deleteDir($path);
										}
									}
								}

							}

						}

					}
				}
			}
			// exit();

			if (!empty($_FILES['file']['name'])) {
				// Set preference
				$config['upload_path'] = 'uploads/';
				$config['allowed_types'] = 'zip';
				$config['max_size'] = '31457280'; // max_size in kb (30 MB)
				$config['file_name'] = $_FILES['file']['name'];

				// Load upload library
				$this->load->library('upload', $config);

				// File upload
				if ($this->upload->do_upload('file')) {
					// Get data about the file
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];

					## Extract the zip file ---- start
					$zip = new ZipArchive;
					$res = $zip->open("uploads/" . $filename);
					if ($res === TRUE) {
						$assets_folder = $dst . "/assets/";
						if (!file_exists($assets_folder)) {
							mkdir($assets_folder, 0777);
							chmod($assets_folder, 0777);
						}
						// Unzip path
						$extractpath = $assets_folder;

						// Extract file
						$zip->extractTo($extractpath);
						// chmod($zipp, 0777);
						$zip->close();
						// exit();
						unlink($dst . "application/modules/common/views/theme/theme_header.php");
						unlink($dst . "application/modules/common/views/theme/theme_sidebar.php");
						unlink($dst . "application/modules/common/views/theme/theme_index.php");
						unlink($dst . "application/modules/common/views/theme/theme_footer.php");
						unlink($dst . "application/modules/common/controllers/Dashboard.php");
						// exit();
						$paths = $assets_folder . "index.html";
						chmod($dst, 0777);
						sortoutFilesByHtmlfile($paths, $dst, $sidebar_start, $sidebar_end);
						$header_path = $dst . "application/modules/common/views/theme/dashboard_header.php";
						$footer_path = $dst . "application/modules/common/views/theme/dashboard_footer.php";
						$configfile_path = $dst . "application/config/config.php";
						$dashboardCtller_path = $dst . "application/modules/common/controllers/Dashboard.php";
						addTxtinLinkTag($header_path);
						addTxtinScriptTag($footer_path);
						addConfigFile($configfile_path, $prj_name);
						newDashboardCreate($dashboardCtller_path);
						// exit();
						chmod($dst, 0777);

						$this->session->set_flashdata('success', 'Upload & Extract successfully.');
						return redirect(base_url('import-zip'));
					} else {
						$this->session->set_flashdata('error', 'Failed to extract.');
						return redirect(base_url('import-zip'));
					}
					## ---- end
				} else {
					$this->session->set_flashdata('error', 'Failed to upload');
					return redirect(base_url('import-zip'));
				}
			} else {
				$this->session->set_flashdata('error', 'Failed to upload');
				return redirect(base_url('import-zip'));
			}
		}

		$this->load->view('common/theme/theme_header');
		$this->load->view('common/theme/theme_sidebar');
		$this->load->view('index');
		$this->load->view('common/theme/theme_footer');
	}

}
