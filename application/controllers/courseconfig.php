<?php

/*
 * to change this license header, choose license headers in project properties.
 * to change this template file, choose tools | templates
 * and open the template in the editor.
 */

class courseconfig extends CI_Controller {

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
        $this->load->model(array('course', 'tools'));
    }

    public function index() {
        if ($this->session->userdata('login_state') === true) {
            $this->load->view('v_wb_head');
            $this->load->view('v_navigation');
            $data = array();
            $data['editcourse'] = false;
            $selectedcourse = $this->input->post('scourseid');
            //hier test ob neues boot
            if ($this->input->post('newcourse')) {
                $data['newcourseobject'] = $this->course->emptycourse();
                $data['selectedcourse'] = $this->course->emptycourse();
                $data['coursetypeselect'] = $this->course->getcoursetypeselect();

                //eigtl. verfügbarer und berechtigter kl
    //                $data['calendarentryselect'] = $this->course>getcalendarentryselect();
    //                $data['employeeselect'] =  $this->course->getemployeeselect();
            } else {
                // wenn nicht, dann das augewählte boot bearbeiten
                $data["selectedcourse"] = $selectedcourse;
                $data["selectedcoursetype"] = null;
    //                $data["selectedcalendarentry"] = null;
    //                $data["selectedemployee"] = null;
            }
            if ($this->input->post('savenewcourse')) {
                $newcourse = $this->course->emptycourse();
                $newcourse['coursename'] = $this->input->post('coursename');
                $newcourse['coursetypeid'] = $this->input->post('scoursetypeid');
    //                $newcourse['start'] = $this->input->post('start');
    //                $newcourse['end'] = $this->input->post('end');
    //                $newcourse["employeeid"] = $this->input->post('semployeeid');
                $this->course->savecourse($newcourse);
            }

    //            if ($this->input->post('checkemployee')){
    //                if ($this->course->employeeavailable($selectedemployee)) {
    //                    $this->tools->alertmessage("kursleiter stehen für diesen zeitraum zur verfügung!");
    //                } else {
    //                    $this->tools->alertmessage("kursleiter können aufgrund fehlender qualifikation oder zeit nicht zugeordnet werden.");
    //                }
    //            }
    //           $data["assignmast"] = false;
            if ($this->input->post('choosecourse') || $this->input->post('savecourse') || $this->input->post('editcourse')) {
    //                echo '<br>boot ausgewählt<br>';
                $courseobject = $this->course->getcourseforid($selectedcourse);
    //                $data['calendardetails'] = $this->course->getcalendardetailsforcourseid($selectedcourse);
    //                $data['leaderarray'] = $this->course->getemployeearrayforcourseid($selectedcourse);
                $data['courseobject'] = $courseobject;

                if ($this->input->post('editcourse')) {
    //                    echo '<br>edit boot <br>';
                    $data['editcourse'] = true;
                    $data['coursetypeselect'] = $this->course->getcoursetypeselect();
    //                    $data['calendarentryselect'] = $this->course->getcalendardetailsforcourseid();
    //                    $data['employeeselect'] = $this->course->getemployeeselect();
                }
                if ($this->input->post('savecourse')) {
    //                    echo '<br>save boot <br>';
                    $courseobject['coursename'] = $this->input->post('coursename');
                    $courseobject['coursetypeid'] = $this->input->post('scoursetypeid');
    //                    $courseobject['start'] = $this->input->post('start');
    //                    $courseobject['end'] = $this->input->post('end');
    //                    $courseobject['calendarentryid'] = $this->input->post('scalendarentryid'); 
    //                    $courseobject['employeeid'] = $this->input->post('semployeeid');
                    $this->course->savecourse($courseobject);
                }
            }
            if ($this->input->post('deletecourse')) {
                $this->course->deletecourse($selectedcourse);
                $this->tools->alertmessage("Kurs wurde gelöscht");
            }
            $data['coursearray'] = $this->course->getcoursenameselect();
            $this->load->view('v_config_course', $data);
            $this->load->view('v_wb_footer');
        } else {
            //redirect to http://xyz.de/login.html
            redirect("login");
        }

    }

    function newcourse($data) {
        return $data;
    }

}
