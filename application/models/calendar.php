<?php
class Calendar extends CI_Model{
    function generate_calendar ($year, $month){
        echo 'Jahr='.$year."   Monat = ".$month."\n";

        $pref = array(
                   'show_next_prev'=>TRUE,
                   'next_prev_url' => base_url().'calendarConfig/showCalendar',
                   'start_day'    => 'monday',
                   'month_type'   => 'long',
                   'day_type'     => 'long'
        );
        $pref['template'] = '
        {table_open}<table class="calendar">{/table_open}
        {week_day_cell}<th class="day_header">{week_day}</th>{/week_day_cell}
        {cal_cell_content}<span class="day_listing">{day}</span>&nbsp;&bull; {content}&nbsp;{/cal_cell_content}
        {cal_cell_content_today}<div class="today"><span class="day_listing">{day}</span>&bull; {content}</div>{/cal_cell_content_today}
        {cal_cell_no_content}<span class="day_listing">{day}</span>&nbsp;{/cal_cell_no_content}
        {cal_cell_no_content_today}<div class="today"><span class="day_listing">{day}</span></div>{/cal_cell_no_content_today}
        '; 

        //$events = array (
                //15 => 'Segelkurs',
                //17 => 'Surfkurs',
        //);
        $events = $this->get_events($year, $month);
        print_r($events);
        $this->load->library('calendar', $pref);
        //$this->add_events();
        return $this->calendar->generate($year,$month, $events);   
    }
    function get_events ($year, $month){
        $events = array();
        
        $query = $this->db->select('start,description')->from ('calendarentry') ->like('start',"$year-$month") ->get();
        $query = $query->result();
        foreach ($query as $row){
            $day = (int)substr($row->start,8,2);
            
            $events[(int)$day] = $row->description;
        }
        return $events;
    }
    
//    function add_events (){
//        $events = array(
//           'start'=>'2014-08-30',
//           'description'=>'Kinderkurs');
//            $query = $this->db->get_where('calendarentry',array('start'=>$events['start']));
//            if ($query->num_rows() >)
//        $this->db->insert('calendarentry', $events);
//    }
}



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

