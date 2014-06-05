<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of condition
 *
 * @author Jens
 */
class condition {
    public $conditionID;
    public $grade;
    public $description;
    
    
    public function fillDataForID($conditionID){
        $this->db->select('*');
        $this->db->from("condition");
        $this->db->where("conditionID", $conditionID);
        $query = $this->db->get();
        if ($query->num_rows() == 1)
        {
            foreach ($query->result_array() as $row){
                $this->conditionID = $row['conditionID'];
                $this->grade = $row['grade'];
                $this->description = $row['description'];
            }
        }
    }
}
