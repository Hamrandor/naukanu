<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class naukanu extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		$this->load->view('v_naukanu');
	}
	
	public function workbook(){
		$this->load->view('v_workbook');
	}

	public function view(){
		$this->load->view('v_view');
	}

	public function logo(){
		$this->load->view('v_logo');
	}

	public function footer(){
		$this->load->view('v_footer');
	}

	public function headline(){
		$this->load->view('v_headline');
	}
	
	public function navigation(){
		$this->load->view('v_navigation');
	}
	
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
}
