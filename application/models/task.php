<?php

/**
 * description of task
 *
 * @author jens
 */
class task extends CI_Model {

    public function __construct() {
        //laden unserer models (/application/models/user.php)
        //methoden des models können dann verwendet werden mit z. b. $this->user->[..];
//        $this->load->model(array('mast', 'calendarentry'));
    }

    public function savetask($task) {
        $data = array(
            'initiatorid' => $task['initiatorid'],
            'performerid' => $task['performerid'],
            'comment' => $task['comment'],
            'duedate' => $task['duedate'],
            'ticketstatusid' => $task['ticketstatusid']
        );
        $tdb = array(
            'name' => $task['name']
        );
        if (isset($task['taskid']) && $task['taskid'] != null) {
            $tid = $task['taskid'];
            $this->db->where('taskid', $tid);
            $this->db->update('task', $tdb);
        } else {
            $this->db->insert('task', $tdb);
            $query = $this->db->query('select taskid from task where name like \'' . $tdb['name'] . '\' limit 1');
            $row = $query->row();
            $data['taskid'] = $row->taskid;
        }
        if (isset($task['ticketid']) && $task['ticketid'] != null) {
            $id = $task['ticketid'];
            $this->db->where('ticketid', $id);
            $this->db->update('ticket', $data);
        } else {
            $this->db->insert('ticket', $data);
        }
    }

    public function getperformertaskarrayforusername($username) {
        $result = array();
        $this->db->select('*')->
                from('user')->
                join('person', 'user.personid=person.personid', 'left')->
                join('ticket', 'ticket.performerid = person.employeeid', 'left')->
                join('task', 'ticket.taskid = task.taskid', 'left')->
                where('login', $username);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $result[] = $row;
            }
        }
        return $result;
    }

    public function getperformertaskcountforusername($username) {
        $result = array();
        $this->db->select('count(*) as c')->
                from('user')->
                join('person', 'user.personid=person.personid', 'left')->
                join('ticket', 'ticket.performerid = person.employeeid', 'left')->
                where('login', $username)->
                where('ticketstatusid != 4', null);
        $result = $this->db->get()->row()->c;
        return $result;
    }

    public function getinitiatortaskarrayforusername($username) {
        $result = array();
        $this->db->select('*')->
                from('user')->
                join('person', 'user.personid=person.personid', 'left')->
                join('ticket', 'ticket.initiatorid = person.employeeid', 'left')->
                join('task', 'task.taskid=ticket.taskid', 'left')->
                where('login', $username);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $result[] = $row;
            }
        }
        return $result;
    }

    public function getemployeeselect($arole) {
        $myresult = array();
        $this->db->select('*')
                ->from('employee')
                ->join('person', 'employee.employeeid = person.employeeid', 'left');
        if (isset($arole) && $arole != null) {
            $this->db->join('employeerole', 'employeerole.roleid = employee.roleid', 'right');
            $this->db->where('employeerole.roleid', $arole);
        }
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult[$row['employeeid']] = $row['firstname'] . ' ' . $row['name'];
        }
        return $myresult;
    }

    public function getticketstatusarray() {
        $myresult = array();
        $this->db->select('*')
                ->from('ticketstatus');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $myresult[$row['ticketstatusid']] = $row['status'];
        }
        return $myresult;
    }

    public function emptytask() {
        return array(
            'initiatorid' => 'null',
            'performerid' => 'null',
            'comment' => '',
            'name' => '',
            'duedate' => 'null',
            'ticketstatusid' => null
        );
    }

    public function getuser($user) {
        $result = array();
        $name = '';
        $this->db->select('*')->from('person')
                ->join('user', 'user.personid=person.personid', 'right')
                ->where('user.login', $user);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row) {
                $row['fullname'] = $row['firstname'] . " " . $row['name'];
                $result = $row;
            }
        }

        return $result;
    }

    public function gettaskforid($id) {
        $result = array();
        $this->db->select('*')->from('ticket')
                ->join('task', 'task.taskid=ticket.taskid', 'left')
                ->where('ticketid', $id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row) {
                $result = $row;
            }
        }
        return $result;
    }

}
