<?php

/*
 * to change this license header, choose license headers in project properties.
 * to change this template file, choose tools | templates
 * and open the template in the editor.
 */

/**
 * description of main
 *
 * @author jens
 */
class main extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'html', 'url'));
        $this->load->library(array('session'));
        $this->load->model('boat');
        //$this->load->model("news");
    }

    public function index() {
        //check if user is logged in
        if ($this->session->userdata('login_state') === true) {
            //hier könnte man nun das entsprechende view laden.
            $data = $this->boat->getboatarray();
            $this->load->view('boatconfig', $data);
        } else {
            //redirect to http://xyz.de/login.html
            redirect("login");
        }
    }

}
