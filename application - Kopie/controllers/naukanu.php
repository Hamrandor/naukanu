<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class naukanu extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        //Laden der form helper
        $this->load->helper(array('form', 'html', 'url'));
        //Laden der form_validation library sowie der session library
        //Zur verwendung von sessions und form_validations
        $this->load->library(array('form_validation', 'session'));
        //Laden unserer models (/application/models/user.php)
        //Methoden des models können dann verwendet werden mit z. B. $this->user->[..];
        $this->load->model(array('user', 'boat', 'mast', 'canvas', 'tools', 'coursetype', 'course'));
    }

    public function index() {
        if ($this->session->userdata('login_state') === TRUE) {
            //hier könnte man nun das entsprechende view laden.
            $this->load->view('v_wb_head');
            $this->load->view('v_navigation');
//            $this->load->view('v_naukanu');
            $this->load->view('v_wb_footer');
        } else {
            //Redirect to http://xyz.de/login.html
            redirect("login");
        }
    }

    public function configBoat() {
        redirect("boatConfig");
    }

    public function configMast() {
        redirect("mastConfig");
    }

    public function configCanvas() {
        redirect("canvasConfig");
    }

    public function configCourseType() {
        redirect('courseTypeConfig');
    }

    public function configCourse() {
        redirect('courseConfig');
    }

    public function configBooking() {
        redirect('bookingConfig');
    }

    public function calendar() {
        redirect('calendarConfig');
    }

    public function workbook() {
        $data = array();
        $this->load->view('v_wb_head');
        $this->load->view('v_navigation');

        $data['editBoat'] = false;
        $data["boatArray"] = $this->boat->getBoatNameSelect();
        $selectedBoat = $this->input->post('sBoatID');
        $data["selectedBoat"] = $selectedBoat;
        $data["selectedBoatType"] = null;
        $data["assignMast"] = false;
        if (isset($selectedBoat) && $selectedBoat != null) {
            echo '<br>Boot ausgewählt<br>';
            $boatObject = $this->boat->getBoatForID($selectedBoat);
            $data['boatObject'] = $boatObject;
            //$mastArray = array();
            $mastArray = $this->mast->getMastArray($boatObject['boatID']);
            $data['mastarrayofBoat'] = $mastArray;
            //echo 'eins '.$this->input->post('editBoat').'<br>';
            if ($this->input->post('editBoat')) {
                echo '<br>edit Boot <br>';
                //echo 'zwei <br>';
                //echo "boatEdit<br>";
                $data['editBoat'] = true;
                //echo 'boatObject'.print_r($boatObject).'<br>';
                $data['boatTypeSelect'] = $this->boat->getBoatTypeSelect();
            }
            if ($this->input->post('saveBoat')) {
                echo '<br>save Boot <br>';
//                    $selectedBoatType = $this->input->post('sBoatTypeID');
                //$data["selectedBoatType"] = $selectedBoatType;
                $boatObject['boatTypeID'] = $this->input->post('sBoatTypeID');
                $boatObject['name'] = $this->input->post('boatName');
                $this->boat->saveBoat($boatObject);
            }
            if ($this->input->post('editAMast')) {
                echo '<br>einen Mast bearbeiten<br>';
                $data['totalMastArray'] = $this->tools->extractDropDownArray(
                        $this->mast->getMastArray(null), 'mastID', 'name');
                $data['selectedMast'] = null;
                $data['editAMast'] = true;
            }
            if ($this->input->post('editMast')) {
                echo '<br>ausgew. Mast bearbeiten<br>';
                $data['selectedMast'] = $this->mast->getMastForID($this->input->post('sMast'));
                $data['editMast'] = true;
                $data['totalMastTypeArray'] = $this->mast->getMastTypeNameSelect(null);
            }
            if ($this->input->post('saveMast')) {
                echo '<br>Mast speichern<br> :' . print_r($data);
                $mast = $this->mast->getMastForID($this->input->post('mastID'));
                $mast['name'] = $this->input->post('MastName');
                $mast['mastTypeID'] = $this->input->post('sMastTypeID');
                $mast['boatID'] = $this->input->post('sBoatID');
                $this->mast->saveMast($mast);
                $data['editMast'] = false;
                $data['editAMast'] = false;
            }


//                if($this->input->post('assignMast')){
//                    echo '<br>assign Mast<br>';
//                    $data["assignMast"] = true;
//                    $availableMastDropDown = $this->mast->getAvailableMastArrayForBoatType($boatObject['boatTypeID']);
////                    echo '<br><br><br>MastArray:'.$availableMastDropDown.'<br><br><br>';
//                    $data['availableMastArray'] = $this->tools->extractDropDownArray($availableMastDropDown, 'mastID', 'name');
//                    $data['mastToAssign'] = null;
//                }
//                $mastToBoat = $this->input->post('saveMastToBoat');
//                echo 'masttoboat = '.isset($mastToBoat);
//                if($this->input->post('saveMastButton')){
//                    echo '<br>Mast an Boot speichern<br>';
//                    echo '<br>beim speichern<br>'.$mastToBoat;
//                    $mastToAssign = $this->mast->getMastForID($mastToBoat);
//                    $mastToAssign['boatID'] = $boatObject['boatID'];
//                    echo '<br>zu speichernder Mast:'.print_r($mastToAssign).'<br>';
//                    $this->mast->saveMast($mastToAssign);
//                    $mastArray = $this->mast->getMastArray($boatObject['boatID']);
//                    $data['mastarray'] = $mastArray;
//                }
        }
        $this->load->view('v_wb_body', $data);
        $this->load->view('v_wb_footer');
    }

    public function logo() {
        $this->load->view('v_logo');
    }

    public function footer() {
        $this->load->view('v_footer');
    }

    public function headline() {
        $this->load->view('v_headline');
    }

    public function navigation() {
        $this->load->view('v_navigation');
    }

    public function configureBoat() {
        $data = array();
        $this->load->view('v_wb_head');
        $data['editBoat'] = false;
        $data["boatArray"] = $this->boat->getBoatNameSelect();
        $selectedBoat = $this->input->post('sBoatID');
        $data["selectedBoat"] = $selectedBoat;
        $data["selectedBoatType"] = null;
        $data["assignMast"] = false;
        if (isset($selectedBoat) && $selectedBoat != null) {
//                echo '<br>Boot ausgew&auml;hlt<br>';
            $boatObject = $this->boat->getBoatForID($selectedBoat);
            $data['boatObject'] = $boatObject;
            //$mastArray = array();
            $mastArray = $this->mast->getMastArray($boatObject['boatID']);
            $data['mastarrayofBoat'] = $mastArray;
            //echo 'eins '.$this->input->post('editBoat').'<br>';
            if ($this->input->post('editBoat')) {
                echo '<br>edit Boot <br>';
                //echo 'zwei <br>';
                //echo "boatEdit<br>";
                $data['editBoat'] = true;
                //echo 'boatObject'.print_r($boatObject).'<br>';
                $data['boatTypeSelect'] = $this->boat->getBoatTypeSelect();
            }
            if ($this->input->post('saveBoat')) {
                echo '<br>save Boot <br>';
                $selectedBoatType = $this->input->post('sBoatTypeID');
                //$data["selectedBoatType"] = $selectedBoatType;
                $boatObject['boatTypeID'] = $selectedBoatType;
                $boatObject['name'] = $this->input->post('boatName');
                $this->boat->saveBoat($boatObject);
            }
            if ($this->input->post('editAMast')) {
                echo '<br>einen Mast bearbeiten<br>';
                $data['totalMastArray'] = $this->tools->extractDropDownArray(
                        $this->mast->getMastArray(null), 'mastID', 'name');
                $data['selectedMast'] = null;
                $data['editAMast'] = true;
            }
            if ($this->input->post('editMast')) {
                echo '<br>ausgew. Mast bearbeiten<br>';
                $data['selectedMast'] = $this->mast->getMastForID($this->input->post('sMast'));
                $data['editMast'] = true;
                $data['totalMastTypeArray'] = $this->mast->getMastTypeNameSelect(null);
            }
            if ($this->input->post('saveMast')) {
                echo '<br>Mast speichern<br> :' . print_r($data);
                $mast = $this->mast->getMastForID($this->input->post('mastID'));
                $mast['name'] = $this->input->post('MastName');
                $mast['mastTypeID'] = $this->input->post('sMastTypeID');
                $mast['boatID'] = $this->input->post('sBoatID');
                $this->mast->saveMast($mast);
                $data['editMast'] = false;
                $data['editAMast'] = false;
            }


//                if($this->input->post('assignMast')){
//                    echo '<br>assign Mast<br>';
//                    $data["assignMast"] = true;
//                    $availableMastDropDown = $this->mast->getAvailableMastArrayForBoatType($boatObject['boatTypeID']);
////                    echo '<br><br><br>MastArray:'.$availableMastDropDown.'<br><br><br>';
//                    $data['availableMastArray'] = $this->tools->extractDropDownArray($availableMastDropDown, 'mastID', 'name');
//                    $data['mastToAssign'] = null;
//                }
//                $mastToBoat = $this->input->post('saveMastToBoat');
//                echo 'masttoboat = '.isset($mastToBoat);
//                if($this->input->post('saveMastButton')){
//                    echo '<br>Mast an Boot speichern<br>';
//                    echo '<br>beim speichern<br>'.$mastToBoat;
//                    $mastToAssign = $this->mast->getMastForID($mastToBoat);
//                    $mastToAssign['boatID'] = $boatObject['boatID'];
//                    echo '<br>zu speichernder Mast:'.print_r($mastToAssign).'<br>';
//                    $this->mast->saveMast($mastToAssign);
//                    $mastArray = $this->mast->getMastArray($boatObject['boatID']);
//                    $data['mastarray'] = $mastArray;
//                }
        }
        $this->load->view('v_wb_body', $data);
        $this->load->view('v_wb_footer');
    }

    /* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */
}
