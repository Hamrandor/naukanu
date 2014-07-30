<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of person
 *
 * @author rnitschke
 */
class personmodel extends CI_Model {
    
    public $salutation;
    public $name;
    public $firstname;
    public $dateofbirth;
    public $employeeID;
    public $NewID;
    
    
    public function saveNewPerson($salutation, $name, $firstname, $dateofbirth){        
        $data = array(
          'salutation'=>$salutation['salutation'],
          'name'=>$name['name'],
          'firstname'=>$firstname['firstname'],
          'dateofbirth'=>$dateofbirth['dateofbirth'],
        );
        $this->db->insert('person', $data);
    }
    
    
    public function createNewEmployeeID(){
        $result = $this->db->query('SELECT (MAX(employeeID)+1)as newid FROM person');
        $NewID = $result->row()->newid;
    return  $NewID;
    }
    
    public function setNewEmployeeID(){
    }

    public function getpersonnameselect() {
    $myresult = array();
    $this->db->select('*');
    $this->db->from('person');
    $query = $this->db->get();
    foreach ($query->result_array() as $row) {
        $myresult[$row['personid']] = $row['firstname'].' '.$row['name'];
    }
    return $myresult;
    }

    public function getpersonforid($personid){
    $result = $this->db->query('SELECT * FROM person WHERE personid ='.$personid);
    return $result->row();
    //echo $personid;
    }
}
