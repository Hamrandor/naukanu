<?php

/*
 * to change this license header, choose license headers in project properties.
 * to change this template file, choose tools | templates
 * and open the template in the editor.
 */

/**
 * description of mast
 *
 * @author jens
 */
class mast extends CI_Model {

    public function __construct() {
        //laden unserer models (/application/models/user.php)
        //methoden des models können dann verwendet werden mit z. b. $this->user->[..];
        $this->load->model(array('canvas'));
    }

    //put your code here
    public function getmastforid($id) {
        //b.boatid, t.typename, c.description 
//        $this->db->query('select * from `boat` as b left join `boattype` as t on b.boatid = t.boattypeid left join `condition` as c on b.conditionid= c.conditionid');
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

    public function getmastnameselect($boatid) {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('mast');
        if (isset($boatid)) {
            if ($boatid == 0) {
                $this->db->where('boatid is null', null);
            } else {
                $this->db->where('boatid', $boatid);
            }
        }
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult[$row['mastid']] = $row['name'];
        }
        return $myresult;
    }

    public function getmastarray($boatid) {
        $result = array();
        $this->db->select('*');
        $this->db->from('mast');
        $this->db->join('masttype', 'mast.masttypeid = masttype.masttypeid', 'left');
        $this->db->join('condition', 'mast.conditionid= condition.conditionid', 'left');
        if (isset($boatid) && $boatid != null) {
            $this->db->where('boatid', $boatid);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $result[] = $row;
            }
        }
        return $result;
    }

    //holt daten für dropdown menü 
    //alle wenn kein boot angegeben
    public function getmasttypeselect($boattypeid) {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('masttype');
        if (isset($boattypeid) && $boattypeid != null) {
            $this->db->join('jtboatmast', 'masttype.masttypeid = jtboatmast.masttypeid', 'right');
            $this->db->where('boattypeid', $boattypeid);
        }
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult[$row['masttypeid']] = $row['typename'];
        }
        return $myresult;
    }

    public function getavailablemastarrayforboattype($boattypeid) {
        $result = array();
//        $this->db->query('select * from mast as m '
//               . 'left join masttype as mt on m.masttypeid = mt.masttypeid '
//               . 'left join jtboatmast as jt on mt.masttypeid = jt.masttypeid '
//               . 'where jt.boattypeid = '.$boattypeid);
        $this->db->select('*');
        $this->db->from('mast');
        $this->db->join('masttype', 'mast.masttypeid = masttype.masttypeid', 'left');
        $this->db->join('jtboatmast', 'masttype.masttypeid = jtboatmast.masttypeid', 'left');
        $this->db->where('jtboatmast.boattypeid', $boattypeid);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $result[] = $row;
            }
        }
        //echo '<br><br><br>'.print_r($result).'<br><br><br>';
        return $result;
    }

    public function savemast($amast) {
        $data = array(
            'name' => $amast['name'],
            'masttypeid' => $amast['masttypeid'],
            'conditionid' => $amast['conditionid'],
            'boatid' => $amast['boatid']
        );
        if (isset($amast['mastid'])) {
            $id = $amast['mastid'];
            $this->db->where('mastid', $id);
            $this->db->update('mast', $data);
        } else {
            $this->db->insert('mast', $data);
        }
    }

    public function emptymast() {
        $data = array(
            'name' => '',
            'masttypeid' => '',
            'conditionid' => '',
            'boatid' => ''
        );
        return $data;
    }

    function checkmast($amast) {
        $this->db->select('boattypeid');
        $this->db->from('boat');
        $this->db->where('boatid', $amast['boatid']);
        $boatquery = $this->db->get();
        if ($boatquery->num_rows() > 0) {
            foreach ($boatquery->result_array() as $row) {
                $boatresult = $row['boattypeid'];
            }
        }
        $this->db->select('*');
        $this->db->from('jtboatmast');
        $this->db->where('masttypeid', $amast['masttypeid']);
        $this->db->where('boattypeid', $boatresult);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function mastreadyforuse($mastid) {
        $result = true;
        $this->db->select('*');
        $this->db->from('mast');
        $this->db->join('canvas', 'mast.mastid= canvas.mastid', 'left');
        $this->db->join('condition', 'mast.conditionid= condition.conditionid', 'left');
        $this->db->where('condition.grade < ', '3');
        $this->db->where('mast.mastid', $mastid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                if ($result) {
                    $result = $this->canvas->canvasreadyforuse($row['canvasid']); //mastreadyforuse
                }
            }
        } else {
            $result = false;
        }
        return $result;
    }

    public function getmastarrayforcanvastype($canvastypeid) {
        $result = array();
        $this->db->select('mastid, name');
        $this->db->from('mast');
        if (isset($canvastypeid) && $canvastypeid != null) {
            $this->db->join('jtmastcanvas', 'mast.masttypeid = jtmastcanvas.masttypeid', 'left');
            $this->db->where('jtmastcanvas.canvastypeid', $canvastypeid);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $result[$row['mastid']] = $row['name'];
            }
        }
        return $result;
    }

    public function deletemast($mastid) {
        $this->db->where('mastid', $mastid);
        $this->db->delete('mast');
    }

}
