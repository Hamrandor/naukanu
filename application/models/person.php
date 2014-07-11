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
class person extends CI_Model {
    
    
    public function createNewEmployeeID(){
        
        $this->db->select('max(employeeid)');
        $this->db->from('person');
        
        set($NewID = $this+1);
        return $NewID;
    }
   
}

