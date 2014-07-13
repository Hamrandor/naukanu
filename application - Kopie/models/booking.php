<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class booking extends CI_Model {

    public function getBookingNameSelect() {
        $myresult = array();
        $this->db->select('*, person.name AS personname');
        $this->db->from('booking');
        $this->db->join('course', 'booking.courseid = course.courseid', 'left');
        $this->db->join('person', 'booking.personid = person.personid', 'left');
//        $this->db->join('boat', 'booking.boatid = boat.boatid', 'left');
//        $this->db->where('bookingID');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult[$row['bookingID']] = $row['personname'] . " " . $row['courseName'];
            print_r($row);
        }
        return $myresult;
    }

    public function getBookingForID($id) {

        $this->db->select('*, person.name AS c_name, boat.name AS b_name, exam.name AS e_name');
        //da typename in booking und boattype gleich, beide umbenannt
        $this->db->from('booking');
        $this->db->join('course', 'booking.courseid = course.courseid', 'left');
//      $this->db->join('calendarentry', 'course.calendarentryid = calendarentry.calendarentryid', 'left');
//      $this->db->join('customer', 'booking.customerid = customer.customerid', 'left');
//      $this->db->join('address', 'customer.addressid = address.addressid', 'left');
        $this->db->join('person', 'booking.personid = person.personid', 'left');
        $this->db->join('boat', 'booking.boatid = boat.boatid', 'left');
        $this->db->join('exam', 'booking.examid = exam.examid', 'left');
        $this->db->where('bookingID', $id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row) {
                echo 'hier row booking';
                print_r($row);
                return $row;
            }
        }
    }

    public function getCourseSelect() {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('calendarentry');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult[$row['courseID']] = $row['description'];
        }
        return $myresult;
    }

    public function getCustomerSelect() {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('person');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult [$row['personID']] = $row['name'];
        }
        return $myresult;
    }

    public function getBoatSelect() {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('boat');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult [$row['boatID']] = $row['name'];
        }
        return $myresult;
    }

    public function getExamSelect() {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('exam');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult [$row['examID']] = $row['name'];
        }
        return $myresult;
    }

    public function saveBooking($bookingObject) {
        //$id = $bookingObject['bookingID'];
        print_r($bookingObject);
        $data = array(
//                'bookingID' => $bookingObject['bookingID'],
            'courseID' => $bookingObject['courseID'],
            'personID' => $bookingObject['customerID'],
            'boatID' => $bookingObject['boatID'],
            'examID' => $bookingObject['examID']
        );
        if (isset($bookingObject['bookingID'])) {
            $id = $bookingObject['bookingID'];
            $this->db->where('bookingID', $id);
            $this->db->update('booking', $data);
        } else {
            $this->db->insert('booking', $data);
        }
    }

    public function emptyBooking() {
        $data = array(
//                'bookingID' => '',
            'courseID' => '',
            'personID' => '',
            'boatID' => '',
            'examID' => '',
        );
        return $data;
    }

    public function deleteBooking($BookingID) {
        $this->db->where('bookingID', $bookingID);
        $this->db->delete('booking');
    }

}
