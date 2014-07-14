<?php

class coursetype extends CI_Model {

    public function getcoursetypenameselect() {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('coursetype');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult[$row['coursetypeid']] = $row['typename'];
        }
        return $myresult;
    }

    public function getcoursetypeforid($id) {

        $this->db->select('*, coursetype.typename as c_typename, boattype.typename as b_typename');
        //da typename in coursetype und boattype gleich, beide umbenannt
        $this->db->from('coursetype');
        $this->db->join('boattype', 'coursetype.boattypeid = boattype.boattypeid', 'left');
        $this->db->join('license', 'coursetype.licenseid = license.licenseid', 'left');
        $this->db->where('coursetypeid', $id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row) {
                //echo 'hier row coursetype';
                //print_r($row);
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

    public function getlicenseselect() {
        $myresult = array();
        $this->db->select('*');
        $this->db->from('license');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult [$row['licenseid']] = $row['name'];
        }
        return $myresult;
    }

    public function savecoursetype($coursetypeobject) {
        //$id = $coursetypeobject['coursetypeid'];
        $data = array(
            'typename' => $coursetypeobject['c_typename'],
            'description' => $coursetypeobject['description'],
            'durationdays' => $coursetypeobject['durationdays'],
            'durationhours' => $coursetypeobject['durationhours'],
            'minparticipants' => $coursetypeobject['minparticipants'],
            'maxparticipants' => $coursetypeobject['maxparticipants'],
            'boattypeid' => $coursetypeobject['boattypeid'],
            'numberofcourseleaders' => $coursetypeobject['numberofcourseleaders'],
            'licenseid' => $coursetypeobject['licenseid'],
            'salary' => $coursetypeobject['salary'],
            'price' => $coursetypeobject['price'],
            'priceexam' => $coursetypeobject['priceexam']
        );
        if (isset($coursetypeobject['coursetypeid'])) {
            $id = $coursetypeobject['coursetypeid'];
            $this->db->where('coursetypeid', $id);
            $this->db->update('coursetype', $data);
        } else {
            $this->db->insert('coursetype', $data);
        }
    }

    public function emptycoursetype() {
        $data = array(
            'typename' => '',
            'description' => '',
            'durationdays' => '',
            'durationhours' => '',
            'minparticipants' => '',
            'maxparticipants' => '',
            'boattypeid' => '',
            'numberofcourseleaders' => '',
            'licenseid' => '',
            'salary' => '',
            'price' => '',
            'priceexam' => ''
        );
        return $data;
    }

    public function deletecoursetype($coursetypeid) {
        $this->db->where('coursetypeid', $coursetypeid);
        $this->db->delete('coursetype');
    }

}
