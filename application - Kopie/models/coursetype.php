<?php

class coursetype extends CI_Model {
  
    
    public function getCourseTypeNameSelect(){
        $myresult = array();
        $this->db->select('*');
        $this->db->from('coursetype');        
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $myresult[$row['courseTypeID']] = $row['typename'];
        }
        return $myresult;
    }
    
    public function getcourseTypeForID($id){

      $this->db->select('*, coursetype.typename AS c_typename, boattype.typename AS b_typename');
      //da typename in coursetype und boattype gleich, beide umbenannt
      $this->db->from('coursetype');
      $this->db->join('boattype', 'coursetype.boattypeid = boattype.boattypeid', 'left');
      $this->db->join('license', 'coursetype.licenseID = license.licenseid', 'left');
      $this->db->where('coursetypeid', $id);
      $query = $this->db->get();
      if ($query->num_rows() == 1)
        {
          foreach ($query->result_array() as $row){
            //echo 'hier row coursetype';
            //print_r($row);
            return $row;
            }
        }
    }
	public function getBoatTypeSelect(){
        $myresult = array();
        $this->db->select('*');
        $this->db->from('boattype');
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $myresult[$row['boatTypeID']] = $row['typename'];
        }
        return $myresult;
        }
        public function getLicenseSelect() {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('license');
        $query = $this->db->get();
        foreach ($query->result_array() as $row){
            $myresult [$row['licenseID']] = $row['name'];
        }
        return $myresult;
    }
        public function saveCourseType ($courseTypeObject) {
            //$id = $courseTypeObject['courseTypeID'];
            $data = array(
                'typename' => $courseTypeObject['c_typename'],
                'description' => $courseTypeObject['description'],
                'durationDays' => $courseTypeObject['durationDays'],
                'durationHours' => $courseTypeObject['durationHours'],
                'minParticipants' => $courseTypeObject['minParticipants'],
                'maxParticipants' => $courseTypeObject['maxParticipants'],
                'boatTypeID' => $courseTypeObject['boatTypeID'],
                'numberOfCourseLeaders' => $courseTypeObject['numberOfCourseLeaders'],
                'licenseID' => $courseTypeObject['licenseID'],
                'salary' => $courseTypeObject['salary'],
                'price' => $courseTypeObject['price'],
                'priceExam' => $courseTypeObject['priceExam']
                    );
            if (isset($courseTypeObject['courseTypeID'])){
                $id = $courseTypeObject['courseTypeID'];
                $this->db->where('courseTypeID', $id);
                $this->db->update('courseType', $data);
            } else {
                $this->db->insert('courseType', $data);
            }
        }
        public function emptyCourseType () {
            $data = array(
                'typename' => '',
                'description' => '',
                'durationDays' => '',
                'durationHours' => '',
                'minParticipants' => '',
                'maxParticipants' => '',
                'boatTypeID' => '',
                'numberOfCourseLeaders' => '',
                'licenseID' => '',
                'salary' => '',
                'price' => '',
                'priceExam' => ''
            );
            return $data;
        }
        public function deleteCourseType($courseTypeID){
            $this->db->where('courseTypeID', $courseTypeID);
            $this->db->delete('courseType');
            }
        }
	