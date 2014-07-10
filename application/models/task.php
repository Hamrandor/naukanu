<?php

/**
 * Description of task
 *
 * @author Jens
 */
class task extends CI_Model {
    
    public function __construct(){
        //Laden unserer models (/application/models/user.php)
        //Methoden des models können dann verwendet werden mit z. B. $this->user->[..];
//        $this->load->model(array('mast', 'calendarEntry'));
    }
    
    public function saveTask($task){
        $data = Array(
            'initiatorID' => $task['initiatorID'],
            'performerID' => $task['performerID'],
            'comment' => $task['comment'],
            'dueDate' => $task['dueDate'],
            'ticketStatusID' => $task['ticketStatusID']
        );
        $tDB = array(
            'name' => $task['name']
        );
        if (isset($task['taskID']) && $task['taskID'] != null) {
            $tid = $task['taskID'];
            $this->db->where('taskID', $tid);
            $this->db->update('task', $tDB);
        } else {
            $this->db->insert('task', $tDB);
            $query = $this->db->query('SELECT taskID FROM task where name like \''.$tDB['name'].'\' LIMIT 1');
            $row = $query->row();
            $data['taskID']= $row->taskID;
        }
        if (isset($task['ticketID']) && $task['ticketID'] != null) {
            $id = $task['ticketID'];
            $this->db->where('ticketID', $id);
            $this->db->update('ticket', $data);
        } else {
            $this->db->insert('ticket', $data);
        }
    }
    
    public function getPerformerTaskArrayForUsername($username){
        $result = array();
        $this->db->select('*')->
                from('user')->
                join('person', 'user.personID=person.personID','left') ->
                join('ticket', 'ticket.performerID = person.employeeID', 'left')->
                join('task', 'ticket.taskID = task.taskID', 'left')->
                where('login', $username);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            foreach($query->result_array() as $row){
                $result[]=$row;
            }
        }
        return $result;
    }
    
    public function getPerformerTaskCountForUsername($username){
        $result = array();
        $this->db->select('count(*) as c')->
                from('user')->
                join('person', 'user.personID=person.personID','left') ->
                join('ticket', 'ticket.performerID = person.employeeID', 'left')->
                where('login', $username)->
                where('ticketStatusID != 4', null);
        $result = $this->db->get()->row()->c;
        return $result;
    }
  
    
    public function getInitiatorTaskArrayForUsername($username){
        $result = array();
        $this->db->select('*')->
                from('user')->
                join('person', 'user.personID=person.personID','left') ->
                join('ticket', 'ticket.initiatorID = person.employeeID', 'left')->
                join('task','task.taskID=ticket.taskID', 'left')->
                where('login', $username);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            foreach($query->result_array() as $row){
                $result[]=$row;
            }
        }
        return $result;
    }
    
    public function getEmployeeSelect($aRole){
        $myresult = array();
        $this->db->select('*')
                ->from('employee')
                ->join('person','employee.employeeID = person.employeeid', 'left');
        if (isset($aRole) && $aRole != NULL) {
            $this->db->join('employeerole', 'employeerole.roleID = employee.roleID', 'right');
            $this->db->where('employeeRole.roleID', $aRole);
        }
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $myresult[$row['employeeID']] = $row['firstName'].' '.$row['name'];
        }
        return $myresult;
    }
    
    public function getTicketStatusArray(){
        $myresult = array();
        $this->db->select('*')
                ->from('ticketstatus');
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $myresult[$row['ticketStatusID']] = $row['status'];
        }
        return $myresult;
    }
    
    public function emptyTask(){
        return array(
            'initiatorID' => 'null',
            'performerID' => 'null',
            'comment' => '',
            'name' => '',
            'dueDate' => 'null',
            'ticketStatusID' => null
        );
    }
    
    public function getUser($user){
        $result = array();
        $name = '';
        $this->db->select('*')->from('person')
                ->join('user','user.personID=person.personID', 'right')
                ->where('user.login',$user);
        $query = $this->db->get();
        if ($query->num_rows() ==1)
        {
            foreach($query->result_array() as $row){
                $row['fullName'] = $row['firstName']." ".$row['name'];
                $result = $row;                
            }
        }
        
        return $result;
    }

    public function getTaskForID($id){
        $result = array();
        $this->db->select('*')->from('ticket')
                -> join('task','task.taskID=ticket.taskID', 'left')
                -> where('ticketID',$id);
        $query = $this->db->get();
        if ($query->num_rows() ==1)
        {
            foreach($query->result_array() as $row){
                $result = $row;
            }
        }
        return $result;
    }
}
