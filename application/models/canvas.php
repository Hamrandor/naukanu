<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of canvas
 *
 * @author Jens
 */
class canvas extends CI_Model{
    
    
    //put your code here
    public function getCanvasForID($id){
        //b.boatid, t.typename, c.Description 
//        $this->db->query('SELECT * from `boat` as b left join `boattype` as t on b.boatID = t.boatTypeID left JOIN `condition` as c on b.conditionID= c.conditionID');
        $this->db->select('*, mast.name as mastname, canvas.name');
        $this->db->from('Canvas');
        $this->db->join('canvastype', 'canvas.canvastypeid = canvastype.canvastypeid', 'left');
        $this->db->join('condition', 'canvas.conditionid= condition.conditionid','left');
        $this->db->join('mast', 'mast.mastid= canvas.mastid','left');
        $this->db->where('canvasid', $id);        
        $query = $this->db->get();
        if ($query->num_rows() == 1)
        {
            foreach ($query->result_array() as $row){
                print_r($row);
                return $row;
            }
        }
    }
    
    public function getCanvasNameSelect($mastID){
        $myresult = array();
        $this->db->select('*');
        $this->db->from('canvas');
        if (isset($mastID)) {
            if ($mastID == 0) {
                $this->db->where('mastID is null', NULL);
            } else {
                $this->db->where('mastID', $mastID);
            }
        } 
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $myresult[$row['canvasID']] = $row['name'];
        }
        return $myresult;
    }

    public function emptyCanvas() {
        $data = array(
          'name' => '',
          'canvasTypeID' => '',
          'conditionID' => '',
          'mastID' => ''
        );
        return $data;        
    }

    public function saveCanvas($aCanvas){
        $data = Array(
            'name' => $aCanvas['name'],
            'canvasTypeID' => $aCanvas['canvasTypeID'],
            'conditionID' => $aCanvas['conditionID'],
            'mastID' => $aCanvas['mastID']
        );
        if (isset($aCanvas['canvasID'])) {
            $id = $aCanvas['canvasID'];
            $this->db->where('canvasID', $id);
            $this->db->update('canvas', $data);
        } else {
            $this->db->insert('canvas', $data);
        }
    }

    
    public function getCanvasTypeSelect($mastTypeID){
        $myresult = array();
        $this->db->select('*');
        $this->db->from('canvasType');
        if (isset($boatTypeID) && $boatTypeID != NULL) {
            $this->db->join('jtcanvasmast', 'canvas.canvasTypeID = jtcanvasmast.canvasTypeID', 'right');
            $this->db->where('mastTypeID', $mastTypeID);
        }
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $myresult[$row['canvasTypeID']] = $row['typename'];
        }
        return $myresult;
    }


    
    public function getCanvasArrayForBoatID($boatID){
        $result = array();
        $this->db->select('*');
        $this->db->from('canvas');
        $this->db->join('masttype', 'mast.masttypeid = masttype.masttypeid', 'left');
        $this->db->join('condition', 'mast.conditionid= condition.conditionid','left');
        $this->db->where('boatID', $boatID);        
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
    //alle wenn kein Mast angegeben
    public function getCanvasTypeNameSelect($mastTypeID){
        $myresult = array();
        $this->db->select('*');
        $this->db->from('canvasType');
        if (isset($mastTypeID)) {
            $this->db->join('jtmastcanvas', 'canvas.canvasTypeID = jtmastcanvas.mastTypeID', 'right');
            $this->db->where('mastTypeID', $mastTypeID);
        }
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $myresult[$row['canvasTypeID']] = $row['typename'];
        }
        return $myresult;
    }
    
        public function getCanvasArray($mastID){
        $result = array();
        $this->db->select('*');
        $this->db->from('canvas');
        $this->db->join('canvastype', 'canvas.canvastypeid = canvastype.canvastypeid', 'left');
        $this->db->join('condition', 'canvas.conditionid= condition.conditionid','left');
        if (isset($mastID) && $mastID != null) {
            $this->db->where('mastID', $mastID);
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
    
    
    function checkCanvas($aCanvas){
        $this->db->select('mastTypeID');
        $this->db->from('mast');
        $this->db->where('mastid', $aCanvas['mastID']);
        $mastQuery = $this->db->get();
        if ($mastQuery->num_rows() > 0)
        {
            foreach ($mastQuery->result_array() as $row){
                $mastResult =$row['mastTypeID'];
            }
        }       
        $this->db->select('*');
        $this->db->from('jtmastcanvas');
        $this->db->where('canvastypeID', $aCanvas['canvasTypeID']);
        $this->db->where('masttypeID', $mastResult);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            $result = TRUE;
        } else {
            $result = FALSE;
        }
        
        return $result;        
    }   
    
    public function canvasReadyforUse($canvasid) {
        $this->db->select('*');
        $this->db->from('canvas');
        $this->db->join('condition', 'canvas.conditionID= condition.conditionID','left');
        $this->db->where('condition.grade < ', '3');
        $this->db->where('canvasID', $canvasid );
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            $result = TRUE;            
        } else {
            $result = FALSE;
        }
        return $result;
    }   
}
