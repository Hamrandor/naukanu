<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of employee
 *
 * @author rnitschke
 */
class employee extends person {

    public function selectExistingEmployees() {
        $myresult = array('employeesData');
        $this->db->select('*');
        $this->db->from('person');
        $this->db->join('employee', 'employee.employeeID = person.employeeID', 'left');
        $this->db->where('employeeID is not null');

        return ['employeesData'];
    }

    public function updateExistingEmployee() {
        
    }

    public function deleteExistingEmployee() {
        
    }

}

$employeeID = employeeID;
$personID = personID;
