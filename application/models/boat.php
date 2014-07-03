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
  
    public $boattype;
    public $name;
    public $condition;
    public $boatid;
    
    //put your code here
    
  
    public function fillDataForID($boatID){
        $this->db->select('*');
        $this->db->from("boat");
        $this->db->where("boatid", $boatID);
        $query = $this->db->get();
        if ($query->num_rows() == 1)
        {
            foreach ($query->result_array() as $row){
                $this->boatid = $row['boatID'];
                $this->boattype = new boattype();
                $this->boattype->fillDataForID($row['boatTypeID']);
                $this->name = $row['name'];
                $this->condition = new condition();
                $this->condition->fillDataForID($row['conditionID']);
                
//     echo "test = ".$row['boatID']."yyy<br>";
            }
           // return $row;
        }
 
    }
    
    public function getBoatArray(){
        $this->db->select('*');
        $this->db->from('boat');
        $query = $this->db->get();
        return $query;
    }
    
    
    public function getValueArray($val, $result){
        $resArray = array();
//        echo "val= ".$val."<br>";
//        echo "übergebener result= ".print_r($result)."<br>";

        foreach ($result->result_array() as $row){
            $resArray[] = $row[$val];
        }
//        echo "resArray = ".print_r($resArray)."<br>";
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
  
    //#######################################################################
    
    public function getBoatNameSelect(){
        $myresult = array();
        $this->db->select('*');
        $this->db->from('boat');        
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $myresult[$row['boatID']] = $row['name'];
        }
        return $myresult;
    }
    
    public function getBoatForID($id){
        //b.boatid, t.typename, c.Description 
//        $this->db->query('SELECT * from `boat` as b left join `boattype` as t on b.boatID = t.boatTypeID left JOIN `condition` as c on b.conditionID= c.conditionID');
        $this->db->select('*');
        $this->db->from('boat');
        $this->db->join('boattype', 'boat.boattypeid = boattype.boattypeid', 'left');
        $this->db->join('condition', 'boat.conditionid= condition.conditionid','left');
        $this->db->where('boatid', $id);        
        $query = $this->db->get();
        if ($query->num_rows() == 1)
        {
            foreach ($query->result_array() as $row){
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
    
    public function saveBoat($boatObject){
        $data = array(
          'name' => $boatObject['name'],
          'boatTypeID' => $boatObject["boatTypeID"],
          'conditionID' => $boatObject["conditionID"]
        );
        if (isset($boatObject["boatID"])) {
            $id = $boatObject["boatID"];
            $this->db->where('boatID', $id);
            $this->db->update('boat', $data);
        } else {
            $this->db->insert('boat', $data);
        }
            
    }
    
    public function emptyBoat() {
        $data = array(
          'name' => '',
          'boatTypeID' => '',
          'conditionID' => ''
        );
        return $data;        
    }
    
}
    