<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of task
 *
 * @author Jens
 */
class taskAdministrator extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Laden der form helper
//        $this->load->helper(array('form', 'html', 'url'));
        //Laden der form_validation library sowie der session library
        //Zur verwendung von sessions und form_validations
//        $this->load->library(array('form_validation', 'session'));
        //Laden unserer models (/application/models/user.php)
        //Methoden des models können dann verwendet werden mit z. B. $this->user->[..];
        $this->load->model('task');
        $this->load->library('Table');
    }

    public function index() {
        $this->filterTask();
//        $data = array();
//        $taskList = array();
//        foreach ($this->task->getPerformerTaskArrayForUsername($this->session->userdata('username')) as $task){
//            $taskList[$task['ticketID']] = $task['name'];
//        }
//        $data['myTaskList'] = $taskList;
//        $this->loadPage($data);
    }

    //put your code here

    function loadPage($data) {
        if ($this->session->userdata('login_state') === TRUE) {
            //hier könnte man nun das entsprechende view laden.
            $this->load->view('v_wb_head');
            $this->load->view('v_navigation');
            $this->load->view('v_task', $data);
            $this->load->view('v_wb_footer');
        } else {
            //Redirect to http://xyz.de/login.html
            redirect("login");
        }
    }

    public function selectTask() {
//        $performer = $this->input->post('sPerformerID');
        $data = array();
        if ($this->input->post('create_Task')) {
            $data['sTask'] = $this->task->emptyTask();
            $data['ownTask'] = true;
        } else {
            $sTaskID = $this->input->post('sTicketID');
            $data['sTask'] = $this->task->getTaskForID($sTaskID);
            $data['ownTask'] = $this->input->post('created');
        }
        $data['statusArray'] = $this->task->getTicketStatusArray();
        $data['employeeArray'] = $this->task->getEmployeeSelect(NULL);
        $data['dayArray'] = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10',
            '11', '12', '13', '14', '15', '16', '17', '18', '19', '20',
            '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');
        $data['monthArray'] = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
        $data['yearArray'] = array('2014', '2015', '2016', '2017', '2018', '2019', '2020');
        $data['sDay'] = array_search(date('d'), $data['dayArray']);
        $data['sMonth'] = array_search(date('m'), $data['monthArray']);
        $data['sYear'] = array_search(date('Y'), $data['yearArray']);
        // $test = new DateTime('02/31/2011');
        $data['user'] = $this->task->getUser($this->session->userdata('username'));

        $this->loadPage($data);
    }

    public function saveTask() {
        $ticketID = $this->input->post('sTicketID');
        echo 'ticketID = ' . $ticketID . br();
        if (isset($ticketID) && $ticketID != null) {
            $currentTask = $this->task->getTaskForID($this->input->post('sTicketID'));
        } else {
            $currentTask = $this->task->emptyTask();
        }
        $initiatorID = $this->input->post('sInitiatorID');
        if (isset($initiatorID) && $initiatorID != null) {
            $currentTask['initiatorID'] = $initiatorID;
        } else {
            $user = $this->task->getUser($this->session->userdata('username'));
            $currentTask['initiatorID'] = $user['employeeID'];
        }

        $performerID = $this->input->post('sPerformerID');
        if (isset($performerID) && $performerID != null) {
            $currentTask['performerID'] = $performerID;
        }
        $sDay = $this->input->post('sDay');
        $sMonth = $this->input->post('sMonth');
        $sYear = $this->input->post('sYear');
        $data['dayArray'] = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10',
            '11', '12', '13', '14', '15', '16', '17', '18', '19', '20',
            '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');
        $data['monthArray'] = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
        $data['yearArray'] = array('2014', '2015', '2016', '2017', '2018', '2019', '2020');
        if (isset($sDay) && isset($sMonth) && isset($sYear)) {
            $currentTask['dueDate'] = $data['yearArray'][$sYear] . '-' . $data['monthArray'][$sMonth] . '-' . $data['dayArray'][$sDay];
        }
        $comment = $this->input->post('comment');
        if (isset($comment) && $comment != null) {
            $currentTask['comment'] = $comment;
        }
        $ticketStatusID = $this->input->post('sTicketStatusID');
        if (isset($ticketStatusID) && $ticketStatusID != null) {
            $currentTask['ticketStatusID'] = $ticketStatusID;
        }
        $taskName = $this->input->post('taskName');
        if (isset($taskName) && $taskName != null) {
            $currentTask['name'] = $taskName;
        }
        $this->task->saveTask($currentTask);
        $this->filterTask();
    }

    function filterTask() {
        $data = array();
        $taskList = array();
        if ($this->input->post('created')) {
            foreach ($this->task->getInitiatorTaskArrayForUsername($this->session->userdata('username')) as $task) {
                $taskList[$task['ticketID']] = $task['name'];
            }
            $data['created'] = true;
        } else {
            foreach ($this->task->getPerformerTaskArrayForUsername($this->session->userdata('username')) as $task) {
                $taskList[$task['ticketID']] = $task['name'];
            }
            $data['created'] = false;
        }

        $data['myTaskList'] = $taskList;
        $this->loadPage($data);
    }

}
