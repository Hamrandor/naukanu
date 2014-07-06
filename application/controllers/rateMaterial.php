<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of boatConfig
 *
 * @author Jens
 */
class rateMaterial extends CI_Controller{
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
        
            $data['materialType']= array('Boot', 'Mast', 'Segel');
            $this->loadPage($data);
    }
    
    function selectMaterialType(){
        $data = array();
        $sMaterialType = $this->input->post('sMaterialType');
        $data['sMaterialType']= $sMaterialType;
        if (isset($sMaterialType) && $sMaterialType != null) {
            switch($sMaterialType) {
                case "Boot" : $data['sList'] = $this->boat->getBoatNameSelect(); break;
                case "Mast" : $data['sList'] = $this->mast->getMastNameSelect(); break;
                case "Segel": $data['sList'] = $this->canvas->getCanvasNameSelect(); break;
            }
        }
        $this->loadPage($data);
    }
        
    function loadPage($data) {
        if($this->session->userdata('login_state') === TRUE){
            //hier könnte man nun das entsprechende view laden.
            $this->load->view('v_wb_head');
            $this->load->view('v_navigation');
            $this->load->view('v_rate_Material', $data);
            $this->load->view('v_wb_footer');
        }else{
            //Redirect to http://xyz.de/login.html
            redirect("login");
        }           
    }
    
    function chooseObject(){
        $data = array();
        $sMaterialType = $this->input->post('sMaterialType');
        $data['sMaterialType']= $sMaterialType;
        //$data['sObject']= 
        $sObjectID = $this->input->post('sObject');
        $data['sObjectID'] = $sObjectID;
        switch($sMaterialType) {
            case "Boot" : $data['sObject']= $this->boat->getBoatForID($sObjectID); break;
            case "Mast" : $data['sObject']= $this->mast->getMastForID($sObjectID); break;
            case "Segel": $data['sObject']= $this->canvas->getCanvasForID($sObjectID); break;
        }
        $data['conditionList']= $this->condition->getConditionSelect();
        $this->loadPage($data);
    }   
    
    function rateObject(){
        $data = array();
        $sMaterialType = $this->input->post('sMaterialType');
        $data['sMaterialType']= null;
        $sObjectID = $this->input->post('sObjectID');
        $sConditionID = $this->input->post('sCondition');
        switch($sMaterialType) {
            case "Boot" : 
                $boat = $this->boat->getBoatForID($sObjectID);
                $boat['conditionID'] = $sConditionID;
                $this->boat->saveBoat($boat);
                break;
            case "Mast" : 
                $mast = $this->mast->getMastForID($sObjectID);
                $mast['conditionID'] = $sConditionID;
                $this->mast->saveMast($mast);
                break;
            case "Segel": 
                $canvas = $this->canvas->getCanvasForID($sObjectID);
                $canvas['conditionID'] = $sConditionID;
                $this->canvas->saveCanvas($canvas);
                break;

        }
        $this->index();
   }   

}
