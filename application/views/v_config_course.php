<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->load->helper("form");
echo '<table width="100%" border="0"><tr><td>';
echo form_open("courseconfig");
echo "Bitte wählen Sie einen Kurs aus:<br><br>";
echo form_dropdown('scourseid', $coursearray, $selectedcourse);
echo "<br>";
echo form_submit('choosecourse', 'Kurs auswählen');
echo form_submit('newcourse', 'neuen Kurs anlegen');
echo "<br>";
echo "<br>";
echo '</td></tr></table>';

if (isset($newcourseobject)) {
    echo '<table width="100%" border="0">';
    echo '<tr>';
    echo '<td width="200px">';
    echo 'Name des neuen Kurses: ';
    echo '</td>';
    echo '<td>';
    echo form_input('coursename', $newcourseobject['coursename']);
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>';
    echo 'Kurstyp:';
    echo '</td>';
    echo '<td>';
    echo form_dropdown('scoursetypeid', $coursetypeselect, null);
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>';
//            echo 'Beginn:';
//            echo '</td>';
//            echo '<td>';
//            echo form_input('start', $newCourseObject['start']);
////echo form_dropdown('sConditionID', $conditionSelect, null);
//            echo '</td>';
//            echo '</tr>';
//            echo '<tr>';
//            echo '<td>';
//            echo 'Ende:';
//            echo '</td>';
//            echo '<td>';
//            echo form_input('end', $newCourseObject['end']);
//            echo '</td>';
//            echo '</tr>';
//            echo '<tr>';
//            echo '<td>';
//            echo 'Kursleiter:';
//            echo '</td>';
//            echo '<td>';
//            foreach ($employeeSelect as $employee){
//                echo form_checkbox('sEmployeeID', $employee['employeeID']);
//                echo ' '.$employee['firstName'].' '.$employee['name'].'<br>';
//                }
//            echo '</td>';
//            echo '</tr>';
//            echo '<tr>';
//            echo '<td>';
    echo form_submit('savenewcourse', 'Kurs speichern');
    echo '</td>';
    echo '</tr>';
    echo '</table>';
}

if (isset($courseobject)) {
    if ($editcourse) {
        echo '<table width="100%" border="0">';
        echo '<tr>';
        echo '<td width="200px">';
        echo 'Name des Kurses: ';
        echo '</td>';
        echo '<td>';
        echo form_input('coursename', $courseobject['coursename']);
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo 'Kurstyp:';
        echo '</td>';
        echo '<td>';
        echo form_dropdown('scoursetypeid', $coursetypeselect, $courseobject['coursetypeid']);
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
//                echo 'Beginn:';
//                echo '</td>';
//                echo '<td>';
//                echo form_input('start', $calendardetails['begin']);
//                echo '</td>';
//                echo '</tr>';
//                echo '<tr>';
//                echo '<td>';
//                echo 'Ende:';
//                echo '</td>';
//                echo '<td>';
//                echo form_input('end', $calendardetails['end']);
//                echo '</td>';
//                echo '</tr>';
//                echo '<tr>';
//                echo '<td>';
//                echo 'Kursleiter:';
//                echo '</td>';
//                echo '<td>';
//                foreach ($employeeSelect as $employee){
//                echo form_checkbox('sEmployeeID', $employee['employeeID']);
//                echo ' '.$employee['firstName'].' '.$employee['name'].'<br>';
//                }
////                form_dropdown('sEmployeeID', $employeeSelect, $courseObject['employeeID']);
//                echo '</td>';
//                echo '</tr>';
//                echo '<tr>';
//                echo '<td>';
        echo form_submit('savecourse', 'Kurs speichern');
        echo '</td>';
        echo '</tr>';
        echo form_submit('deletecourse', 'Kurs löschen');
        echo '</table>';
    } else {
        echo '<table width="100%" border="0">';
        echo '<tr>';
        echo '<td width="200px">';
        echo 'Name des Kurses: ';
        echo '</td>';
        echo '<td>';
        echo $courseobject['coursename'];
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo 'Kurstyp: ';
        echo '</td>';
        echo '<td>';
        echo $courseobject['typename'];
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
//                echo 'Beginn: ';
//                echo '</td>';
//                echo '<td>';
//                echo $calendardetails['begin'];
//                echo '</td>';
//                echo '</tr>';
//                echo '<tr>';
//                echo '<td>';
//                echo 'Ende: ';
//                echo '</td>';
//                echo '<td>';
//                echo $calendardetails['end'];
//                echo '</td>';
//                echo '</tr>';
//                echo '<tr>';
//                echo '<td>';
//                echo 'Kursleiter: ';
//                echo '</td>';
//                echo '<td>';
//                foreach ($leaderarray as $leader){
//                    echo $leader['firstName']." ".$leader["name"].'<br>';
//                }
//                echo '</td>';
//                echo '</tr>';
//                echo '<tr>';
//                echo '<td>';
        echo form_submit('editcourse', 'Kurs bearbeiten');
        echo '</td>';
        echo '</tr>';
        echo '</table>';
    }
}

echo form_close();
