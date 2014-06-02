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
        public function __construct(){
            parent::__construct();
            //Laden der form helper
            $this->load->helper(array('form', 'html', 'url'));
            //Laden der form_validation library sowie der session library
            //Zur verwendung von sessions und form_validations
            $this->load->library(array('form_validation', 'session'));
            //Laden unserer models (/application/models/user.php)
            //Methoden des models können dann verwendet werden mit z. B. $this->user->[..];
            $this->load->model(array('user', 'boat'));
        }
        
        
	public function index(){
            if($this->session->userdata('login_state') === TRUE){
                //hier könnte man nun das entsprechende view laden.
            $this->load->view('v_naukanu');
            }else{
                //Redirect to http://xyz.de/login.html
                redirect("login");
            }
	}
	
	public function workbook(){
            $this->load->view('v_wb_head');
            $data = array();
            $boatArray = $this->boat->getBoatArray();
            $data["boatArray"] = $this->boat->getNameSelect();
            $this->load->view('v_wb_body', $data);
            $this->load->view('v_wb_footer');
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
