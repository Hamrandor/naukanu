<?php

/*
 * to change this license header, choose license headers in project properties.
 * to change this template file, choose tools | templates
 * and open the template in the editor.
 */

/**
 * description of calendarentry
 * 
 * Zusatzfunktionen aus dem Material für die Zuordnung von Booten über den Kalender
 *
 * @author jens
 */
class calendarentry extends CI_Model {

    //put your code here
        public function __construct() {
        //laden unserer models (/application/models/user.php)
        //methoden des models können dann verwendet werden mit z. b. $this->user->[..];

            //boot laden
        $this->load->model(array('boat'));
    }


    public function checkdateforboat($adate, $boatid) {
        $result = false;
        $this->db->select('*');
        $this->db->from('calendarentry as ce');
        $this->db->join('booking as b', 'b.courseid= ce.courseid', 'left');
        $this->db->where('ce.start', $adate);
//        spätere Erweiterung auf Zeiträume
//        $this->db->where('ce.start < ', $adate);
//        $this->db->where('ce.end > ', $adate);
        $this->db->where('b.boatid', $boatid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    //später
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
    
    
    public function getcalendarentryarrayforcourseid($courseid){
        $result = array();
        $this->db->select('*');
        $this->db->from('calendarentry');
        $this->db->where('courseid', $courseid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $result[] = $row;
            }
        }
        return $result;
    }
    
    public function checkboatassignmenttocourse($boatid, $courseid){
        $result = true;
        //Check ob Boot i.O.
        if (!($this->boat->boatreadyforuse($boatid))){
           $result = false;
        }
        //Check ob boot zu den gewuenschten Terminen verfuegbar (alle Kurstermine)
        if ($result) {
            foreach ($this->getcalendarentryarrayforcourseid($courseid) as $ce) {
                if (!($this->checkdateforboat($ce['start'], $boatid))){
                    return FALSE;
                }
            }    
        }
        return $result;
    }
    
    public function filterarrayforperiod($from, $to, $boatarray) {
        $result = array();
        foreach ($boatarray as $boatid => $name) {
            if ($this->checkperiodforboat($boatid, $from, $to)) {
                $result[$boatid] = $name;
            }
        }
        return $result;
    }

    public function getboatarrayreadyforperiodforboattype($from, $to, $boattypeid) {
        $boatarray = $this->boat->boatarrayfortype($boattypeid);
        $readyarray = $this->boat->filterarraybyreadyforuse($boatarray);
        $result = $this->filterarrayforperiod($from, $to, $readyarray);
        return $result;
    }

}
