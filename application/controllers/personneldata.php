<?php

/*
 * to change this license header, choose license headers in project properties.
 * to change this template file, choose tools | templates
 * and open the template in the editor.
 */

/**
 * description of personneldata
 *
 * @author rnitschke
 */
class personneldata extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'html', 'url'));
        $this->load->library(array('form_validation', 'session'));
        $this->load->model(array('user', 'person'));
    }

    public function index() {

        echo "personneldata index";
    }

    public function initialpersoneldata($newid) {
        echo "initialperrsonnedata function";


        $this->load->model('person');
        $newid->person->createnewemployeeid();
        $data['newid'] = $newid;
        $this->load->view('v_formular_initial_personneldata', $data);
    }

}
