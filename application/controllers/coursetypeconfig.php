<?php

/*
 * to change this license header, choose license headers in project properties.
 * to change this template file, choose tools | templates
 * and open the template in the editor.
 */

class coursetypeconfig extends CI_Controller {

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
        $this->load->model('coursetype');
        $this->load->model('boat');
        $this->load->model('tools');
    }

    public function index() {
        if ($this->session->userdata('login_state') === true) {

            $this->load->view('v_wb_head');
            $this->load->view('v_navigation');
            $data = array();
            $data['editcoursetype'] = false;
            $selectedcoursetype = $this->input->post('scoursetypeid');
            //hier test ob neues boot
            if ($this->input->post('newcoursetype')) {
                //$data = newboat($data);
                $data['newcoursetypeobject'] = $this->coursetype->emptycoursetype();
                $data['selectedcoursetype'] = $this->coursetype->emptycoursetype();
                $data['boattypeselect'] = $this->coursetype->getboattypeselect();
                $data['licenseselect'] = $this->coursetype->getlicenseselect();
            } else {
                // wenn nicht, dann das augewählte boot bearbeiten
                $data["selectedcoursetype"] = $selectedcoursetype;
                $data["selectedboattype" && 'selectedlicense'] = null;
            }
            if ($this->input->post('savenewcoursetype')) {
                $newcoursetype = $this->coursetype->emptycoursetype();
                $newcoursetype["c_typename"] = $this->input->post('coursetypename');
                $newcoursetype['description'] = $this->input->post('description');
                $newcoursetype['durationdays'] = $this->input->post('durationdays');
                $newcoursetype['durationhours'] = $this->input->post('durationhours');
                $newcoursetype['minparticipants'] = $this->input->post('minparticipants');
                $newcoursetype['maxparticipants'] = $this->input->post('maxparticipants');
                $newcoursetype['numberofcourseleaders'] = $this->input->post('numberofcourseleaders');
                $newcoursetype['salary'] = $this->input->post('salary');
                $newcoursetype['price'] = $this->input->post('price');
                $newcoursetype['priceexam'] = $this->input->post('priceexam');
                $newcoursetype['boattypeid'] = $this->input->post('sboattypeid');
                $newcoursetype['licenseid'] = $this->input->post('slicenseid');
                $this->coursetype->savecoursetype($newcoursetype);
            }

            if ($this->input->post('choosecoursetype') || $this->input->post('savecoursetype') || $this->input->post('editcoursetype')) {
    //                echo '<br>boot ausgewählt<br>';
                $coursetypeobject = $this->coursetype->getcoursetypeforid($selectedcoursetype);
                $data['coursetypeobject'] = $coursetypeobject;
    //            print_r($coursetypeobject);
    //            print_r($this->boat->getboatarrayreadyforperiodforboattype('2012-01-01', '2012-01-01', $coursetypeobject['boattypeid']));

                if ($this->input->post('editcoursetype')) {
    //                    echo '<br>edit boot <br>';
                    $data['editcoursetype'] = true;
                    $data['boattypeselect'] = $this->coursetype->getboattypeselect();
                    $data['licenseselect'] = $this->coursetype->getlicenseselect();
                }
                if ($this->input->post('savecoursetype')) {
    //                    echo '<br>save boot <br>';
                    $coursetypeobject['boattypeid'] = $this->input->post('sboattypeid');
                    $coursetypeobject['licenseid'] = $this->input->post('slicenseid');
                    $coursetypeobject['c_typename'] = $this->input->post('coursetypename');
                    $coursetypeobject['description'] = $this->input->post('description');
                    $coursetypeobject['durationdays'] = $this->input->post('durationdays');
                    $coursetypeobject['durationhours'] = $this->input->post('durationhours');
                    $coursetypeobject['minparticipants'] = $this->input->post('minparticipants');
                    $coursetypeobject['maxparticipants'] = $this->input->post('maxparticipants');
                    $coursetypeobject['numberofcourseleaders'] = $this->input->post('numberofcourseleaders');
                    $coursetypeobject['salary'] = $this->input->post('salary');
                    $coursetypeobject['price'] = $this->input->post('price');
                    $coursetypeobject['priceexam'] = $this->input->post('priceexam');
                    $this->coursetype->savecoursetype($coursetypeobject);
                }
            }
            if ($this->input->post('deletecoursetype')) {
                $this->coursetype->deletecoursetype($selectedcoursetype);
                $this->tools->alertmessage("Kurstyp wurde gelöscht.");
            }
            $data["coursetypearray"] = $this->coursetype->getcoursetypenameselect();
            $this->load->view('v_config_coursetype', $data);

            $this->load->view('v_wb_footer');
        } else {
            //redirect to http://xyz.de/login.html
            redirect("login");
        }
    }

    function newcoursetype($data) {
        return $data;
    }

}
