<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ratecourse extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        //laden der form helper
        $this->load->helper(array('form', 'html', 'url'));
        //laden der form_validation library sowie der session library
        //zur verwendung von sessions und form_validations
        $this->load->library(array('form_validation', 'session'));
        //laden unserer models (/application/models/user.php)
        //methoden des models können dann verwendet werden mit z. b. $this->user->[..];
        $this->load->model(array('course', 'appraisal'));
    }

    public function index() {

        $data = array();
        $selectedemployee = $this->input->post('semployee');
        $data["selectedemployee"] = $selectedemployee;
        $data["employeearray"] = $this->course->getemployeeselect();
        $this->load->view('v_wb_head');
        $this->load->view('v_navigation');
        $this->load->view('v_rate_course', $data);
        $this->load->view('v_wb_footer');
        
       
        if ($this->input->post('chooseemployee')) {
        $data = array();
        $selectedcourse = $this->input->post('scourse');
        $data["selectedcourse"] = $selectedcourse;
        $data["coursearray"] = $this->course->getcoursetypeselect();
        $this->load->view('v_wb_head');
        $this->load->view('v_navigation');
        $this->load->view('v_rate_course', $data);
        $this->load->view('v_wb_footer');
        }
        
        if ($this->input->post('choosecourse')) {
        $data = array();
        }
    }
}    
