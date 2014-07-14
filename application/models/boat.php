<?php

/*
 * to change this license header, choose license headers in project properties.
 * to change this template file, choose tools | templates
 * and open the template in the editor.
 */

/**
 * description of boat
 *
 * @author jens
 */
class boat extends CI_Model {

    public function __construct() {
        //laden unserer models (/application/models/user.php)
        //methoden des models können dann verwendet werden mit z. b. $this->user->[..];
        $this->load->model(array('mast', 'calendarentry'));
    }

    //put your code here


    public function filldataforid($boatid) {
        $this->db->select('*');
        $this->db->from("boat");
        $this->db->where("boatid", $boatid);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row) {
                $this->boatid = $row['boatid'];
                $this->boattype = new boattype();
                $this->boattype->filldataforid($row['boattypeid']);
                $this->name = $row['name'];
                $this->condition = new condition();
                $this->condition->filldataforid($row['conditionid']);

//     echo "test = ".$row['boatid']."yyy<br>";
            }
            // return $row;
        }
    }

    public function getboatarray() {
        $this->db->select('*');
        $this->db->from('boat');
        $query = $this->db->get();
        return $query;
    }

    public function getvaluearray($val, $result) {
        $resarray = array();
//        echo "val= ".$val."<br>";
//        echo "übergebener result= ".print_r($result)."<br>";

        foreach ($result->result_array() as $row) {
            $resarray[] = $row[$val];
        }
//        echo "resarray = ".print_r($resarray)."<br>";
        return $resarray;
    }

    public function objectasarray($data) {
        $result = array();
        foreach ($data->result_array() as $row) {
            $result[] = array(
                'name' => $row['name'],
                'boattypeid' => $row['boattypeid'],
                'conditionid' => $row['conditionid']
            );
            //echo print_r($result);
            return $result;
        }
    }

    //#######################################################################

    public function getboatnameselect() {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('boat');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult[$row['boatid']] = $row['name'];
        }
        return $myresult;
    }

    public function getboatforid($id) {
        //b.boatid, t.typename, c.description 
//        $this->db->query('select * from `boat` as b left join `boattype` as t on b.boatid = t.boattypeid left join `condition` as c on b.conditionid= c.conditionid');
        $this->db->select('*');
        $this->db->from('boat');
        $this->db->join('boattype', 'boat.boattypeid = boattype.boattypeid', 'left');
        $this->db->join('condition', 'boat.conditionid= condition.conditionid', 'left');
        $this->db->where('boatid', $id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row) {
                return $row;
            }
        }
    }

    public function getboattypeselect() {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('boattype');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult[$row['boattypeid']] = $row['typename'];
        }
        return $myresult;
    }

    public function saveboat($boatobject) {
        $data = array(
            'name' => $boatobject['name'],
            'boattypeid' => $boatobject["boattypeid"],
            'conditionid' => $boatobject["conditionid"]
        );
        if (isset($boatobject["boatid"])) {
            $id = $boatobject["boatid"];
            $this->db->where('boatid', $id);
            $this->db->update('boat', $data);
        } else {
            $this->db->insert('boat', $data);
        }
    }

    public function emptyboat() {
        $data = array(
            'name' => '',
            'boattypeid' => '',
            'conditionid' => ''
        );
        return $data;
    }

    public function boatreadyforuse($boatid) {
        $mastarray = array();
        $result = true;
        $this->db->select('*');
        $this->db->from('boat');
        $this->db->join('mast', 'boat.boatid= mast.boatid', 'left');
        $this->db->join('condition', 'boat.conditionid= condition.conditionid', 'left');
        $this->db->where('condition.grade < ', '3');
        $this->db->where('boat.boatid', $boatid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                if ($result) {
                    $result = $this->mast->mastreadyforuse($row['mastid']);
                }
            }
        } else {
            $result = false;
        }
        return $result;
    }

    public function boatarrayfortype($boattypeid) {
        $result = array();
        $this->db->select('*');
        $this->db->from('boat');
        $this->db->where('boattypeid', $boattypeid);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $result[$row['boatid']] = $row['name'];
        }
        return $result;
    }

    public function deleteboat($boatid) {
        $this->db->where('boatid', $boatid);
        $this->db->delete('boat');
    }

    public function filterarraybyreadyforuse($boatarray) {
        $result = array();
        foreach ($boatarray as $boatid => $name) {
            if ($this->boatreadyforuse($boatid)) {
                $result[$boatid] = $name;
            }
        }
        return $result;
    }

    public function filterarrayforperiod($from, $to, $boatarray) {
        $result = array();
        foreach ($boatarray as $boatid => $name) {
            if ($this->calendarentry->checkperiodforboat($boatid, $from, $to)) {
                $result[$boatid] = $name;
            }
        }
        return $result;
    }

    public function getboatarrayreadyforperiodforboattype($from, $to, $boattypeid) {
        $boatarray = $this->boatarrayfortype($boattypeid);
        $readyarray = $this->filterarraybyreadyforuse($boatarray);
        $result = $this->filterarrayforperiod($from, $to, $readyarray);
        return $result;
    }

    public function getboatarrayformasttype($masttypeid) {
        $result = array();
        $this->db->select('boatid, name');
        $this->db->from('boat');
        if (isset($masttypeid) && $masttypeid != null) {
            $this->db->join('jtboatmast', 'boat.boattypeid = jtboatmast.boattypeid', 'left');
            $this->db->where('jtboatmast.masttypeid', $masttypeid);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                print_r($row);
                $result[$row['boatid']] = $row['name'];
            }
        }
        return $result;
    }

}
