<?php

if (!defined('BASEPATH'))
    exit('no direct script access allowed');

class naukanu extends CI_Controller {

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
    public function __construct() {
        parent::__construct();
        //laden der form helper
        $this->load->helper(array('form', 'html', 'url'));
        //laden der form_validation library sowie der session library
        //zur verwendung von sessions und form_validations
        $this->load->library(array('form_validation', 'session'));
        //laden unserer models (/application/models/user.php)
        //methoden des models können dann verwendet werden mit z. b. $this->user->[..];
        $this->load->model(array('user', 'boat', 'mast', 'canvas', 'tools', 'coursetype', 'course'));
    }

    public function index() {
        if ($this->session->userdata('login_state') === true) {
            //hier könnte man nun das entsprechende view laden.
            $this->load->view('v_wb_head');
            $this->load->view('v_navigation');
//            $this->load->view('v_naukanu');
            $this->load->view('v_wb_footer');
        } else {
            //redirect to http://xyz.de/login.html
            redirect("login");
        }
    }

    public function configboat() {
        redirect("boatconfig");
    }

    public function configmast() {
        redirect("mastconfig");
    }

    public function configcanvas() {
        redirect("canvasconfig");
    }

    public function configcoursetype() {
        redirect('coursetypeconfig');
    }

    public function configcourse() {
        redirect('courseconfig');
    }

    public function configbooking() {
        redirect('bookingconfig');
    }

    public function calendar() {
        redirect('calendarconfig');
    }

    public function workbook() {
        $data = array();
        $this->load->view('v_wb_head');
        $this->load->view('v_navigation');

        $data['editboat'] = false;
        $data["boatarray"] = $this->boat->getboatnameselect();
        $selectedboat = $this->input->post('sboatid');
        $data["selectedboat"] = $selectedboat;
        $data["selectedboattype"] = null;
        $data["assignmast"] = false;
        if (isset($selectedboat) && $selectedboat != null) {
            echo '<br>boot ausgewählt<br>';
            $boatobject = $this->boat->getboatforid($selectedboat);
            $data['boatobject'] = $boatobject;
            //$mastarray = array();
            $mastarray = $this->mast->getmastarray($boatobject['boatid']);
            $data['mastarrayofboat'] = $mastarray;
            //echo 'eins '.$this->input->post('editboat').'<br>';
            if ($this->input->post('editboat')) {
                echo '<br>edit boot <br>';
                //echo 'zwei <br>';
                //echo "boatedit<br>";
                $data['editboat'] = true;
                //echo 'boatobject'.print_r($boatobject).'<br>';
                $data['boattypeselect'] = $this->boat->getboattypeselect();
            }
            if ($this->input->post('saveboat')) {
                echo '<br>save boot <br>';
//                    $selectedboattype = $this->input->post('sboattypeid');
                //$data["selectedboattype"] = $selectedboattype;
                $boatobject['boattypeid'] = $this->input->post('sboattypeid');
                $boatobject['name'] = $this->input->post('boatname');
                $this->boat->saveboat($boatobject);
            }
            if ($this->input->post('editamast')) {
                echo '<br>einen mast bearbeiten<br>';
                $data['totalmastarray'] = $this->tools->extractdropdownarray(
                        $this->mast->getmastarray(null), 'mastid', 'name');
                $data['selectedmast'] = null;
                $data['editamast'] = true;
            }
            if ($this->input->post('editmast')) {
                echo '<br>ausgew. mast bearbeiten<br>';
                $data['selectedmast'] = $this->mast->getmastforid($this->input->post('smast'));
                $data['editmast'] = true;
                $data['totalmasttypearray'] = $this->mast->getmasttypenameselect(null);
            }
            if ($this->input->post('savemast')) {
                echo '<br>mast speichern<br> :' . print_r($data);
                $mast = $this->mast->getmastforid($this->input->post('mastid'));
                $mast['name'] = $this->input->post('mastname');
                $mast['masttypeid'] = $this->input->post('smasttypeid');
                $mast['boatid'] = $this->input->post('sboatid');
                $this->mast->savemast($mast);
                $data['editmast'] = false;
                $data['editamast'] = false;
            }


//                if($this->input->post('assignmast')){
//                    echo '<br>assign mast<br>';
//                    $data["assignmast"] = true;
//                    $availablemastdropdown = $this->mast->getavailablemastarrayforboattype($boatobject['boattypeid']);
////                    echo '<br><br><br>mastarray:'.$availablemastdropdown.'<br><br><br>';
//                    $data['availablemastarray'] = $this->tools->extractdropdownarray($availablemastdropdown, 'mastid', 'name');
//                    $data['masttoassign'] = null;
//                }
//                $masttoboat = $this->input->post('savemasttoboat');
//                echo 'masttoboat = '.isset($masttoboat);
//                if($this->input->post('savemastbutton')){
//                    echo '<br>mast an boot speichern<br>';
//                    echo '<br>beim speichern<br>'.$masttoboat;
//                    $masttoassign = $this->mast->getmastforid($masttoboat);
//                    $masttoassign['boatid'] = $boatobject['boatid'];
//                    echo '<br>zu speichernder mast:'.print_r($masttoassign).'<br>';
//                    $this->mast->savemast($masttoassign);
//                    $mastarray = $this->mast->getmastarray($boatobject['boatid']);
//                    $data['mastarray'] = $mastarray;
//                }
        }
        $this->load->view('v_wb_body', $data);
        $this->load->view('v_wb_footer');
    }

    public function logo() {
        $this->load->view('v_logo');
    }

    public function footer() {
        $this->load->view('v_footer');
    }

    public function headline() {
        $this->load->view('v_headline');
    }

    public function navigation() {
        $this->load->view('v_navigation');
    }

    public function configureboat() {
        $data = array();
        $this->load->view('v_wb_head');
        $data['editboat'] = false;
        $data["boatarray"] = $this->boat->getboatnameselect();
        $selectedboat = $this->input->post('sboatid');
        $data["selectedboat"] = $selectedboat;
        $data["selectedboattype"] = null;
        $data["assignmast"] = false;
        if (isset($selectedboat) && $selectedboat != null) {
//                echo '<br>boot ausgew&auml;hlt<br>';
            $boatobject = $this->boat->getboatforid($selectedboat);
            $data['boatobject'] = $boatobject;
            //$mastarray = array();
            $mastarray = $this->mast->getmastarray($boatobject['boatid']);
            $data['mastarrayofboat'] = $mastarray;
            //echo 'eins '.$this->input->post('editboat').'<br>';
            if ($this->input->post('editboat')) {
                echo '<br>edit boot <br>';
                //echo 'zwei <br>';
                //echo "boatedit<br>";
                $data['editboat'] = true;
                //echo 'boatobject'.print_r($boatobject).'<br>';
                $data['boattypeselect'] = $this->boat->getboattypeselect();
            }
            if ($this->input->post('saveboat')) {
                echo '<br>save boot <br>';
                $selectedboattype = $this->input->post('sboattypeid');
                //$data["selectedboattype"] = $selectedboattype;
                $boatobject['boattypeid'] = $selectedboattype;
                $boatobject['name'] = $this->input->post('boatname');
                $this->boat->saveboat($boatobject);
            }
            if ($this->input->post('editamast')) {
                echo '<br>einen mast bearbeiten<br>';
                $data['totalmastarray'] = $this->tools->extractdropdownarray(
                        $this->mast->getmastarray(null), 'mastid', 'name');
                $data['selectedmast'] = null;
                $data['editamast'] = true;
            }
            if ($this->input->post('editmast')) {
                echo '<br>ausgew. mast bearbeiten<br>';
                $data['selectedmast'] = $this->mast->getmastforid($this->input->post('smast'));
                $data['editmast'] = true;
                $data['totalmasttypearray'] = $this->mast->getmasttypenameselect(null);
            }
            if ($this->input->post('savemast')) {
                echo '<br>mast speichern<br> :' . print_r($data);
                $mast = $this->mast->getmastforid($this->input->post('mastid'));
                $mast['name'] = $this->input->post('mastname');
                $mast['masttypeid'] = $this->input->post('smasttypeid');
                $mast['boatid'] = $this->input->post('sboatid');
                $this->mast->savemast($mast);
                $data['editmast'] = false;
                $data['editamast'] = false;
            }


//                if($this->input->post('assignmast')){
//                    echo '<br>assign mast<br>';
//                    $data["assignmast"] = true;
//                    $availablemastdropdown = $this->mast->getavailablemastarrayforboattype($boatobject['boattypeid']);
////                    echo '<br><br><br>mastarray:'.$availablemastdropdown.'<br><br><br>';
//                    $data['availablemastarray'] = $this->tools->extractdropdownarray($availablemastdropdown, 'mastid', 'name');
//                    $data['masttoassign'] = null;
//                }
//                $masttoboat = $this->input->post('savemasttoboat');
//                echo 'masttoboat = '.isset($masttoboat);
//                if($this->input->post('savemastbutton')){
//                    echo '<br>mast an boot speichern<br>';
//                    echo '<br>beim speichern<br>'.$masttoboat;
//                    $masttoassign = $this->mast->getmastforid($masttoboat);
//                    $masttoassign['boatid'] = $boatobject['boatid'];
//                    echo '<br>zu speichernder mast:'.print_r($masttoassign).'<br>';
//                    $this->mast->savemast($masttoassign);
//                    $mastarray = $this->mast->getmastarray($boatobject['boatid']);
//                    $data['mastarray'] = $mastarray;
//                }
        }
        $this->load->view('v_wb_body', $data);
        $this->load->view('v_wb_footer');
    }

    /* end of file welcome.php */
    /* location: ./application/controllers/welcome.php */
}
