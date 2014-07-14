<?php

/*
 * to change this license header, choose license headers in project properties.
 * to change this template file, choose tools | templates
 * and open the template in the editor.
 */

/**
 * description of boattype
 *
 * @author jens
 */
class boattype extends CI_Model {

    //put your code here
    public $boattypeid;
    public $typename;
    public $seatcount;

    public function filldataforid($boattypeid) {
        $this->db->select('*');
        $this->db->from("boattype");
        $this->db->where("boattypeid", $boatid);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row) {
                $this->boattypeid = $row['boattypeid'];
                $this->typename = $row['typename'];
                $this->seatcount = $row['seatcount'];
            }
        }
    }

    public function getnameselect() {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('boattype');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult[$row['boatid']] = $row['name'];
        }
        return $myresult;
    }

}
