<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class course extends CI_Model{
 
    
    public function getCourseNameSelect(){
        $myresult = array();
        $this->db->select('*');
        $this->db->from('course');        
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $myresult[$row['courseID']] = $row['courseName'];
        }
        return $myresult;
    }
    
    public function getCourseForID($id){
        //b.boatid, t.typename, c.Description 
//        $this->db->query('SELECT * from `boat` as b left join `boattype` as t on b.boatID = t.boatTypeID left JOIN `condition` as c on b.conditionID= c.conditionID');
//        $this->db->select('*');
//        $this->db->from('calendarentry');
//        $this->db->join('course', 'calendarentry.courseid = course.courseid', 'right');
//        $this->db->join('coursetype', 'course.coursetypeid = coursetype.coursetypeid', 'left');
//        $this->db->join('employee', 'calendarentry.employeeID = employee.employeeid','left');
//        $this->db->join('employeerole', 'employee.roleID = employeerole.roleID');
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
        if ($query->num_rows() == 1)
        {
            foreach ($query->result_array() as $row){
                echo 'hier row booking';
                print_r($row);
                return $row;
            }
        }
    }
//        $this->db->join('select courseid as cid, min(start) as start, max(end) as end from calendarentry where courseId is not null group by courseid','cid=course.courseID', 'left');
    public function getCalendardetailsForCourseID($courseID){
        $result =array();
        $this->db->select('min(start) as begin, max(end) as end');
        $this->db->from('calendarentry');
        $this->db->where('courseID', $courseID);
        $query = $this->db->get();
        if ($query->num_rows() == 1)
        {
            foreach ($query->result_array() as $row){
                $result=$row;
            }
        }
        return $result;
    }
    
    public function getEmployeeArrayForCourseID($courseID){
        $result =array();
        $this->db->select('person.firstName, person.name');
        $this->db->from('calendarentry');
        $this->db->join('person', 'calendarentry.employeeID = person.employeeID', 'inner');
        $this->db->where('calendarentry.courseid', $courseID);
        $this->db->group_by(array('person.firstName', 'person.name'));
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            foreach ($query->result_array() as $row){
                $result[]=$row;
            }
        }
        return $result;
}
    
    public function getCourseTypeSelect(){
        $myresult = array();
        $this->db->select('*');
        $this->db->from('coursetype');
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $myresult[$row['courseTypeID']] = $row['typename'];
        }
        return $myresult;
    }
    
    public function getBookingArrayForCourseID($courseID){
        $this->db->select('*');
        $this->db->from('booking');
        $this->db->join('course', 'booking.courseID= course.courseID','left');
        $this->db->join('person', 'person.personID = booking.personID', 'left');
        $this->db->join('boat', 'booking.boatID = boat.boatID', 'left');
        $this->db->where('calendarentry.courseid', $courseID);
        $this->db->group_by(array('employee.firstName', 'employee.name'));
        
    }
//    public function getCalendarEntrySelect() {
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
    public function getEmployeeSelect(){
        $myresult = array();
        $this->db->select('*');
        $this->db->from('person');
        $this->db->where('employeeID is not null', null);
        $query = $this->db->get();
       foreach($query->result_array() as $row){
            $myresult[$row['employeeID']] = $row['firstName']." ".$row['name'];
        }
        return $myresult;
    }
    
    public function saveCourse($courseObject){
        $data = array(
          'courseName' => $courseObject['courseName'],  
          'courseTypeID' => $courseObject['courseTypeID'],
//          'start' => $courseObject['start'], 
//          'end' => $courseObject['end'],
////          'calendarEntryID' => $courseObject['calendarentryID'], 
//          'employeeID' => $courseObject['employeeID']
        );
        if (isset($courseObject['courseID'])) {
            $id = $courseObject['courseID'];
            $this->db->where('courseID', $id);
            $this->db->update('course', $data);
        } else {
            $this->db->insert('course', $data);
        }
            
    }
    
    public function emptyCourse() {
        $data = array(
          'courseName' => '',
          'courseTypeID' => '',
//          'start' => '', 
//          'end' => '',  
//          'emloyeeID' => ''
        );
        return $data;        
    }
    
    public function deleteCourse($courseID){
        $this->db->where('courseID', $courseID);
        $this->db->delete('course');
    }
}
    