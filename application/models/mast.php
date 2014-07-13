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
class mast extends CI_Model {

    public function __construct() {
        //Laden unserer models (/application/models/user.php)
        //Methoden des models können dann verwendet werden mit z. B. $this->user->[..];
        $this->load->model(array('canvas'));
    }

    //put your code here
    public function getMastForID($id) {
        //b.boatid, t.typename, c.Description 
//        $this->db->query('SELECT * from `boat` as b left join `boattype` as t on b.boatID = t.boatTypeID left JOIN `condition` as c on b.conditionID= c.conditionID');
        $this->db->select('*, boat.name as boatname, mast.name');
        $this->db->from('mast');
        $this->db->join('masttype', 'mast.masttypeid = masttype.masttypeid', 'left');
        $this->db->join('condition', 'mast.conditionid= condition.conditionid', 'left');
        $this->db->join('boat', 'mast.boatid= boat.boatid', 'left');
        $this->db->where('mastid', $id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row) {
                return $row;
            }
        }
    }

    public function getMastNameSelect($boatID) {
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
        foreach ($query->result_array() as $row) {
            $myresult[$row['mastID']] = $row['name'];
        }
        return $myresult;
    }

    public function getMastArray($boatID) {
        $result = array();
        $this->db->select('*');
        $this->db->from('mast');
        $this->db->join('masttype', 'mast.masttypeid = masttype.masttypeid', 'left');
        $this->db->join('condition', 'mast.conditionid= condition.conditionid', 'left');
        if (isset($boatID) && $boatID != null) {
            $this->db->where('boatID', $boatID);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $result[] = $row;
            }
        }
        return $result;
    }

    //holt Daten für Dropdown Menü 
    //alle wenn kein boot angegeben
    public function getMastTypeSelect($boatTypeID) {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('masttype');
        if (isset($boatTypeID) && $boatTypeID != NULL) {
            $this->db->join('jtboatmast', 'masttype.mastTypeID = jtboatmast.mastTypeID', 'right');
            $this->db->where('boattypeID', $boatTypeID);
        }
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult[$row['mastTypeID']] = $row['typename'];
        }
        return $myresult;
    }

    public function getAvailableMastArrayForBoatType($boatTypeID) {
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
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $result[] = $row;
            }
        }
        //echo '<br><br><br>'.print_r($result).'<br><br><br>';
        return $result;
    }

    public function saveMast($aMast) {
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

    function checkMast($aMast) {
        $this->db->select('boatTypeID');
        $this->db->from('boat');
        $this->db->where('boatid', $aMast['boatID']);
        $boatQuery = $this->db->get();
        if ($boatQuery->num_rows() > 0) {
            foreach ($boatQuery->result_array() as $row) {
                $boatResult = $row['boatTypeID'];
            }
        }
        $this->db->select('*');
        $this->db->from('jtboatmast');
        $this->db->where('masttypeID', $aMast['mastTypeID']);
        $this->db->where('boattypeID', $boatResult);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = TRUE;
        } else {
            $result = FALSE;
        }
        return $result;
    }

    public function mastReadyforUse($mastid) {
        $result = true;
        $this->db->select('*');
        $this->db->from('mast');
        $this->db->join('canvas', 'mast.mastid= canvas.mastid', 'left');
        $this->db->join('condition', 'mast.conditionID= condition.conditionID', 'left');
        $this->db->where('condition.grade < ', '3');
        $this->db->where('mast.mastID', $mastid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                if ($result) {
                    $result = $this->canvas->canvasReadyforUse($row['canvasID']); //mastReadyForUse
                }
            }
        } else {
            $result = FALSE;
        }
        return $result;
    }

    public function getMastArrayForCanvasType($canvasTypeID) {
        $result = array();
        $this->db->select('mastID, name');
        $this->db->from('mast');
        if (isset($canvasTypeID) && $canvasTypeID != null) {
            $this->db->join('jtmastcanvas', 'mast.mastTypeID = jtmastcanvas.mastTypeID', 'left');
            $this->db->where('jtmastcanvas.canvasTypeID', $canvasTypeID);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $result[$row['mastID']] = $row['name'];
            }
        }
        return $result;
    }

    public function deleteMast($mastID) {
        $this->db->where('mastID', $mastID);
        $this->db->delete('mast');
    }

}
