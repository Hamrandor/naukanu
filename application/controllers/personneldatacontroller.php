<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of personnelData
 *
 * @author rnitschke
 */
class personnelDataController extends CI_Controller {

    public $personmodel;
    public $initialpersonneldataview;


    
    public function __construct(){
    parent::__construct();
    $this->load->helper(array('form', 'html', 'url'));
    $this->load->library(array('form_validation', 'session','table'));
    $this->load->model(array('user', 'personmodel', 'employee'));
    }
    
    public function index(){
    $data = array();
    $this->showFormular($data);
            
    }
    
    public function showFormular($data){
    
    $data['newid'] = $this->personmodel->createNewEmployeeID();
    $data ['persons'] = $this->personmodel->getpersonnameselect();
    $this->load->view('v_wb_head');
    $this->load->view('v_navigation');
    $this->load->view('initialpersonneldataview', $data);
    $this->load->view('v_wb_footer');
    }
    
    public function chooseperson(){
        $personid = $this->input->post('sperson');
        $data = array();
        if (isset($personid) && $personid != null){
        
        $data['person']=  $this->personmodel->getpersonforid($personid);
        $data['showperson'] = true;
        }
        $this->showFormular($data);
    }
    
    }   
    
    
        
    

