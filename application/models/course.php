<?php

/*
 * to change this license header, choose license headers in project properties.
 * to change this template file, choose tools | templates
 * and open the template in the editor.
 */

class course extends CI_Model {

    public function getcoursenameselect() {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('course');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult[$row['courseid']] = $row['coursename'];
        }
        return $myresult;
    }

    public function getcourseforid($id) {
        //b.boatid, t.typename, c.description 
//        $this->db->query('select * from `boat` as b left join `boattype` as t on b.boatid = t.boattypeid left join `condition` as c on b.conditionid= c.conditionid');
//        $this->db->select('*');
//        $this->db->from('calendarentry');
//        $this->db->join('course', 'calendarentry.courseid = course.courseid', 'right');
//        $this->db->join('coursetype', 'course.coursetypeid = coursetype.coursetypeid', 'left');
//        $this->db->join('employee', 'calendarentry.employeeid = employee.employeeid','left');
//        $this->db->join('employeerole', 'employee.roleid = employeerole.roleid');
//        $this->db->where('course.courseid', $id);        
//        $query = $this->db->get();
//        if ($query->num_rows() == 1)
//        {
//            foreach ($query->result_array() as $row){
//                echo 'hier row booking';
//                print_r($row);
//                return $row;
//            }
//        }
        $this->db->select('*');
        $this->db->from('course');
        $this->db->join('coursetype', 'course.coursetypeid = coursetype.coursetypeid', 'left');
        $this->db->where('course.courseid', $id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row) {
                echo 'hier row booking';
//                print_r($row);
                return $row;
            }
        }
    }

//        $this->db->join('select courseid as cid, min(start) as start, max(end) as end from calendarentry where courseid is not null group by courseid','cid=course.courseid', 'left');
    public function getcalendardetailsforcourseid($courseid) {
        $result = array();
        $this->db->select('min(start) as begin, max(end) as end');
        $this->db->from('calendarentry');
        $this->db->where('courseid', $courseid);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row) {
                $result = $row;
            }
        }
        return $result;
    }

    public function getemployeearrayforcourseid($courseid) {
        $result = array();
        $this->db->select('person.firstname, person.name');
        $this->db->from('calendarentry');
        $this->db->join('person', 'calendarentry.employeeid = person.employeeid', 'inner');
        $this->db->where('calendarentry.courseid', $courseid);
        $this->db->group_by(array('person.firstname', 'person.name'));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $result[] = $row;
            }
        }
        return $result;
    }

    public function getcoursetypeselect() {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('coursetype');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult[$row['coursetypeid']] = $row['typename'];
        }
        return $myresult;
    }

    public function getbookingarrayforcourseid($courseid) {
        $this->db->select('*');
        $this->db->from('booking');
        $this->db->join('course', 'booking.courseid= course.courseid', 'left');
        $this->db->join('person', 'person.personid = booking.personid', 'left');
        $this->db->join('boat', 'booking.boatid = boat.boatid', 'left');
        $this->db->where('calendarentry.courseid', $courseid);
        $this->db->group_by(array('employee.firstname', 'employee.name'));
    }

//    public function getcalendarentryselect() {
//        $myresult = array ();
//        $this->db->select ('*');
//        $this->db->from('calendarentry');
//        $query = $this->db->get();
//        foreach($query->result_array() as $row){
//            $myresult[] = $row;
//        }
////        print_r($row);
//        return $myresult;
//       
//    }
//   
//
    public function getemployeeselect() {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('person');
        $this->db->where('employeeid is not null', null);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult[$row['employeeid']] = $row['firstname'] . " " . $row['name'];
        }
        return $myresult;
    }

    public function savecourse($courseobject) {
        $data = array(
            'coursename' => $courseobject['coursename'],
            'coursetypeid' => $courseobject['coursetypeid'],
//          'start' => $courseobject['start'], 
//          'end' => $courseobject['end'],
////          'calendarentryid' => $courseobject['calendarentryid'], 
//          'employeeid' => $courseobject['employeeid']
        );
        if (isset($courseobject['courseid'])) {
            $id = $courseobject['courseid'];
            $this->db->where('courseid', $id);
            $this->db->update('course', $data);
        } else {
            $this->db->insert('course', $data);
        }
    }

    public function emptycourse() {
        $data = array(
            'coursename' => '',
            'coursetypeid' => '',
//          'start' => '', 
//          'end' => '',  
//          'emloyeeid' => ''
        );
        return $data;
    }

    public function deletecourse($courseid) {
        $this->db->where('courseid', $courseid);
        $this->db->delete('course');
    }

        //Mitarbeiter pro Tag
    public function get_event_employees($year, $month) {
        $query = $this->db->query("SELECT DISTINCT DATE_FORMAT(start, '%Y-%m-%e') AS start
                                            FROM calendarentry
                                            WHERE start LIKE '$year-$month%' "); //date format eliminates zeros make
        //days look 05 to 5

        $cal_data = array();

        foreach ($query->result() as $row) { //for every date fetch data
            $a = array();
            $i = 0;
//            echo "SELECT description
//                                                FROM calendarentry
//                                                WHERE start LIKE DATE_FORMAT('$row->start', '%Y-%m-%d 00:00:00') ";
            $query2 = $this->db->query("SELECT employeeid
                                                FROM calendarentry
                                                WHERE start LIKE DATE_FORMAT('$row->start', '%Y-%m-%d 00:00:00') ");
            //date format change back the date format
            //that fetched earlier
            foreach ($query2->result() as $r) {
                $a[$i] = $r->employeeid;     //make data array to put to specific date
                $i++;
            }
            $cal_data[(int) substr($row->start, 8, 2)] = $a;
        }
        return $cal_data;
    }
    //und die Kurse
    public function get_event_courses($year, $month) {
        $query = $this->db->query("SELECT DISTINCT DATE_FORMAT(start, '%Y-%m-%e') AS start
                                            FROM calendarentry
                                            WHERE start LIKE '$year-$month%' "); //date format eliminates zeros make
        //days look 05 to 5

        $cal_data = array();

        foreach ($query->result() as $row) { //for every date fetch data
            $a = array();
            $i = 0;
//            echo "SELECT description
//                                                FROM calendarentry
//                                                WHERE start LIKE DATE_FORMAT('$row->start', '%Y-%m-%d 00:00:00') ";
            $query2 = $this->db->query("SELECT courseid
                                                FROM calendarentry
                                                WHERE start LIKE DATE_FORMAT('$row->start', '%Y-%m-%d 00:00:00') ");
            //date format change back the date format
            //that fetched earlier
            foreach ($query2->result() as $r) {
                $a[$i] = $r->courseid;     //make data array to put to specific date
                $i++;
            }
            $cal_data[(int) substr($row->start, 8, 2)] = $a;
        }
        return $cal_data;
    }


    
}
