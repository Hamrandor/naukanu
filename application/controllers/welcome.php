<?php

if (!defined('BASEPATH'))
    exit('no direct script access allowed');

class welcome extends CI_Controller {

    /**
     * index page for this controller.
     *
     * maps to the following url
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * so any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        $this->load->view('welcome_message');
    }

}

/* end of file welcome.php */
/* location: ./application/controllers/welcome.php */