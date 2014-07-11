<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of boattype
 *
 * @author Jens
 */
class boattype extends CI_Model{
    //put your code here
    public $boatTypeID;
    public $typename;
    public $seatCount;
    
    public function fillDataForID($boatTypeID){
        $this->db->select('*');
        $this->db->from("boatType");
        $this->db->where("boatTypeID", $boatID);
        $query = $this->db->get();
        if ($query->num_rows() == 1)
        {
            foreach ($query->result_array() as $row){
                $this->boatTypeID = $row['boatTypeID'];
                $this->typename = $row['typename'];
                $this->seatCount = $row['seatcount'];
            }
        }
    }

    
    public function getNameSelect(){
        $myresult = array();
        $this->db->select('*');
        $this->db->from('boatType');        
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $myresult[$row['boatID']] = $row['name'];
        }
        return $myresult;
    }
}
