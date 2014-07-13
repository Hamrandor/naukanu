<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Main
 *
 * @author Jens
 */
class Main extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__Construct();
        $this->load->helper(array('form', 'html', 'url'));
        $this->load->library(array('session'));
        $this->load->model('boat');
        //$this->load->model("news");
    }

    public function index() {
        //Check if user is logged in
        if ($this->session->userdata('login_state') === TRUE) {
            //hier könnte man nun das entsprechende view laden.
            $data = $this->boat->getBoatArray();
            $this->load->view('boatConfig', $data);
        } else {
            //Redirect to http://xyz.de/login.html
            redirect("login");
        }
    }

}
