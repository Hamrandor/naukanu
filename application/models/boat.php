<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of boat
 *
 * @author Jens
 */
class boat extends CI_Model{
    
    //public $result;
    //put your code here
    
    public function getBoatForID($boatID){
        $this->db->select('*');
        $this->db->from("boat");
        $this->db->where("boatid", $boatID);
 
        $query = $this->db->get();
        
//        return $this->objectAsArray($query);
        return $query;
 
    }
    
    public function getBoatArray(){
        $this->db->select('*');
        $this->db->from('boat');
        
        $query = $this->db->get();
        return $query;
    }
    
    
    public function getValueArray($val, $result){
        $resArray = array();
        echo "val= ".$val."<br>";
        echo "übergebener result= ".print_r($result)."<br>";

        foreach ($result->result_array() as $row){
            $resArray[] = $row[$val];
        }
        echo "resArray = ".print_r($resArray)."<br>";
        return $resArray;
    }
    
    public function objectAsArray($data){
       $result = array();
       foreach($data->result_array() as $row) { 
           $result[] = array(
               'name' => $row['name'],
               'boatTypeID' => $row['boatTypeID'],
               'conditionID' => $row['conditionID']
       );
       //echo print_r($result);
           return $result;
       }
    }
    
    
    public function getNameSelect(){
        $myresult = array();
        $this->db->select('*');
        $this->db->from('boat');        
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $myresult[$row['boatID']] = $row['name'];
        }
        return $myresult;
    }
    
}

