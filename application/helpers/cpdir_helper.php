<?php

function copy_directory($src, $dst) {
	$dir = opendir($src);
	@mkdir($dst);

	while (false !== ($file = readdir($dir))) {
		if (($file != '.') && ($file != '..') && ($file != 'assets')) {
			if (is_dir($src . '/' . $file)) {
				// echo "<br>".$file;
				copy_directory($src . '/' . $file, $dst . '/' . $file);
				chmod($dst . '/' . $file, 0777);
			} else {
				copy($src . '/' . $file, $dst . '/' . $file);
				chmod($dst . '/' . $file, 0777);
			}
		}
	}
	closedir($dir);
}

function deleteDir($dirPath) {
	if (!is_dir($dirPath)) {
		throw new InvalidArgumentException("$dirPath must be a directory");
	}
	if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
		$dirPath .= '/';
	}
	$files = glob($dirPath . '*', GLOB_MARK);
	foreach ($files as $file) {
		if (is_dir($file)) {
			chmod($file, 0777);
			deleteDir($file);
		} else {
			chmod($file, 0777);
			unlink($file);
		}
	}
	chmod($dirPath, 0777);
	rmdir($dirPath);
}

function sortoutFilesByHtmlfile($html_file_path, $dst, $sidebar_start, $sidebar_end) {
	// $file = 'check/index.html';

	$file = $html_file_path;

	$fs = fopen($file, "r");
	$ft1 = fopen($dst . "application/modules/common/views/theme/dashboard_header.php", "w");
	$ft2 = fopen($dst . "application/modules/common/views/theme/dashboard_sidebar.php", "w");
	$ft3 = fopen($dst . "application/modules/common/views/theme/dashboard_index.php", "w");
	$ft4 = fopen($dst . "application/modules/common/views/theme/dashboard_footer.php", "w");

	if ($fs == NULL) {
		// echo "Can't Open Source File ...";
		$this->session->set_flashdata('error', "Can't Open Source File ...");

		// exit(0);
	}
	if ($ft1 == NULL || $ft2 == NULL || $ft3 == NULL || $ft4 == NULL) {
		// echo "Can't Open Destination File ...";
		$this->session->set_flashdata('error', "Can't Open Destination File ...");
		fclose($fs);
		// exit(1);
	} else {
		//adding in header
		while ($ch = fgets($fs)) {
			// $searchfor = '<aside';
			$searchfor = $sidebar_start;
			$contents = ($ch);
			$pattern = preg_quote($searchfor, '/');
			$pattern = "/^.*$pattern.*\$/m";
			if (preg_match_all($pattern, $contents, $matches)) {
				// echo "Found matches header done:<br>";
				//  adding in sidebar
				fputs($ft2, $ch);
				while ($ch = fgets($fs)) {
					// $searchfor = '</aside';
					$searchfor = $sidebar_end;
					$contents = ($ch);
					$pattern = preg_quote($searchfor, '/');
					$pattern = "/^.*$pattern.*\$/m";
					if (preg_match_all($pattern, $contents, $matches)) {
						// echo "Found matches:sidebar done<br>";
						// adding in body
						fputs($ft2, $ch);
						while ($ch = fgets($fs)) {
							$searchfor = '<footer';
							$contents = ($ch);
							$pattern = preg_quote($searchfor, '/');
							$pattern = "/^.*$pattern.*\$/m";
							if (preg_match_all($pattern, $contents, $matches)) {
								// echo "Found matches:body done<br>";
								// adding in footer
								fputs($ft4, $ch);
								while ($ch = fgets($fs)) {
									$searchfor = '</html>';
									$contents = ($ch);
									$pattern = preg_quote($searchfor, '/');
									$pattern = "/^.*$pattern.*\$/m";
									if (preg_match_all($pattern, $contents, $matches)) {
										// echo "Found matches:done footer";
										fputs($ft4, $ch);
										break;
									} else {
										fputs($ft4, $ch);
									}
								}
								// footer close
								break;
							} else {
								fputs($ft3, $ch);
							}
						}
						// body close
						break;
					} else {
						fputs($ft2, $ch);
					}
				}
				// sidebar close
				break;
			} else {
				fputs($ft1, $ch);
			}
		}
		// header close
		fclose($fs);
		fclose($ft1);
		fclose($ft2);
		fclose($ft3);
		fclose($ft4);

	}
}

function addTxtinLinkTag($header_path) {
	// $file = 'check/header.php';
	$file = $header_path;

	$path_to_file = $file;
	$file_contents = file_get_contents($path_to_file);

	$file_contents = str_replace('<link rel="stylesheet" href="', '<link rel="stylesheet" href="<?php echo base_url();?>assets/', $file_contents);
	file_put_contents($path_to_file, $file_contents);
}
function addTxtinScriptTag($footer_path) {
	// $file = 'check/footer.php';
	$file = $footer_path;

	$path_to_file = $file;
	$file_contents = file_get_contents($path_to_file);

	$file_contents = str_replace('<script src="', '<script src="<?php echo base_url();?>assets/', $file_contents);
	file_put_contents($path_to_file, $file_contents);
}
function addConfigFile($configfile_path, $prj_name) {
	// $file = 'check/footer.php';
	$file = $configfile_path;

	$path_to_file = $file;
	$file_contents = file_get_contents($path_to_file);

	$file_contents = str_replace("http://localhost/ci_atoz/", "http://localhost/$prj_name/", $file_contents);
	file_put_contents($path_to_file, $file_contents);
}

function newDashboardCreate($dashboardCtller_path) {
	$content = "<?php
					defined('BASEPATH') OR exit('No direct script access allowed');

					class Dashboard extends MY_Controller {

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
						public function __construct()
						{
							parent::__construct();

						}
						public function index()
						{
							\$this->load->view('theme/dashboard_header');
							\$this->load->view('theme/dashboard_sidebar');
							\$this->load->view('theme/dashboard_index');
							\$this->load->view('theme/dashboard_footer');
						}
					}";
	$fp = fopen($dashboardCtller_path, "wb");
	fwrite($fp, $content);
	fclose($fp);
	chmod($dashboardCtller_path, 0777);

}