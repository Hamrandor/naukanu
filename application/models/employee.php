<?php

/*
 * to change this license header, choose license headers in project properties.
 * to change this template file, choose tools | templates
 * and open the template in the editor.
 */

/**
 * description of employee
 *
 * @author rnitschke
 */
class employee extends person {

    public function selectexistingemployees() {
        $myresult = array('employeesdata');
        $this->db->select('*');
        $this->db->from('person');
        $this->db->join('employee', 'employee.employeeid = person.employeeid', 'left');
        $this->db->where('employeeid is not null');

        return ['employeesdata'];
    }

    public function updateexistingemployee() {
        
    }

    public function deleteexistingemployee() {
        
    }

}

$employeeid = employeeid;
$personid = personid;
