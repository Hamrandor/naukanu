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
class personnelData extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'html', 'url'));
        $this->load->library(array('form_validation', 'session'));
        $this->load->model(array('user', 'person'));
    }

    public function index() {

        echo "personnelData index";
    }

    public function initialPersonelData($NewID) {
        echo "initialPerrsonneData function";


        $this->load->model('person');
        $NewID->person->createNewEmployeeID();
        $data['NewID'] = $NewID;
        $this->load->view('v_formular_initial_personnelData', $data);
    }

}
