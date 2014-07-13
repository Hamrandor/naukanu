<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author Jens
 */
class login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Laden der form helper
        $this->load->helper(array('form', 'html', 'url'));
        //Laden der form_validation library sowie der session library
        //Zur verwendung von sessions und form_validations
        $this->load->library(array('form_validation', 'session'));
        //Laden unseres models (/application/models/user.php)
        //Methoden des models können dann verwendet werden mit $this->user->[..];
        $this->load->model(array('user'));
    }

    public function index() {
        //Prüfen der session login_state auf ihren Wert
        //$this->session->userdata('login_state') = FALSE;
        if ($this->session->userdata('login_state') == FALSE) {
            //Vorraussetzen welche input felder ausgefüllt sein müssen. wenn diese nicht ausgefüllt sind wird
            //validation_errors() im view die nicht ausgefüllten felder zurückliefern beim absenden des formulars
            //sobald die methode $this->form_validation->run() ausgeführt wird.
            $this->form_validation->set_rules('username', 'Domain', 'required');
            $this->form_validation->set_rules('password', 'Passwort', 'required');

            $data = array();
            $tuut = $this->form_validation->run();
            //Prüfen ob alle Felder ausgefüllt wurden, welche als required definiert wurden.
            if ($this->form_validation->run() === TRUE) {

                //Abfangen der Post-Parameter und zeitgleiches filtern auf xss und etc sofern die entsprechenden
                //sachen im der config auf true gestellt worden sind.
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                //Logindaten überprüfen
                echo 'username = ' . $username . '<br>';
                echo 'password = ' . $password . '<br>';
                $user = $this->user->checkUserCredentials($username, $password);
                echo 'user2 = ' . $user . '<br>';

                //Wenn der username zurück geliefert wurde die session login_state auf true setzen,
                //sowie den benutzernamen zur session "username" setzen.
                if ($user != FALSE) {
                    $newdata = array(
                        'username' => $user,
                        'login_state' => TRUE
                    );
                    $this->session->set_userdata($newdata);
                    //Weiterleiten zum controller main
                    //http://localhost/<pfad>/main.html
                    redirect("naukanu");
                } else {
                    echo 'login fehlgeschlagen <br>';
                    //Setzen der variable $error im view
                    $data["error"] = "Login fehlgeschlagen.";
                }
            }

            //Übergeben des data arrays an den view, welcher die keynamen in entsprechende Variablen umwandelt.
            //$data["error] zu $error und etc.
            $this->loadPage($data);
        } else {
            //Falls der user bereits eingeloggt ist, dann direkt zum gesicherten Bereich weiterleiten.
            redirect("main");
        }
    }

    function loadPage($data) {
        //hier könnte man nun das entsprechende view laden.
        $this->load->view('v_wb_head');
        $this->load->view('v_navigation');
        $this->load->view('login', $data);
        $this->load->view('v_wb_footer');
    }

    //put your code here
}
