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
            $this->load->model(array('user', 'boat', 'mast', 'canvas', 'tools'));
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
            $data = array();
            $this->load->view('v_wb_head');
            $data['editBoat'] = false;
            $data["boatArray"] = $this->boat->getBoatNameSelect();
            $selectedBoat = $this->input->post('sBoatID');
            $data["selectedBoat"] = $selectedBoat;
            $data["selectedBoatType"] = null;
            $data["assignMast"] = false;
            if (isset($selectedBoat)){
                echo '<br>Boot ausgewählt<br>';
                $boatObject = $this->boat->getBoatForID($selectedBoat);
                $data['boatObject'] = $boatObject;
                //$mastArray = array();
                $mastArray = $this->mast->getMastArrayForBoatID($boatObject['boatID']);
                $data['mastarray'] = $mastArray;
                //echo 'eins '.$this->input->post('editBoat').'<br>';
                if($this->input->post('editBoat')){
                    echo '<br>edit Boot <br>';
                //echo 'zwei <br>';
                    //echo "boatEdit<br>";
                    $data['editBoat'] = true;
                    //echo 'boatObject'.print_r($boatObject).'<br>';
                    $data['boatTypeSelect'] =  $this->boat->getBoatTypeSelect();
                }
                if($this->input->post('saveBoat')){
                    echo '<br>save Boot <br>';
                    $selectedBoatType = $this->input->post('sBoatTypeID');
                    //$data["selectedBoatType"] = $selectedBoatType;
                    $boatObject['boatTypeID'] = $selectedBoatType;
                    $boatObject['name'] = $this->input->post('boatName');
                    $this->boat->saveBoat($boatObject);
                }
                if($this->input->post('assignMast')){
                    echo '<br>assign Mast<br>';
                    $data["assignMast"] = true;
                    $availableMastDropDown = $this->mast->getAvailableMastArrayForBoatType($boatObject['boatTypeID']);
//                    echo '<br><br><br>MastArray:'.$availableMastDropDown.'<br><br><br>';
                    $data['availableMastArray'] = $this->tools->extractDropDownArray($availableMastDropDown, 'mastID', 'name');
                    $data['mastToAssign'] = null;
                }
//                $mastToBoat = null;
                $mastToBoat = $this->input->post('saveMastToBoat');
                echo 'masttoboat = '.isset($mastToBoat);
                if($this->input->post('saveMastButton')){
                    echo '<br>Mast an Boot speichern<br>';
                    echo '<br>beim speichern<br>'.$mastToBoat;
                    $mastToAssign = $this->mast->getMastForID($mastToBoat);
                    $mastToAssign['boatID'] = $boatObject['boatID'];
                    echo '<br>zu speichernder Mast:'.print_r($mastToAssign).'<br>';
                    $this->mast->saveMast($mastToAssign);
                    $mastArray = $this->mast->getMastArrayForBoatID($boatObject['boatID']);
                    $data['mastarray'] = $mastArray;
                }
                
                
            }
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
