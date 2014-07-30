<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class leaderavailability extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('availability', 'course'));
        $this->jquery->script(base_url() . 'js/jquery/jquery.js', TRUE);
    }

    public function index($year = NULL, $month = NULL) {
        if (!$year) {
            $year = date('Y');
        }
        if (!$month) {
            $month = date('m');
        }
        $this->showcalendar($year, $month);
    }

    public function showcalendar($year = NULL, $month = NULL) {
        $this->availability->java_functions();
        if ($this->input->post('day')) {

            $day = $this->input->post('day');
            $event = trim($this->input->post('event'));
            $date = "$year-$month-$day";
            $employee = $this->input->post('semployeeid');
//            $course = $this->input->post('scourseid');
            
//            echo 'lkhjdfaskfhjksfhsghjfaksöfhduifahfd';
            $this->availability->add_events($date, $event, $employee);
        }

        if ($this->input->post('day_to_delete')) {

            $day = $this->input->post('day_to_delete');
            $date = "$year-$month-$day";
            $this->availability->delete_event($date);
        }

        $data['title'] = 'Kursleiterverfügbarkeit';
        $data['calendar'] = $this->availability->generate_calendar($year, $month);
//        $data['coursearray'] = $this->course->getcoursenameselect();
        $data['employeearray'] = $this->course->getemployeeselect();

        //echo $this->calendar-> generate($year, $month, $events);
        $this->load->view('v_wb_head');
        $this->load->view('v_navigation');

//        $this->load->view('v_calendar', $data);
        $this->load->view('v_calendarheader', $data);
        $this->load->view('v_leaderentry', $data);
        $this->load->view('v_wb_footer');
    }

}