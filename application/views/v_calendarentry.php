<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$style= array (
    'class'=>'field_set',
    'hidden'=>'hidden'
);
    echo form_fieldset('Day Event',$style);
    
    $text = array(
        'name'=>'',
        'id'=>'day_event',
        'value'=>'',
        'style'=>'width:97%'
       
    );
    echo form_input ($text).br(2);
    
    $text = array(
        'name'=>'addEvent',
        'id'=>'addEvent',
        'content'=>'Add Event',
        'style'=>'width:33%;padding:5px;',
    );
    echo form_button($text);
    
    $text = array(
        'name'=>'cancel',
        'id'=>'cancel',
        'content'=>'cancel',
        'style'=>'width:33%;padding:5px;',
    );
    
    $text = array(
        'name'=>'delete',
        'id'=>'delete',
        'content'=>'Delete',
        'style'=>'width:33%;padding:5px;',
    );
    
    echo form_fieldset_close();
echo br();
?>

<?= $calendar ?>