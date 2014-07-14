<?php

/*
 * to change this license header, choose license headers in project properties.
 * to change this template file, choose tools | templates
 * and open the template in the editor.
 */

/**
 * description of login
 *
 * @author jens
 */
class login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //laden der form helper
        $this->load->helper(array('form', 'html', 'url'));
        //laden der form_validation library sowie der session library
        //zur verwendung von sessions und form_validations
        $this->load->library(array('form_validation', 'session'));
        //laden unseres models (/application/models/user.php)
        //methoden des models können dann verwendet werden mit $this->user->[..];
        $this->load->model(array('user'));
    }

    public function index() {
        //prüfen der session login_state auf ihren wert
        //$this->session->userdata('login_state') = false;
        if ($this->session->userdata('login_state') == false) {
            //vorraussetzen welche input felder ausgefüllt sein müssen. wenn diese nicht ausgefüllt sind wird
            //validation_errors() im view die nicht ausgefüllten felder zurückliefern beim absenden des formulars
            //sobald die methode $this->form_validation->run() ausgeführt wird.
            $this->form_validation->set_rules('username', 'domain', 'required');
            $this->form_validation->set_rules('password', 'passwort', 'required');

            $data = array();
            $tuut = $this->form_validation->run();
            //prüfen ob alle felder ausgefüllt wurden, welche als required definiert wurden.
            if ($this->form_validation->run() === true) {

                //abfangen der post-parameter und zeitgleiches filtern auf xss und etc sofern die entsprechenden
                //sachen im der config auf true gestellt worden sind.
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                //logindaten überprüfen
                echo 'username = ' . $username . '<br>';
                echo 'password = ' . $password . '<br>';
                $user = $this->user->checkusercredentials($username, $password);
                echo 'user2 = ' . $user . '<br>';

                //wenn der username zurück geliefert wurde die session login_state auf true setzen,
                //sowie den benutzernamen zur session "username" setzen.
                if ($user != false) {
                    $newdata = array(
                        'username' => $user,
                        'login_state' => true
                    );
                    $this->session->set_userdata($newdata);
                    //weiterleiten zum controller main
                    //http://localhost/<pfad>/main.html
                    redirect("naukanu");
                } else {
                    echo 'login fehlgeschlagen <br>';
                    //setzen der variable $error im view
                    $data["error"] = "login fehlgeschlagen.";
                }
            }

            //übergeben des data arrays an den view, welcher die keynamen in entsprechende variablen umwandelt.
            //$data["error] zu $error und etc.
            $this->loadpage($data);
        } else {
            //falls der user bereits eingeloggt ist, dann direkt zum gesicherten bereich weiterleiten.
            redirect("main");
        }
    }

    function loadpage($data) {
        //hier könnte man nun das entsprechende view laden.
        $this->load->view('v_wb_head');
        $this->load->view('v_navigation');
        $this->load->view('login', $data);
        $this->load->view('v_wb_footer');
    }

    //put your code here
}
