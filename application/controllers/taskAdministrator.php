<?php

/*
 * to change this license header, choose license headers in project properties.
 * to change this template file, choose tools | templates
 * and open the template in the editor.
 */

/**
 * description of task
 *
 * @author jens
 */
class taskadministrator extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //laden der form helper
//        $this->load->helper(array('form', 'html', 'url'));
        //laden der form_validation library sowie der session library
        //zur verwendung von sessions und form_validations
//        $this->load->library(array('form_validation', 'session'));
        //laden unserer models (/application/models/user.php)
        //methoden des models können dann verwendet werden mit z. b. $this->user->[..];
        $this->load->model('task');
        $this->load->library('table');
    }

    public function index() {
        $this->filtertask();
//        $data = array();
//        $tasklist = array();
//        foreach ($this->task->getperformertaskarrayforusername($this->session->userdata('username')) as $task){
//            $tasklist[$task['ticketid']] = $task['name'];
//        }
//        $data['mytasklist'] = $tasklist;
//        $this->loadpage($data);
    }

    //put your code here

    function loadpage($data) {
        if ($this->session->userdata('login_state') === true) {
            //hier könnte man nun das entsprechende view laden.
            $this->load->view('v_wb_head');
            $this->load->view('v_navigation');
            $this->load->view('v_task', $data);
            $this->load->view('v_wb_footer');
        } else {
            //redirect to http://xyz.de/login.html
            redirect("login");
        }
    }

    public function selecttask() {
//        $performer = $this->input->post('sperformerid');
        $data = array();
        if ($this->input->post('create_task')) {
            $data['stask'] = $this->task->emptytask();
            $data['owntask'] = true;
        } else {
            $staskid = $this->input->post('sticketid');
            $data['stask'] = $this->task->gettaskforid($staskid);
            $data['owntask'] = $this->input->post('created');
        }
        $data['statusarray'] = $this->task->getticketstatusarray();
        $data['employeearray'] = $this->task->getemployeeselect(null);
        $data['dayarray'] = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10',
            '11', '12', '13', '14', '15', '16', '17', '18', '19', '20',
            '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');
        $data['montharray'] = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
        $data['yeararray'] = array('2014', '2015', '2016', '2017', '2018', '2019', '2020');
        $data['sday'] = array_search(date('d'), $data['dayarray']);
        $data['smonth'] = array_search(date('m'), $data['montharray']);
        $data['syear'] = array_search(date('y'), $data['yeararray']);
        // $test = new datetime('02/31/2011');
        $data['user'] = $this->task->getuser($this->session->userdata('username'));

        $this->loadpage($data);
    }

    public function savetask() {
        $ticketid = $this->input->post('sticketid');
        echo 'ticketid = ' . $ticketid . br();
        if (isset($ticketid) && $ticketid != null) {
            $currenttask = $this->task->gettaskforid($this->input->post('sticketid'));
        } else {
            $currenttask = $this->task->emptytask();
        }
        $initiatorid = $this->input->post('sinitiatorid');
        if (isset($initiatorid) && $initiatorid != null) {
            $currenttask['initiatorid'] = $initiatorid;
        } else {
            $user = $this->task->getuser($this->session->userdata('username'));
            $currenttask['initiatorid'] = $user['employeeid'];
        }

        $performerid = $this->input->post('sperformerid');
        if (isset($performerid) && $performerid != null) {
            $currenttask['performerid'] = $performerid;
        }
        $sday = $this->input->post('sday');
        $smonth = $this->input->post('smonth');
        $syear = $this->input->post('syear');
        $data['dayarray'] = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10',
            '11', '12', '13', '14', '15', '16', '17', '18', '19', '20',
            '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');
        $data['montharray'] = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
        $data['yeararray'] = array('2014', '2015', '2016', '2017', '2018', '2019', '2020');
        if (isset($sday) && isset($smonth) && isset($syear)) {
            $currenttask['duedate'] = $data['yeararray'][$syear] . '-' . $data['montharray'][$smonth] . '-' . $data['dayarray'][$sday];
        }
        $comment = $this->input->post('comment');
        if (isset($comment) && $comment != null) {
            $currenttask['comment'] = $comment;
        }
        $ticketstatusid = $this->input->post('sticketstatusid');
        if (isset($ticketstatusid) && $ticketstatusid != null) {
            $currenttask['ticketstatusid'] = $ticketstatusid;
        }
        $taskname = $this->input->post('taskname');
        if (isset($taskname) && $taskname != null) {
            $currenttask['name'] = $taskname;
        }
        $this->task->savetask($currenttask);
        $this->filtertask();
    }

    function filtertask() {
        $data = array();
        $tasklist = array();
        if ($this->input->post('created')) {
            foreach ($this->task->getinitiatortaskarrayforusername($this->session->userdata('username')) as $task) {
                $tasklist[$task['ticketid']] = $task['name'];
            }
            $data['created'] = true;
        } else {
            foreach ($this->task->getperformertaskarrayforusername($this->session->userdata('username')) as $task) {
                $tasklist[$task['ticketid']] = $task['name'];
            }
            $data['created'] = false;
        }

        $data['mytasklist'] = $tasklist;
        $this->loadpage($data);
    }

}
