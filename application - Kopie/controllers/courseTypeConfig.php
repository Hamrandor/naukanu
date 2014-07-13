<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class courseTypeConfig extends CI_Controller {

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
        $this->load->model('coursetype');
        $this->load->model('boat');
        $this->load->model('tools');
    }

    public function index() {
        $this->load->view('v_wb_head');
        $this->load->view('v_navigation');
        $data = array();
        $data['editCourseType'] = false;
        $selectedCourseType = $this->input->post('sCourseTypeID');
        //hier Test ob neues Boot
        if ($this->input->post('newCourseType')) {
            //$data = newBoat($data);
            $data['newCourseTypeObject'] = $this->coursetype->emptyCourseType();
            $data['selectedCourseType'] = $this->coursetype->emptyCourseType();
            $data['boatTypeSelect'] = $this->coursetype->getBoatTypeSelect();
            $data['licenseSelect'] = $this->coursetype->getLicenseSelect();
        } else {
            // wenn nicht, dann Das augewählte Boot bearbeiten
            $data["selectedCourseType"] = $selectedCourseType;
            $data["selectedBoatType" && 'selectedLicense'] = null;
        }
        if ($this->input->post('saveNewCourseType')) {
            $newCourseType = $this->coursetype->emptyCourseType();
            $newCourseType["c_typename"] = $this->input->post('courseTypeName');
            $newCourseType['description'] = $this->input->post('description');
            $newCourseType['durationDays'] = $this->input->post('durationDays');
            $newCourseType['durationHours'] = $this->input->post('durationHours');
            $newCourseType['minParticipants'] = $this->input->post('minParticipants');
            $newCourseType['maxParticipants'] = $this->input->post('maxParticipants');
            $newCourseType['numberOfCourseLeaders'] = $this->input->post('numberOfCourseLeaders');
            $newCourseType['salary'] = $this->input->post('salary');
            $newCourseType['price'] = $this->input->post('price');
            $newCourseType['priceExam'] = $this->input->post('priceExam');
            $newCourseType['boatTypeID'] = $this->input->post('sBoatTypeID');
            $newCourseType['licenseID'] = $this->input->post('sLicenseID');
            $this->coursetype->saveCourseType($newCourseType);
        }

        if ($this->input->post('chooseCourseType') || $this->input->post('saveCourseType') || $this->input->post('editCourseType')) {
//                echo '<br>Boot ausgewählt<br>';
            $courseTypeObject = $this->coursetype->getCourseTypeForID($selectedCourseType);
            $data['courseTypeObject'] = $courseTypeObject;
            print_r($courseTypeObject);
            print_r($this->boat->getBoatArrayReadyForPeriodForBoatType('2012-01-01', '2012-01-01', $courseTypeObject['boatTypeID']));

            if ($this->input->post('editCourseType')) {
//                    echo '<br>edit Boot <br>';
                $data['editCourseType'] = true;
                $data['boatTypeSelect'] = $this->coursetype->getBoatTypeSelect();
                $data['licenseSelect'] = $this->coursetype->getLicenseSelect();
            }
            if ($this->input->post('saveCourseType')) {
//                    echo '<br>save Boot <br>';
                $courseTypeObject['boatTypeID'] = $this->input->post('sBoatTypeID');
                $courseTypeObject['licenseID'] = $this->input->post('sLicenseID');
                $courseTypeObject['c_typename'] = $this->input->post('courseTypeName');
                $courseTypeObject['description'] = $this->input->post('description');
                $courseTypeObject['durationDays'] = $this->input->post('durationDays');
                $courseTypeObject['durationHours'] = $this->input->post('durationHours');
                $courseTypeObject['minParticipants'] = $this->input->post('minParticipants');
                $courseTypeObject['maxParticipants'] = $this->input->post('maxParticipants');
                $courseTypeObject['numberOfCourseLeaders'] = $this->input->post('numberOfCourseLeaders');
                $courseTypeObject['salary'] = $this->input->post('salary');
                $courseTypeObject['price'] = $this->input->post('price');
                $courseTypeObject['priceExam'] = $this->input->post('priceExam');
                $this->coursetype->saveCourseType($courseTypeObject);
            }
        }
        if ($this->input->post('deleteCourseType')) {
            $this->coursetype->deleteCourseType($selectedCourseType);
            $this->tools->alertMessage("Kurstyp wurde gelöscht.");
        }

        $data["courseTypeArray"] = $this->coursetype->getCourseTypeNameSelect();
        $this->load->view('v_config_coursetype', $data);

        $this->load->view('v_wb_footer');
    }

    function newCourseType($data) {
        return $data;
    }

}
