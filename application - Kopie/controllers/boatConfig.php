<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of boatConfig
 *
 * @author Jens
 */
class boatConfig extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        //Laden der form helper
        $this->load->helper(array('form', 'html', 'url'));
        //Laden der form_validation library sowie der session library
        //Zur verwendung von sessions und form_validations
        $this->load->library(array('form_validation', 'session'));
        //Laden unserer models (/application/models/user.php)
        //Methoden des models können dann verwendet werden mit z. B. $this->user->[..];
        $this->load->model(array('user', 'boat', 'mast', 'canvas', 'tools', 'condition'));
    }

    public function index() {
        if ($this->session->userdata('login_state') === TRUE) {
            //hier könnte man nun das entsprechende view laden.
            $this->load->view('v_wb_head');
            $this->load->view('v_navigation');
            $data = array();
            $data['editBoat'] = false;
            $selectedBoat = $this->input->post('sBoatID');
            //hier Test ob neues Boot
            if ($this->input->post('newBoat')) {
                //$data = newBoat($data);
                $data['newBoatObject'] = $this->boat->emptyBoat();
                $data['selectedBoat'] = $this->boat->emptyBoat();
                $data['boatTypeSelect'] = $this->boat->getBoatTypeSelect();
                $data['conditionSelect'] = $this->condition->getConditionSelect();
            } else {
                // wenn nicht, dann Das augewählte Boot bearbeiten
                $data["selectedBoat"] = $selectedBoat;
                $data["selectedBoatType"] = null;
            }
            if ($this->input->post('saveNewBoat')) {
                $newBoat = $this->boat->emptyBoat();
                $newBoat["name"] = $this->input->post('boatName');
                $newBoat["boatTypeID"] = $this->input->post('sBoatTypeID');
                $newBoat["conditionID"] = $this->input->post('sConditionID');
                $this->boat->saveBoat($newBoat);
            }

            if ($this->input->post('checkBoat')) {
                if ($this->boat->boatReadyforUse($selectedBoat)) {
                    $this->tools->alertMessage("Boot einsatzbereit!");
                } else {
                    $this->tools->alertMessage("Boot fehlerhaft konfiguriert.");
                }
            }

//           $data["assignMast"] = false;
            if ($this->input->post('chooseBoat') || $this->input->post('saveBoat') || $this->input->post('editBoat')) {
//                echo '<br>Boot ausgewählt<br>';
                $boatObject = $this->boat->getBoatForID($selectedBoat);
                $data['boatObject'] = $boatObject;
                $mastArray = array();
                $mastArray = $this->mast->getMastArray($boatObject['boatID']);
                $data['mastarrayofBoat'] = $mastArray;
                if ($this->input->post('editBoat')) {
//                    echo '<br>edit Boot <br>';
                    $data['editBoat'] = true;
                    $data['boatTypeSelect'] = $this->boat->getBoatTypeSelect();
                }
                if ($this->input->post('saveBoat')) {
//                    echo '<br>save Boot <br>';
                    $boatObject['boatTypeID'] = $this->input->post('sBoatTypeID');
                    $boatObject['name'] = $this->input->post('boatName');
                    $this->boat->saveBoat($boatObject);
                }
            }

            if ($this->input->post('deleteBoat')) {
                $this->boat->deleteBoat($selectedBoat);
                $this->tools->alertMessage("Boot wurde gelöscht.");
            }
            $data["boatArray"] = $this->boat->getBoatNameSelect();

            $this->load->view('v_config_boat', $data);

            $this->load->view('v_wb_footer');
        } else {
            //Redirect to http://xyz.de/login.html
            redirect("login");
        }

        function newBoat($data) {
            return $data;
        }

    }

}
