<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo form_open('calendarconfig/showcalendar');

$style = array(
    'class' => 'field_set',
    'hidden' => 'hidden'
);
echo form_hidden($style);
echo form_fieldset('Day Event', $style);

$text = array(
    'name' => 'day_event',
    'id' => 'day_event',
    'style' => 'width:97%'
);
echo form_input($text) . br(2);
echo form_dropdown('scourseid', $coursearray);
echo form_dropdown('semployeeid', $employeearray);

$text = array(
    'name' => 'addEvent',
    'id' => 'addEvent',
    'value' => 'Add Event',
    'style' => 'width:33%;padding:5px;',
);
echo form_submit($text);

$text = array(
    'name' => 'cancel',
    'id' => 'cancel',
    'content' => 'Cancel',
    'style' => 'width:33%;padding:5px;',
);
echo form_button($text);

$text = array(
    'name' => 'delete',
    'id' => 'delete',
    'content' => 'Delete event',
    'style' => 'width:33%;padding:5px;',
);
echo form_button($text);

echo form_fieldset_close();
//    echo form_hidden($style, $text); 
echo br();
echo $calendar . br(3);
echo form_close();