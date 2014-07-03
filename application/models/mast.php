<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mast
 *
 * @author Jens
 */
class mast extends CI_Model{
    //put your code here
    public function getMastForID($id){
        //b.boatid, t.typename, c.Description 
//        $this->db->query('SELECT * from `boat` as b left join `boattype` as t on b.boatID = t.boatTypeID left JOIN `condition` as c on b.conditionID= c.conditionID');
        $this->db->select('*, boat.name as boatname, mast.name');
        $this->db->from('Mast');
        $this->db->join('masttype', 'mast.masttypeid = masttype.masttypeid', 'left');
        $this->db->join('condition', 'mast.conditionid= condition.conditionid','left');
        $this->db->join('boat', 'mast.boatid= boat.boatid','left');
        $this->db->where('mastid', $id);        
        $query = $this->db->get();
        if ($query->num_rows() == 1)
        {
            foreach ($query->result_array() as $row){
                print_r($row);
                return $row;
            }
        }
    }
    
    public function getMastNameSelect($boatID){
        $myresult = array();
        $this->db->select('*');
        $this->db->from('mast');
        if (isset($boatID)) {
            if ($boatID == 0) {
                $this->db->where('boatID is null', NULL);
            } else {
                $this->db->where('boatID', $boatID);
            }
        } 
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $myresult[$row['mastID']] = $row['name'];
        }
        return $myresult;
    }

    
    
    public function getMastArray($boatID){
        $result = array();
        $this->db->select('*');
        $this->db->from('Mast');
        $this->db->join('masttype', 'mast.masttypeid = masttype.masttypeid', 'left');
        $this->db->join('condition', 'mast.conditionid= condition.conditionid','left');
        if (isset($boatID) && $boatID != null) {
            $this->db->where('boatID', $boatID);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            foreach ($query->result_array() as $row){
                $result[]=$row;
            }
        }
        return $result;
    }
    
    
    //holt Daten für Dropdown Menü 
    //alle wenn kein boot angegeben
    public function getMastTypeSelect($boatTypeID){
        $myresult = array();
        $this->db->select('*');
        $this->db->from('mastType');
        if (isset($boatTypeID) && $boatTypeID != NULL) {
            $this->db->join('jtboatmast', 'mast.mastTypeID = jtboatmast.mastTypeID', 'right');
            $this->db->where('boatTypeID', $boatTypeID);
        }
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $myresult[$row['mastTypeID']] = $row['typename'];
        }
        return $myresult;
    }
    
    public function getAvailableMastArrayForBoatType($boatTypeID){
        $result = array();
//        $this->db->query('SELECT * from mast as m '
//               . 'left join masttype as mt on m.masttypeid = mt.masttypeid '
//               . 'left join jtboatmast as jt on mt.masttypeid = jt.masttypeid '
//               . 'where jt.boattypeID = '.$boatTypeID);
        $this->db->select('*');
        $this->db->from('mast');
        $this->db->join('masttype', 'mast.mastTypeID = masttype.mastTypeID', 'left');
        $this->db->join('jtboatmast', 'masttype.mastTypeID = jtboatmast.mastTypeID', 'left');
        $this->db->where('jtboatmast.boatTypeID', $boatTypeID);
        
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            foreach ($query->result_array() as $row){
                $result[]=$row;
            }
        }
        //echo '<br><br><br>'.print_r($result).'<br><br><br>';
        return $result;
    }
    
    
    public function saveMast($aMast){
        $data = Array(
            'name' => $aMast['name'],
            'mastTypeID' => $aMast['mastTypeID'],
            'conditionID' => $aMast['conditionID'],
            'boatID' => $aMast['boatID']
        );
        if (isset($aMast['mastID'])) {
            $id = $aMast['mastID'];
            $this->db->where('mastID', $id);
            $this->db->update('mast', $data);
        } else {
            $this->db->insert('mast', $data);
        }
    }
    

    
        
    public function emptyMast() {
        $data = array(
          'name' => '',
          'mastTypeID' => '',
          'conditionID' => '',
          'boatID' => ''
        );
        return $data;        
    }

}
