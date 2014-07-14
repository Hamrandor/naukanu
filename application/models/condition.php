<?php

/*
 * to change this license header, choose license headers in project properties.
 * to change this template file, choose tools | templates
 * and open the template in the editor.
 */

/**
 * description of condition
 *
 * @author jens
 */
class condition extends CI_Model {

    public function filldataforid($conditionid) {
        $this->db->select('*');
        $this->db->from("condition");
        $this->db->where("conditionid", $conditionid);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row) {
                $this->conditionid = $row['conditionid'];
                $this->grade = $row['grade'];
                $this->description = $row['description'];
            }
        }
    }

    //holt daten für dropdown menü 
    //alle wenn kein boot angegeben
    public function getconditionselect() {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('condition');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult[$row['conditionid']] = $row['description'];
        }
        return $myresult;
    }

}
