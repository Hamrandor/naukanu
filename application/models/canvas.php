<?php

/*
 * to change this license header, choose license headers in project properties.
 * to change this template file, choose tools | templates
 * and open the template in the editor.
 */

/**
 * description of canvas
 *
 * @author jens
 */
class canvas extends CI_Model {

    //put your code here
    public function getcanvasforid($id) {
        //b.boatid, t.typename, c.description 
//        $this->db->query('select * from `boat` as b left join `boattype` as t on b.boatid = t.boattypeid left join `condition` as c on b.conditionid= c.conditionid');
        $this->db->select('*, mast.name as mastname, canvas.name');
        $this->db->from('canvas');
        $this->db->join('canvastype', 'canvas.canvastypeid = canvastype.canvastypeid', 'left');
        $this->db->join('condition', 'canvas.conditionid= condition.conditionid', 'left');
        $this->db->join('mast', 'mast.mastid= canvas.mastid', 'left');
        $this->db->where('canvasid', $id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row) {
                print_r($row);
                return $row;
            }
        }
    }

    public function getcanvasnameselect($mastid) {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('canvas');
        if (isset($mastid)) {
            if ($mastid == 0) {
                $this->db->where('mastid is null', null);
            } else {
                $this->db->where('mastid', $mastid);
            }
        }
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult[$row['canvasid']] = $row['name'];
        }
        return $myresult;
    }

    public function emptycanvas() {
        $data = array(
            'canvasid' => null,
            'name' => '',
            'canvastypeid' => '',
            'conditionid' => '',
            'mastid' => ''
        );
        return $data;
    }

    public function savecanvas($acanvas) {
        $data = array(
            'name' => $acanvas['name'],
            'canvastypeid' => $acanvas['canvastypeid'],
            'conditionid' => $acanvas['conditionid'],
            'mastid' => $acanvas['mastid']
        );
        if (isset($acanvas['canvasid'])) {
            $id = $acanvas['canvasid'];
            $this->db->where('canvasid', $id);
            $this->db->update('canvas', $data);
        } else {
            $this->db->insert('canvas', $data);
        }
    }

    public function getcanvastypeselect($masttypeid) {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('canvastype');
        if (isset($boattypeid) && $boattypeid != null) {
            $this->db->join('jtcanvasmast', 'canvas.canvastypeid = jtcanvasmast.canvastypeid', 'right');
            $this->db->where('masttypeid', $masttypeid);
        }
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult[$row['canvastypeid']] = $row['typename'];
        }
        return $myresult;
    }

    public function getcanvasarrayforboatid($boatid) {
        $result = array();
        $this->db->select('*');
        $this->db->from('canvas');
        $this->db->join('masttype', 'mast.masttypeid = masttype.masttypeid', 'left');
        $this->db->join('condition', 'mast.conditionid= condition.conditionid', 'left');
        $this->db->where('boatid', $boatid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $result[] = $row;
            }
        }
        return $result;
    }

    //holt daten für dropdown menü 
    //alle wenn kein mast angegeben
    public function getcanvastypenameselect($masttypeid) {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('canvastype');
        if (isset($masttypeid)) {
            $this->db->join('jtmastcanvas', 'canvas.canvastypeid = jtmastcanvas.masttypeid', 'right');
            $this->db->where('masttypeid', $masttypeid);
        }
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult[$row['canvastypeid']] = $row['typename'];
        }
        return $myresult;
    }

    public function getcanvasarray($mastid) {
        $result = array();
        $this->db->select('*');
        $this->db->from('canvas');
        $this->db->join('canvastype', 'canvas.canvastypeid = canvastype.canvastypeid', 'left');
        $this->db->join('condition', 'canvas.conditionid= condition.conditionid', 'left');
        if (isset($mastid) && $mastid != null) {
            $this->db->where('mastid', $mastid);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $result[] = $row;
            }
        }
        return $result;
    }

    function checkcanvas($acanvas) {
        $result = true;
        if ($acanvas['mastid'] != '') {
            $this->db->select('masttypeid');
            $this->db->from('mast');
            $this->db->where('mastid', $acanvas['mastid']);
            $mastquery = $this->db->get();
            if ($mastquery->num_rows() > 0) {
                foreach ($mastquery->result_array() as $row) {
                    $mastresult = $row['masttypeid'];
                }
            } else {
                $result = false;
            }

            if ($result) {
                $this->db->select('*');
                $this->db->from('jtmastcanvas');
                $this->db->where('canvastypeid', $acanvas['canvastypeid']);
                $this->db->where('masttypeid', $mastresult);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    $result = true;
                } else {
                    $result = false;
                }
            }
        }

        return $result;
    }

    public function canvasreadyforuse($canvasid) {
        $this->db->select('*');
        $this->db->from('canvas');
        $this->db->join('condition', 'canvas.conditionid= condition.conditionid', 'left');
        $this->db->where('condition.grade < ', '3');
        $this->db->where('canvasid', $canvasid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function deletecanvas($canvasid) {
        $this->db->where('canvasid', $canvasid);
        $this->db->delete('canvas');
    }

}
