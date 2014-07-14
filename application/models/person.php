<?php

/*
 * to change this license header, choose license headers in project properties.
 * to change this template file, choose tools | templates
 * and open the template in the editor.
 */

/**
 * description of person
 *
 * @author rnitschke
 */
class person extends CI_Model {

    public function createnewemployeeid() {

        $this->db->select('max(employeeid)');
        $this->db->from('person');

        set($newid = $this + 1);
        return $newid;
    }

}
