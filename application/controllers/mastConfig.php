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
            $nMastTypeID = $this->input->post('nMastTypeID');
            $selectedMast = $this->input->post('sMastID');
            //hier Test ob neues Boot
            if ($this->input->post('newMast')){
                //$data = newBoat($data);
                $data['newMastObject'] = $this->mast->emptyMast();
                $data['selectedMast'] = null; //$this->mast->emptyMast();
                $data['mastTypeSelect'] =  $this->mast->getMastTypeSelect(NULL);
                $data['boatSelect'] =  $this->tools->addNullValue($this->boat->getBoatArrayForMastType(NULL));
                $data['conditionSelect'] =  $this->condition->getConditionSelect();
                $nMastTypeID = null;
                } else {
                // wenn nicht, dann Das augewählte Boot bearbeiten
                $data["selectedMast"] = $selectedMast;
                $data["selectedMastType"] = null;
            }
            if ($this->input->post('saveNewMast')){
                $newMast = $this->mast->emptyMast();
                $newMast['name'] = $this->input->post('mastName');
                $newMast['mastTypeID'] = $nMastTypeID;
                $newMast['conditionID'] = $this->input->post('sConditionID');
                $newMast['boatID'] = $this->input->post('sBoatID');
                        
                $nMastTypeID = null;
                $this->mast->saveMast($newMast);
            }
            
            if ($this->input->post('chooseMast') || $this->input->post('saveMast') || $this->input->post('editMast')){
                $mastObject = $this->mast->getMastForID($selectedMast);
                $data['mastObject'] = $mastObject;
                $canvasArray = $this->canvas->getCanvasArray($mastObject['mastID']);
                $data['canvasArrayofMast'] = $canvasArray;
                print_r($canvasArray);
                $nMastTypeID = null;

                if($this->input->post('editMast')){
//                    echo '<br>edit Boot <br>';
                    $data['editMast'] = true;
                    $data['mastTypeSelect'] =  $this->mast->getMastTypeSelect($mastObject['boatTypeID']);
                    $data['boatSelect'] =  $this->boat->getBoatNameSelect();
//                    $data['selectedBoat'] = $mastObject['boatID'];
              
                }
                if($this->input->post('saveMast')){
//                    echo '<br>save Boot <br>';
                    $mastObject['mastID'] = $this->input->post('eMastID');
                    $mastObject['mastTypeID'] = $this->input->post('sMastTypeID');
                    $mastObject['name'] = $this->input->post('mastName');
                    $mastObject['boatID'] = $this->input->post('sBoatID');
                    $mastObject['conditionID'] = $this->input->post('eConditionID');
                    
                    $this->mast->saveMast($mastObject);
                }
            }
            if ($this->input->post('deleteMast')){
                $this->mast->deleteMast($selectedMast);
                $this->tools->alertMessage("Mast wurde gelöscht.");
            }
            
            if (isset($nMastTypeID) && $nMastTypeID != null){
                $newMast = $this->mast->emptyMast();
                $newMast["name"] = $this->input->post('mastName');
                $newMast["mastTypeID"] = $nMastTypeID;
                $newMast["conditionID"] = $this->input->post('sConditionID');
                $newMast["boatID"] = $this->input->post('sBoatID');
                $data['boatSelect'] = $this->tools->addNullValue($this->boat->getBoatArrayForMastType($newMast["mastTypeID"]));
                $data['newMastObject'] = $newMast;
                $data['mastTypeSelect'] =  $this->mast->getMastTypeSelect(NULL);
                $data['conditionSelect'] =  $this->condition->getConditionSelect();
                $data['selectedMast'] = null; //$this->canvas->emptyCanvas();
            }
            $data["mastArray"] = $this->mast->getMastNameSelect(NULL);
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
