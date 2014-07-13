<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class bookingConfig extends CI_Controller {

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
        $this->load->model(array('booking', 'tools'));
    }

    public function index() {
        $this->load->view('v_wb_head');
        $this->load->view('v_navigation');
        $data = array();
        $data['editBooking'] = false;

        $selectedBooking = $this->input->post('sBookingID');
        //hier Test ob neues Boot
        if ($this->input->post('newBooking')) {
            //$data = newBoat($data);
            $data['newBookingObject'] = $this->booking->emptyBooking();
            $data['selectedBooking'] = $this->booking->emptyBooking();
            $data['courseSelect'] = $this->booking->getCourseSelect();
            $data['customerSelect'] = $this->booking->getCustomerSelect();
            $data['boatSelect'] = $this->booking->getBoatSelect();
            $data['examSelect'] = $this->booking->getExamSelect();
        } else {
            // wenn nicht, dann Das augewählte Boot bearbeiten
            $data["selectedBooking"] = $selectedBooking;
            $data["selectedCourse"] = null;
            $data["selectedCustomer"] = null;
            $data["selectedBoat"] = null;
            $data["selectedExam"] = null;
        }
        if ($this->input->post('saveNewBooking')) {
            $newBooking = $this->booking->emptyBooking();
//                $newBooking['bookingID'] = $this->input->post ('bookingNo');
            $newBooking['courseID'] = $this->input->post('sCourseID');
            $newBooking['customerID'] = $this->input->post('sCustomerID');
            $newBooking['boatID'] = $this->input->post('sBoatID');
            $newBooking['examID'] = $this->input->post('sExamID');
//                print_r($newBooking);
//                $test= $this->input->post();
//                print_r($test);
            $this->booking->saveBooking($newBooking);
        }

        if ($this->input->post('chooseBooking') || $this->input->post('saveBooking') || $this->input->post('editBooking')) {
//                echo '<br>Boot ausgewählt<br>';
            $bookingObject = $this->booking->getBookingForID($selectedBooking);
            $data['bookingObject'] = $bookingObject;
//                print_r($bookingObject);
//                print_r($this->boat->getBoatArrayReadyForPeriodForBoatType('2012-01-01', '2012-01-01', $bookingObject['boatTypeID']));

            if ($this->input->post('editBooking')) {
//                    echo '<br>edit Boot <br>';
                $data['editBooking'] = true;
                $data['courseSelect'] = $this->booking->getCourseSelect();
                $data['customerSelect'] = $this->booking->getCustomerSelect();
                $data['boatSelect'] = $this->booking->getBoatSelect();
                $data['examSelect'] = $this->booking->getExamSelect();
            }
            if ($this->input->post('saveBooking')) {
//                    echo '<br>save Boot <br>';
                $bookingObject['bookingID'] = $this->input->post('bookingNo');
                $bookingObject['courseID'] = $this->input->post('sCourseID');
                $bookingObject['customerID'] = $this->input->post('sCustomerID');
                $bookingObject['boatID'] = $this->input->post('sBoatID');
                $bookingObject['examID'] = $this->input->post('sExamID');
                $this->booking->saveBooking($bookingObject);
            }
        }
        if ($this->input->post('deleteBookin')) {
            $this->course->deleteCourse($selectedBooking);
            $this->tools->alertMessage("Buchung wurde gelöscht");
        }
        $data["bookingArray"] = $this->booking->getBookingNameSelect();
        $this->load->view('v_config_booking', $data);
        $this->load->view('v_wb_footer');
    }

    function newBooking($data) {
        return $data;
    }

}
