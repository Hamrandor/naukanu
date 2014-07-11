<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of calendarEntry
 *
 * @author Jens
 */
class calendarEntry extends CI_Model {
    //put your code here
    
    public function checkDateForBoat($boatID, $aDate){
        $result = false;
        $this->db->select('*');
        $this->db->from('calendarEntry as ce');
        $this->db->join('booking as b', 'b.courseID= ce.courseID','left');
        $this->db->where('ce.start < ', $aDate);
        $this->db->where('ce.end > ', $aDate);
        $this->db->where('b.boatID', $boatID );
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            $result = FALSE;
        } else {
            $result = TRUE;
        }
        return $result;
        
    }
    
    public function checkPeriodForBoat($boatID, $aStart, $aEnd){
        $result = false;
        if ($aEnd > $aStart){
            $this->db->select('*');
            $this->db->from('calendarEntry as ce');
            $this->db->join('booking as b', 'b.courseID= ce.courseID','left');
            $this->db->where('ce.start > ', $aEnd);
            $this->db->or_where('ce.end < ', $aStart);
            $this->db->where('b.boatID', $boatID );
            $query = $this->db->get();
            if ($query->num_rows() > 0)
            {
                $result = FALSE;
            } else {
                $result = TRUE;
            }
        }
        return $result;
    }
    
}
