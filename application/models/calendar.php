<?php

class Calendar extends CI_Model {

    function generate_calendar($year, $month) {
//        echo 'Jahr='.$year."   Monat = ".$month."\n";

        $pref = array(
            'show_next_prev' => TRUE,
            'next_prev_url' => base_url() . 'calendarconfig/showcalendar',
            'start_day' => 'monday',
            'month_type' => 'long',
            'day_type' => 'long'
        );
//        $pref['template'] = '
//        {table_open}<table class="calendar">{/table_open}
//        {week_day_cell}<th class="day_header">{week_day}</th>{/week_day_cell}
//        {cal_cell_content}<span class="day_listing">{day}</span>&nbsp;&bull; {content}&nbsp;{/cal_cell_content}
//        {cal_cell_content_today}<div class="today"><span class="day_listing">{day}</span>&bull; {content}</div>{/cal_cell_content_today}
//        {cal_cell_no_content}<span class="day_listing">{day}</span>&nbsp;{/cal_cell_no_content}
//        {cal_cell_no_content_today}<div class="today"><span class="day_listing">{day}</span></div>{/cal_cell_no_content_today}
//        '; 
        //$events = array (
        //15 => 'Segelkurs',
        //17 => 'Surfkurs',
        //);
//        print_r($events);
        $this->load->library('calendar', $pref);
        $events = $this->get_events($year, $month);
        //$this->add_events();
        return $this->calendar->generate($year, $month, $events);
    }

//    function get_events ($year, $month){
//        $events = array();
//        
//        $query = $this->db->select('start,description')->from ('calendarentry') ->like('start',"$year-$month") ->get();
//        $query = $query->result();
//        foreach ($query as $row){
//            $day = (int)substr($row->start,8,2);
//            
//            $events[(int)$day] = $row->description;
//        }
//        return $events;
//    }

    function get_events($year, $month) {
        $query = $this->db->query("SELECT DISTINCT DATE_FORMAT(start, '%Y-%m-%e') AS start
                                            FROM calendarentry
                                            WHERE start LIKE '$year-$month%' "); //date format eliminates zeros make
        //days look 05 to 5

        $cal_data = array();

        foreach ($query->result() as $row) { //for every date fetch data
            $a = array();
            $i = 0;
            echo "SELECT description
                                                FROM calendarentry
                                                WHERE start LIKE DATE_FORMAT('$row->start', '%Y-%m-%d 00:00:00') ";
            $query2 = $this->db->query("SELECT description
                                                FROM calendarentry
                                                WHERE start LIKE DATE_FORMAT('$row->start', '%Y-%m-%d 00:00:00') ");
            //date format change back the date format
            //that fetched earlier
            print_r($row);
            foreach ($query2->result() as $r) {
                print_r($r);
                $a[$i] = $r->description;     //make data array to put to specific date
                $i++;
            }
            $cal_data[(int) substr($row->start, 8, 2)] = $a;
        }
        print_r($cal_data);
        return $cal_data;
    }

    function add_events($date, $event, $employeeid, $courseid) {
        echo 'Hier werden Events gespeichert:   date='.$date.'event='.$event.'empid='.$employeeid.'courseid='.$courseid;
                
        //$events = array(
        //'start'=>'2014-08-30',
        //'description'=>'Kinderkurs');
//            $query = $this->db->get_where('calendarentry',array('start'=>$date));
//            if ($query->num_rows() > 0) {
//                $this->db->where('start',$date);
//                $this->db->update('calendarentry', array('description'=>$event));
//              //  echo "Event does exist";
//            }else {
        $this->db->insert('calendarentry', array('start' => $date, 'description' => $event, 'employeeid' => $employeeid, 'courseid' => $courseid));
        redirect("calendarconfig");
//    }
    }

    function delete_event($date) {
        $this->db->delete('calendarentry', array('start' => $date));
    }

    function java_functions() {
//            $click_function = "
//                alert('ok');
//            ";
        $hide = "
                $('.field_set').hide();
            ";
        $function = "
                $('.field_set').fadeIn(600);
                $('.this_day').removeClass('selected');
                $(this).addClass('selected');
                var day_event = $('.selected .day_event').text();
                $('#day_event').val(day_event);
                if (day_event != ''){
                    $('#addEvent').val('Save Event');
                    $('#delete').show();
                }else {
                    $('#addEvent').val('Add Event');
                    $('#delete').hide();
                }
                

            ";
        $add_new_event = "
                var selected_day = $('.selected .day_num').text();
                var event = $('#day_event').val();
                if ( (selected_day == '') || (event == '')){
                    if(selected_day == ''){
                        alert('select a valid day')
                        $('.this_day').removeClass('selected');
                        exit;
                    }
                    if (event == ''){
                        alert('enter an event')
                    }
                
                }else {
                    $.ajax({
                    url:window.location,
                    type:'POST',
                    data:{
                        day :   selected_day,
                        event   :   event
                    } ,
                    success :   function (msg){
                        location.reload();
                    }    
                    });
                    }
            ";
        $cancel_button = "
               $('.field_set').hide();
               $('.this_day').removeClass('selected');
           ";

        $delete_button = "
               var selected_day = $('.selected .day_num').text();
               var day_event = $('.selected .day_event').text();
               if (day_event != ''){
               
                $.ajax({
                    url:window.location,
                    type:'POST',
                    data:{
                        day_to_delete :   selected_day,
                    } ,
                    success :   function (msg){
                        location.reload();
                        }
                    });
                    }
                   ";
//            $this->javascript->click('.calendar td',$function, $click_function);
//            $this->load->library('jquery');
//            $this->javascript->onload('.field_set', $hide); 
        $this->javascript->click('.this_day', $function);
        $this->javascript->click('#addEvent', $add_new_event);
        $this->javascript->click('#cancel', $cancel_button);
        $this->javascript->click('#delete', $delete_button);
        $this->javascript->compile();
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

