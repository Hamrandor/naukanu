<?php

/*
 * to change this license header, choose license headers in project properties.
 * to change this template file, choose tools | templates
 * and open the template in the editor.
 */

class bookingconfig extends CI_Controller {

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
        $this->load->model(array('booking', 'tools', 'calendarentry'));
    }

    public function index() {
        $this->load->view('v_wb_head');
        $this->load->view('v_navigation');
        $data = array();
        $data['editbooking'] = false;

        $selectedbooking = $this->input->post('sbookingid');
        //hier test ob neues boot
        if ($this->input->post('newbooking')) {
            //$data = newboat($data);
            $data['newbookingobject'] = $this->booking->emptybooking();
            $data['selectedbooking'] = $this->booking->emptybooking();
            $data['courseselect'] = $this->booking->getcourseselect();
            $data['customerselect'] = $this->booking->getcustomerselect();
            $data['boatselect'] = $this->booking->getboatselect();
            $data['examselect'] = $this->booking->getexamselect();
        } else {
            // wenn nicht, dann das augewählte boot bearbeiten
            $data["selectedbooking"] = $selectedbooking;
            $data["selectedcourse"] = null;
            $data["selectedcustomer"] = null;
            $data["selectedboat"] = null;
            $data["selectedexam"] = null;
        }
        if ($this->input->post('savenewbooking')) {
            $newbooking = $this->booking->emptybooking();
//                $newbooking['bookingid'] = $this->input->post ('bookingno');
            $newbooking['courseid'] = $this->input->post('scourseid');
            $newbooking['customerid'] = $this->input->post('scustomerid');
            $newbooking['boatid'] = $this->input->post('sboatid');
            $newbooking['examid'] = $this->input->post('sexamid');
//                print_r($newbooking);
//                $test= $this->input->post();
//                print_r($test);
            if ($this->calendarentry->checkboatassignmenttocourse($newbooking['boatid'], $newbooking['courseid'])){
                $this->booking->savebooking($newbooking);
            } else {
                $this->tools->alertmessage("Boot ist an einem Termin bereits gebucht");
            }
        }

        if ($this->input->post('choosebooking') || $this->input->post('savebooking') || $this->input->post('editbooking')) {
//                echo '<br>boot ausgewählt<br>';
            $bookingobject = $this->booking->getbookingforid($selectedbooking);
            $data['bookingobject'] = $bookingobject;
//                print_r($bookingobject);
//                print_r($this->boat->getboatarrayreadyforperiodforboattype('2012-01-01', '2012-01-01', $bookingobject['boattypeid']));

            if ($this->input->post('editbooking')) {
//                    echo '<br>edit boot <br>';
//                print_r($bookingobject);
                $data['editbooking'] = true;
                $data['courseselect'] = $this->booking->getcourseselect();
                $data['customerselect'] = $this->booking->getcustomerselect();
                $data['boatselect'] = $this->booking->getboatselect();
                $data['examselect'] = $this->booking->getexamselect();
            }
            if ($this->input->post('savebooking')) {
                //$bookingobject['bookingid'] = $this->input->post('bookingno');
                $bookingobject['courseid'] = $this->input->post('scourseid');
                $bookingobject['customerid'] = $this->input->post('scustomerid');
                $bookingobject['boatid'] = $this->input->post('sboatid');
                $bookingobject['examid'] = $this->input->post('sexamid');
                if ($this->calendarentry->checkboatassignmenttocourse($bookingobject['boatid'], $bookingobject['courseid'])){
                    $this->booking->savebooking($bookingobject);
                } else {
                    $this->tools->alertmessage("Boot ist an einem Termin bereits gebucht");
                }
                
            }
        }
        if ($this->input->post('deletebooking')) {
            $this->course->deletecourse($selectedbooking);
            $this->tools->alertmessage("buchung wurde gelöscht");
        }
        $data["bookingarray"] = $this->booking->getbookingnameselect();
        $this->load->view('v_config_booking', $data);
        $this->load->view('v_wb_footer');
    }

    function newbooking($data) {
        return $data;
    }
    
    
    function sendemail(){
        $data = array();
        $bookingid = $this->input->post('bookingid');
        if (isset($bookingid) && $bookingid != null) {
            $bookingobject = $this->booking->getbookingforid($bookingid);
    //        $this->email->bcc('them@their-example.com')
    //         
            $this->load->library('email');
            $config['charset'] = 'utf-8';
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->from('jens@jeschke.biz', 'Jens Jeschke');
            $this->email->to($bookingobject['email']);
            $this->email->subject('Buchungsbestätigung');
            $this->email->message(
                    'Sehr geehrte(r) '.$bookingobject['salutation'].$bookingobject['c_name'].','.br(2)
                    .'hiermit bestätigen wir die Buchung des Kurses '.$bookingobject['coursename'].br()
                    .'Ihr zugeordnetes Boot ist : '.$bookingobject['b_name'].br()
                    .'Die gebuchte Prüfung ist : '.$bookingobject['e_name'].br()
                    .'Mit freundlichen Grüßen'.br(2)
                    .'Ihre Naukanu Sailing School');
            $this->email->send();
            $data["message"] = 'Ihre Mail wurde verschickt!';
        } else {
            $data["message"] = 'Mailversand fehlgeschlagen!';
        }
            

        $data['selectedbooking'] = $bookingid;
        $data["bookingarray"] = $this->booking->getbookingnameselect();
        $this->load->view('v_wb_head');
        $this->load->view('v_navigation');
        $this->load->view('v_config_booking', $data);
        $this->load->view('v_wb_footer');
    }

}
