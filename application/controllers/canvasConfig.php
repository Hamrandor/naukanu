<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of canvasConfig
 *
 * @author Jens
 */
class canvasConfig extends CI_Controller {
    //put your code here
     public function __construct(){
    parent::__construct();
    //Laden der form helper
    $this->load->helper(array('form', 'html', 'url'));
    //Laden der form_validation library sowie der session library
    //Zur verwendung von sessions und form_validations
    $this->load->library(array('form_validation', 'session'));
    //Laden unserer m odels (/application/models/user.php)
    //Methoden des models können dann verwendet werden mit z. B. $this->user->[..];
    $this->load->model(array('user', 'mast', 'canvas', 'tools', 'condition'));
    }
    
    public function index(){
        if($this->session->userdata('login_state') === TRUE){
            //hier könnte man nun das entsprechende view laden.
            $this->load->view('v_wb_head');
            $this->load->view('v_navigation');
            $data = array();
            $data['editCanvas'] = false;
            $selectedCanvas = $this->input->post('sCanvasID');
            $nCanvasTypeID = $this->input->post('nCanvasTypeID');
            //hier Test ob neues Boot
            if ($this->input->post('newCanvas')){
                //$data = newMast($data);
                $data['newCanvasObject'] = $this->canvas->emptyCanvas();
                $data['selectedCanvas'] = null; //$this->canvas->emptyCanvas();
                $data['canvasTypeSelect'] =  $this->canvas->getCanvasTypeSelect(NULL);
                $keys = array_keys($data['canvasTypeSelect'] );
                $data['mastSelect'] =  $this->tools->addNullValue($this->mast->getMastArrayForCanvasType(array_pop($keys)));
                $data['conditionSelect'] =  $this->condition->getConditionSelect();
                $nCanvasTypeID = null;
                } else {
                // wenn nicht, dann Das augewählte Boot bearbeiten
                $data["selectedCanvas"] = $selectedCanvas;
                $data["selectedCanvasType"] = null;
            }
            
            if ($this->input->post('saveNewCanvas')){
                $newCanvas = $this->canvas->emptyCanvas();
                $newCanvas["name"] = $this->input->post('canvasName');
                $newCanvas["canvasTypeID"] = $nCanvasTypeID;
                $newCanvas["conditionID"] = $this->input->post('sConditionID');
                $newCanvas["mastID"] = $this->input->post('sMastID');
                $nCanvasTypeID = null;
                if ($this->canvas->checkCanvas($newCanvas)) {
                    $this->canvas->saveCanvas($newCanvas);
                } else {
                    $this->tools->alertMessage("Zuordnung Masttyp zu Segeltyp ist nicht konfiguriert.");
                }
            }
            
            if ($this->input->post('chooseCanvas') || $this->input->post('saveCanvas') || $this->input->post('editCanvas')){
                $nCanvasTypeID = null;
                $canvasObject = $this->canvas->getCanvasForID($selectedCanvas);
                $data['canvasObject'] = $canvasObject;
                //$canvasArray = array();
                $canvasArray = $this->canvas->getCanvasArray($canvasObject['canvasID']);
                $data['canvasArrayofCanvas'] = $canvasArray;
                if($this->input->post('editCanvas')){
//                    echo '<br>edit Boot <br>';
                    $data['editCanvas'] = true;
                    $data['canvasTypeSelect'] =  $this->canvas->getCanvasTypeSelect(NULL);
                    $data['mastSelect'] =  $this->mast->getMastNameSelect();
                    $data['selectedMast'] = $canvasObject['mastID'];
                }
                if($this->input->post('saveCanvas')){
//                    echo '<br>save Boot <br>';
                    $canvasObject['canvasTypeID'] = $this->input->post('sCanvasTypeID');
                    $canvasObject['name'] = $this->input->post('canvasName');
                    $canvasObject['mastID'] = $this->input->post('sMastID');
                    $this->canvas->saveCanvas($canvasObject);
                }
            }
            
            if ($this->input->post('deleteCanvas')){
                $this->canvas->deleteCanvas($selectedCanvas);
                $this->tools->alertMessage("Segel wurde gelöscht.");
            }

            
            if (isset($nCanvasTypeID) && $nCanvasTypeID != null){
                $newCanvas = $this->canvas->emptyCanvas();
                $newCanvas["name"] = $this->input->post('canvasName');
                $newCanvas["canvasTypeID"] = $nCanvasTypeID;
                $newCanvas["conditionID"] = $this->input->post('sConditionID');
                $newCanvas["mastID"] = $this->input->post('sMastID');
                $data['mastSelect'] = $this->tools->addNullValue($this->mast->getMastArrayForCanvasType($newCanvas["canvasTypeID"]));
                $data['newCanvasObject'] = $newCanvas;
                $data['canvasTypeSelect'] =  $this->canvas->getCanvasTypeSelect(NULL);
                $data['conditionSelect'] =  $this->condition->getConditionSelect();
                $data['selectedCanvas'] = null; //$this->canvas->emptyCanvas();
            }
            $data["canvasArray"] = $this->canvas->getCanvasNameSelect(NULL);
            $this->load->view('v_config_canvas', $data);
            $this->load->view('v_wb_footer');
        }else{
            //Redirect to http://xyz.de/login.html
            redirect("login");
        }
    }    
    

    
    
}
