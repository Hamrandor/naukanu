<?php

/*
 * to change this license header, choose license headers in project properties.
 * to change this template file, choose tools | templates
 * and open the template in the editor.
 */

class booking extends CI_Model {

    public function getbookingnameselect() {
        $myresult = array();
        $this->db->select('*, person.name as personname');
        $this->db->from('booking');
        $this->db->join('course', 'booking.courseid = course.courseid', 'left');
        $this->db->join('person', 'booking.personid = person.personid', 'left');
//        $this->db->join('boat', 'booking.boatid = boat.boatid', 'left');
//        $this->db->where('bookingid');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult[$row['bookingid']] = $row['personname'] . " " . $row['coursename'];
            print_r($row);
        }
        return $myresult;
    }

    public function getbookingforid($id) {

        $this->db->select('*, person.name as c_name, boat.name as b_name, exam.name as e_name');
        //da typename in booking und boattype gleich, beide umbenannt
        $this->db->from('booking');
        $this->db->join('course', 'booking.courseid = course.courseid', 'left');
//      $this->db->join('calendarentry', 'course.calendarentryid = calendarentry.calendarentryid', 'left');
//      $this->db->join('customer', 'booking.customerid = customer.customerid', 'left');
//      $this->db->join('address', 'customer.addressid = address.addressid', 'left');
        $this->db->join('person', 'booking.personid = person.personid', 'left');
        $this->db->join('boat', 'booking.boatid = boat.boatid', 'left');
        $this->db->join('exam', 'booking.examid = exam.examid', 'left');
        $this->db->where('bookingid', $id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row) {
                echo 'hier row booking';
                print_r($row);
                return $row;
            }
        }
    }

    public function getcourseselect() {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('course');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult[$row['courseid']] = $row['coursename'];
        }
        return $myresult;
    }

    public function getcustomerselect() {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('person');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult [$row['personid']] = $row['name'];
        }
        return $myresult;
    }

    public function getboatselect() {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('boat');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult [$row['boatid']] = $row['name'];
        }
        return $myresult;
    }

    public function getexamselect() {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('exam');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult [$row['examid']] = $row['name'];
        }
        return $myresult;
    }

    public function savebooking($bookingobject) {
        //$id = $bookingobject['bookingid'];
        print_r($bookingobject);
        $data = array(
//                'bookingid' => $bookingobject['bookingid'],
            'courseid' => $bookingobject['courseid'],
            'personid' => $bookingobject['customerid'],
            'boatid' => $bookingobject['boatid'],
            'examid' => $bookingobject['examid']
        );
        if (isset($bookingobject['bookingid'])) {
            $id = $bookingobject['bookingid'];
            $this->db->where('bookingid', $id);
            $this->db->update('booking', $data);
        } else {
            $this->db->insert('booking', $data);
        }
    }

    public function emptybooking() {
        $data = array(
//                'bookingid' => '',
            'courseid' => '',
            'personid' => '',
            'boatid' => '',
            'examid' => '',
        );
        return $data;
    }

    public function deletebooking($bookingid) {
        $this->db->where('bookingid', $bookingid);
        $this->db->delete('booking');
    }

}
