<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->load->helper("form");
echo '<table width="100%" border="0"><tr><td>';
echo form_open("bookingconfig");
echo "Buchung:<br><br>";
echo form_dropdown('sbookingid', $bookingarray, $selectedbooking);
echo "<br>";
echo form_submit('choosebooking', 'Buchung auswählen');
echo form_submit('newbooking', 'neue Buchung');

echo "<br>";
echo "<br>";
echo '</td></tr></table>';

if (isset($newbookingobject)) {
    echo '<table width="100%" border="0">';
    echo '<tr>';
    echo '<td width="200px">';
    echo 'Kurs: ';
    echo '</td>';
    echo '<td>';
    echo form_dropdown('scourseid', $courseselect, null);
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>';
    echo 'Kunde/Reisegruppe:';
    echo '</td>';
    echo '<td>';
    echo form_dropdown('scustomerid', $customerselect, null);
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>';
    echo 'Material:';
    echo '</td>';
    echo '<td>';
    echo form_dropdown('sboatid', $boatselect, null);
//echo form_dropdown('sConditionID', $conditionSelect, null);
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>';
    echo 'Prüfung:';
    echo '</td>';
    echo '<td>';
    echo form_dropdown('sexamid', $examselect, null);
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>';
    echo form_submit('savenewbooking', 'Buchung speichern');
    echo '</td>';
    echo '</tr>';
    echo '</table>';
}

if (isset($bookingobject)) {
    if ($editbooking) {
        echo '<table width="100%" border="0">';
        echo '<tr>';
        echo '<td width="200px">';
        echo 'Name des Kurses: ';
        echo '</td>';
        echo '<td>';
        echo form_dropdown('scourseid', $courseselect, $bookingobject['courseid']);
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo 'Kunde/Reisegruppe:';
        echo '</td>';
        echo '<td>';
        echo form_dropdown('scustomerid', $customerselect, $bookingobject['customerid']);
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo 'Material:';
        echo '</td>';
        echo '<td>';
        echo form_dropdown('sboatid', $boatselect, $bookingobject['boatid']);
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo 'Prüfung:';
        echo '</td>';
        echo '<td>';
        echo form_dropdown('sexamid', $examselect, $bookingobject['examid']);
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo form_submit('savebooking', 'Buchung speichern');
        echo '</td>';
        echo '</tr>';
        echo form_submit('deletebooking', 'Buchung löschen');
        echo '</table>';
    } else {
        echo '<table width="100%" border="0">';
        echo '<tr>';
        echo '<td width="200px">';
        echo 'Name des Kurses: ';
        echo '</td>';
        echo '<td>';
        echo $bookingobject['coursename'];
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo 'Kunde/Reisegruppe: ';
        echo '</td>';
        echo '<td>';
        echo $bookingobject['c_name'];
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo 'Material: ';
        echo '</td>';
        echo '<td>';
        echo $bookingobject['b_name'];
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo 'Prüfung: ';
        echo '</td>';
        echo '<td>';
        echo $bookingobject['e_name'];
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo form_submit('editbooking', 'Buchung bearbeiten');
        echo '</td>';
        echo '</tr>';
        echo '</table>';
    }
}


echo form_close();

echo form_open('bookingconfig/sendemail');
echo form_submit('testmail', 'Test EMail');
echo form_close();