<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class courseConfig extends CI_Controller {

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
        $this->load->model(array('course', 'tools'));
    }

    public function index() {

        $this->load->view('v_wb_head');
        $this->load->view('v_navigation');
        $data = array();
        $data['editCourse'] = false;
        $selectedCourse = $this->input->post('sCourseID');
        //hier Test ob neues Boot
        if ($this->input->post('newCourse')) {
            $data['newCourseObject'] = $this->course->emptyCourse();
            $data['selectedCourse'] = $this->course->emptyCourse();
            $data['courseTypeSelect'] = $this->course->getCourseTypeSelect();

            //eigtl. verfügbarer und berechtigter KL
//                $data['calendarEntrySelect'] = $this->course>getCalendarEntrySelect();
//                $data['employeeSelect'] =  $this->course->getEmployeeSelect();
        } else {
            // wenn nicht, dann Das augewählte Boot bearbeiten
            $data["selectedCourse"] = $selectedCourse;
            $data["selectedCourseType"] = null;
//                $data["selectedCalendarEntry"] = null;
//                $data["selectedEmployee"] = null;
        }
        if ($this->input->post('saveNewCourse')) {
            $newCourse = $this->course->emptyCourse();
            $newCourse['courseName'] = $this->input->post('courseName');
            $newCourse['CourseTypeID'] = $this->input->post('sCourseTypeID');
//                $newCourse['start'] = $this->input->post('start');
//                $newCourse['end'] = $this->input->post('end');
//                $newCourse["employeeID"] = $this->input->post('sEmployeeID');
            $this->course->saveCourse($newCourse);
        }

//            if ($this->input->post('checkEmployee')){
//                if ($this->course->employeeAvailable($selectedEmployee)) {
//                    $this->tools->alertMessage("Kursleiter stehen für diesen Zeitraum zur Verfügung!");
//                } else {
//                    $this->tools->alertMessage("Kursleiter können aufgrund fehlender Qualifikation oder Zeit nicht zugeordnet werden.");
//                }
//            }
//           $data["assignMast"] = false;
        if ($this->input->post('chooseCourse') || $this->input->post('saveCourse') || $this->input->post('editCourse')) {
//                echo '<br>Boot ausgewählt<br>';
            $courseObject = $this->course->getCourseForID($selectedCourse);
//                $data['calendardetails'] = $this->course->getCalendardetailsForCourseID($selectedCourse);
//                $data['leaderarray'] = $this->course->getEmployeeArrayForCourseID($selectedCourse);
            $data['courseObject'] = $courseObject;

            if ($this->input->post('editCourse')) {
//                    echo '<br>edit Boot <br>';
                $data['editCourse'] = true;
                $data['courseTypeSelect'] = $this->course->getCourseTypeSelect();
//                    $data['calendarEntrySelect'] = $this->course->getCalendardetailsForCourseID();
//                    $data['employeeSelect'] = $this->course->getEmployeeSelect();
            }
            if ($this->input->post('saveCourse')) {
//                    echo '<br>save Boot <br>';
                $courseObject['courseName'] = $this->input->post('courseName');
                $courseObject['courseTypeID'] = $this->input->post('sCourseTypeID');
//                    $courseObject['start'] = $this->input->post('start');
//                    $courseObject['end'] = $this->input->post('end');
//                    $courseObject['calendarEntryID'] = $this->input->post('sCalendarEntryID'); 
//                    $courseObject['employeeID'] = $this->input->post('sEmployeeID');
                $this->course->saveCourse($courseObject);
            }
        }
        if ($this->input->post('deleteCourse')) {
            $this->course->deleteCourse($selectedCourse);
            $this->tools->alertMessage("Kurs wurde gelöscht");
        }
        $data['courseArray'] = $this->course->getCourseNameSelect();
        $this->load->view('v_config_course', $data);
        $this->load->view('v_wb_footer');
    }

    function newCourse($data) {
        return $data;
    }

}
