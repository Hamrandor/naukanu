<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class calendarConfig extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('calendar');
    }
    
    public function index($year = NULL, $month = NULL){
        $this->showCalendar($year, $month);
    }
    
    public function showCalendar($year = NULL, $month = NULL){
        $data['title']= 'Kursuebersicht';
        $data['calendar'] = $this->calendar->generate_calendar($year,$month);


        //echo $this->calendar-> generate($year, $month, $events);
        $this->load->view('v_wb_head');
        $this->load->view('v_navigation');

        $this->load->view('v_calendar', $data);
        $this->load->view('v_wb_footer');
        
    }
}