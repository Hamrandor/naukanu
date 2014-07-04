<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mastConfig
 *
 * @author Jens
 */
class mastConfig extends CI_Controller {
    //put your code here
     public function __construct(){
    parent::__construct();
    //Laden der form helper
    $this->load->helper(array('form', 'html', 'url'));
    //Laden der form_validation library sowie der session library
    //Zur verwendung von sessions und form_validations
    $this->load->library(array('form_validation', 'session'));
    //Laden unserer models (/application/models/user.php)
    //Methoden des models können dann verwendet werden mit z. B. $this->user->[..];
    $this->load->model(array('user', 'boat', 'mast', 'canvas', 'tools', 'condition'));
    }
    
    public function index(){
        if($this->session->userdata('login_state') === TRUE){
            //hier könnte man nun das entsprechende view laden.
            $this->load->view('v_wb_head');
            $this->load->view('v_navigation');
            $data = array();
            $data['editMast'] = false;
            $data["mastArray"] = $this->mast->getMastNameSelect(NULL);
            $selectedMast = $this->input->post('sMastID');
            //hier Test ob neues Boot
            if ($this->input->post('newMast')){
                //$data = newBoat($data);
                $data['newMastObject'] = $this->mast->emptyMast();
                $data['selectedMast'] = null; //$this->mast->emptyMast();
                $data['mastTypeSelect'] =  $this->mast->getMastTypeSelect(NULL);
                $data['boatSelect'] =  $this->boat->getBoatNameSelect();
                $data['conditionSelect'] =  $this->condition->getConditionSelect();
                } else {
                // wenn nicht, dann Das augewählte Boot bearbeiten
                $data["selectedMast"] = $selectedMast;
                $data["selectedMastType"] = null;
            }
            if ($this->input->post('saveNewMast')){
                $newMast = $this->mast->emptyMast();
                $newMast["name"] = $this->input->post('mastName');
                $newMast["mastTypeID"] = $this->input->post('sMastTypeID');
                $newMast["conditionID"] = $this->input->post('sConditionID');
                $newMast["boatID"] = $this->input->post('sBoatID');
                if ($this->mast->checkMast($newMast)) {
                    $this->mast->saveMast($newMast);
                } else {
                    $this->tools->alertMessage("Zuordnung Masttyp zu Bootstyp ist nicht konfiguriert.");
                }
            }
            
            
            if ($this->input->post('chooseMast') || $this->input->post('saveMast') || $this->input->post('editMast')){
                $mastObject = $this->mast->getMastForID($selectedMast);
                $data['mastObject'] = $mastObject;
                $canvasArray = array();
                $canvasArray = $this->canvas->getCanvasArray($mastObject['mastID']);
                $data['canvasArrayofMast'] = $canvasArray;
                if($this->input->post('editMast')){
//                    echo '<br>edit Boot <br>';
                    $data['editMast'] = true;
                    $data['mastTypeSelect'] =  $this->mast->getMastTypeSelect(NULL);
                    $data['boatSelect'] =  $this->boat->getBoatNameSelect();
                    $data['selectedBoat'] = $mastObject['boatID'];
                }
                if($this->input->post('saveMast')){
//                    echo '<br>save Boot <br>';
                    $mastObject['mastTypeID'] = $this->input->post('sMastTypeID');
                    $mastObject['name'] = $this->input->post('mastName');
                    $mastObject['boatID'] = $this->input->post('sBoatID');
                    $this->mast->saveMast($mastObject);
                }
            }
            $this->load->view('v_config_mast', $data);

           $this->load->view('v_wb_footer');
        }else{
            //Redirect to http://xyz.de/login.html
            redirect("login");
        }
    }
        
    function newBoat($data){
        return $data;
    }
    
    
        
    
}
