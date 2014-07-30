<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class appraisal extends CI_Model {
    
    public function getappraisalquestion () {
     $myresult = array();
     $this->db->select('*');
     $this->db->from('appraisalquestion');
     $query = $this->db->get();
     foreach ($query->result_array() as $row) {
         $myresult[$row['appraisalquestionid']] = $row['question'];
     }
    return $myresult;
    }
}