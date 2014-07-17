<?php

/*
 * to change this license header, choose license headers in project properties.
 * to change this template file, choose tools | templates
 * and open the template in the editor.
 */

/**
 * description of calendarentry
 *
 * @author jens
 */
class calendarentry extends CI_Model {

    //put your code here

    public function checkdateforboat($boatid, $adate) {
        $result = false;
        $this->db->select('*');
        $this->db->from('calendarentry as ce');
        $this->db->join('booking as b', 'b.courseid= ce.courseid', 'left');
        $this->db->where('ce.start < ', $adate);
        $this->db->where('ce.end > ', $adate);
        $this->db->where('b.boatid', $boatid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    public function checkperiodforboat($boatid, $astart, $aend) {
        $result = false;
        if ($aend > $astart) {
            $this->db->select('*');
            $this->db->from('calendarentry as ce');
            $this->db->join('booking as b', 'b.courseid= ce.courseid', 'left');
            $this->db->where('ce.start > ', $aend);
            $this->db->or_where('ce.end < ', $astart);
            $this->db->where('b.boatid', $boatid);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $result = false;
            } else {
                $result = true;
            }
        }
        return $result;
    }

}
