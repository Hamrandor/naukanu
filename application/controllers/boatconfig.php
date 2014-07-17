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
class boatconfig extends CI_Controller {

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
        if ($this->session->userdata('login_state') === true) {
            //hier könnte man nun das entsprechende view laden.
            $this->load->view('v_wb_head');
            $this->load->view('v_navigation');
            $data = array();
            $data['editboat'] = false;
            $selectedboat = $this->input->post('sboatid');
            //hier test ob neues boot
            if ($this->input->post('newboat')) {
                //$data = newboat($data);
                $data['newboatobject'] = $this->boat->emptyboat();
                $data['selectedboat'] = $this->boat->emptyboat();
                $data['boattypeselect'] = $this->boat->getboattypeselect();
                $data['conditionselect'] = $this->condition->getconditionselect();
            } else {
                // wenn nicht, dann das augewählte boot bearbeiten
                $data["selectedboat"] = $selectedboat;
                $data["selectedboattype"] = null;
            }
            if ($this->input->post('savenewboat')) {
                $newboat = $this->boat->emptyboat();
                $newboat["name"] = $this->input->post('boatname');
                $newboat["boattypeid"] = $this->input->post('sboattypeid');
                $newboat["conditionid"] = $this->input->post('sconditionid');
                $this->boat->saveboat($newboat);
            }

            if ($this->input->post('checkboat')) {
                if ($this->boat->boatreadyforuse($selectedboat)) {
                    $this->tools->alertmessage("boot einsatzbereit!");
                } else {
                    $this->tools->alertmessage("boot fehlerhaft konfiguriert.");
                }
            }

//           $data["assignmast"] = false;
            if ($this->input->post('chooseboat') || $this->input->post('saveboat') || $this->input->post('editboat')) {
//                echo '<br>boot ausgewählt<br>';
                $boatobject = $this->boat->getboatforid($selectedboat);
                $data['boatobject'] = $boatobject;
                $mastarray = array();
                $mastarray = $this->mast->getmastarray($boatobject['boatid']);
                $data['mastarrayofboat'] = $mastarray;
                if ($this->input->post('editboat')) {
//                    echo '<br>edit boot <br>';
                    $data['editboat'] = true;
                    $data['boattypeselect'] = $this->boat->getboattypeselect();
                }
                if ($this->input->post('saveboat')) {
//                    echo '<br>save boot <br>';
                    $boatobject['boattypeid'] = $this->input->post('sboattypeid');
                    $boatobject['name'] = $this->input->post('boatname');
                    $this->boat->saveboat($boatobject);
                }
            }

            if ($this->input->post('deleteboat')) {
                $this->boat->deleteboat($selectedboat);
                $this->tools->alertmessage("boot wurde gelöscht.");
            }
            $data["boatarray"] = $this->boat->getboatnameselect();

            $this->load->view('v_config_boat', $data);

            $this->load->view('v_wb_footer');
        } else {
            //redirect to http://xyz.de/login.html
            redirect("login");
        }

        function newboat($data) {
            return $data;
        }

    }

}
