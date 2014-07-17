<?php

/*
 * to change this license header, choose license headers in project properties.
 * to change this template file, choose tools | templates
 * and open the template in the editor.
 */

/**
 * description of boatconfig
 *
 * @author jens
 */
class ratematerial extends CI_Controller {

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
        $this->load->model(array('user', 'boat', 'mast', 'canvas', 'tools', 'condition'));
    }

    public function index() {

        $data['materialtype'] = array('Boot', 'Mast', 'Segel');
        $this->loadpage($data);
    }

    function selectmaterialtype() {
        $data = array();
        $smaterialtype = $this->input->post('smaterialtype');
        $data['smaterialtype'] = $smaterialtype;
        echo 'Material  = '.$smaterialtype;
        if (isset($smaterialtype) && $smaterialtype != null) {
            switch ($smaterialtype) {
                case "Boot" : $data['slist'] = $this->boat->getboatnameselect();
                    break;
                case "Mast" : $data['slist'] = $this->mast->getmastnameselect();
                    break;
                case "Segel": $data['slist'] = $this->canvas->getcanvasnameselect();
                    break;
            }
        }
        $this->loadpage($data);
    }

    function loadpage($data) {
        if ($this->session->userdata('login_state') === true) {
            //hier könnte man nun das entsprechende view laden.
            $this->load->view('v_wb_head');
            $this->load->view('v_navigation');
            $this->load->view('v_rate_material', $data);
            $this->load->view('v_wb_footer');
        } else {
            //redirect to http://xyz.de/login.html
            redirect("login");
        }
    }

    function chooseobject() {
        $data = array();
        $smaterialtype = $this->input->post('smaterialtype');
        $data['smaterialtype'] = $smaterialtype;
        //$data['sobject']= 
        $sobjectid = $this->input->post('sobject');
        $data['sobjectid'] = $sobjectid;
        switch ($smaterialtype) {
            case "Boot" : $data['sobject'] = $this->boat->getboatforid($sobjectid);
                break;
            case "Mast" : $data['sobject'] = $this->mast->getmastforid($sobjectid);
                break;
            case "Segel": $data['sobject'] = $this->canvas->getcanvasforid($sobjectid);
                break;
        }
        $data['conditionlist'] = $this->condition->getconditionselect();
        $this->loadpage($data);
    }

    function rateobject() {
        $data = array();
        $smaterialtype = $this->input->post('smaterialtype');
        $data['smaterialtype'] = null;
        $sobjectid = $this->input->post('sobjectid');
        $sconditionid = $this->input->post('scondition');
        switch ($smaterialtype) {
            case "Boot" :
                $boat = $this->boat->getboatforid($sobjectid);
                $boat['conditionid'] = $sconditionid;
                $this->boat->saveboat($boat);
                break;
            case "Mast" :
                $mast = $this->mast->getmastforid($sobjectid);
                $mast['conditionid'] = $sconditionid;
                $this->mast->savemast($mast);
                break;
            case "Segel":
                $canvas = $this->canvas->getcanvasforid($sobjectid);
                $canvas['conditionid'] = $sconditionid;
                $this->canvas->savecanvas($canvas);
                break;
        }
        $this->index();
    }

}
