<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->load->helper("form");
        echo '<table width="100%" border="0"><tr><td>';
        echo form_open("bookingConfig");
        echo "Buchung:<br><br>";
        echo form_dropdown('sBookingID', $bookingArray, $selectedBooking);
        echo "<br>";
        echo form_submit('chooseBooking', 'Buchung auswählen');        
        echo form_submit('newBooking', 'neue Buchung');
        
        echo "<br>";
        echo "<br>";
        echo '</td></tr></table>';
        
        if (isset($newBookingObject)){
            echo '<table width="100%" border="0">';
            echo '<tr>';
            echo '<td width="200px">';
            echo 'Kurs: ';
            echo '</td>';
            echo '<td>';
            echo form_dropdown('sCourseID', $courseSelect, NULL);
            echo '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>';
            echo 'Kunde/Reisegruppe:';
            echo '</td>';
            echo '<td>';
            echo form_dropdown('sCustomerID', $customerSelect, NULL);
            echo '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>';
            echo 'Material:';
            echo '</td>';
            echo '<td>';
            echo form_dropdown('sBoatID', $boatSelect, NULL);
//echo form_dropdown('sConditionID', $conditionSelect, null);
            echo '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>';
            echo 'Prüfung:';
            echo '</td>';
            echo '<td>';
            echo form_dropdown('sExamID', $examSelect, NULL);
            echo '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>';
            echo form_submit('saveNewBooking', 'Buchung speichern');
            echo '</td>';
            echo '</tr>';
            echo '</table>';
        }
        
        if (isset($bookingObject)) {
            if ($editBooking) {
                echo '<table width="100%" border="0">';
                echo '<tr>';
                echo '<td width="200px">';
                echo 'Name des Kurses: ';
                echo '</td>';
                echo '<td>';
                echo form_dropdown('sCourseID', $courseSelect,$bookingObject['courseID']);
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'Kunde/Reisegruppe:';
                echo '</td>';
                echo '<td>';
                echo form_dropdown('sCustomerID', $customerSelect, $bookingObject['customerID']);
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'Material:';
                echo '</td>';
                echo '<td>';
                echo form_dropdown('sBoatID', $boatSelect, $bookingObject['boatID']);
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'Prüfung:';
                echo '</td>';
                echo '<td>';
                echo form_dropdown('sExamID', $examSelect, $bookingObject['examID']);
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo form_submit('saveBooking', 'Buchung speichern');
                echo '</td>';
                echo '</tr>';
                echo form_submit('deleteBooking', 'Buchung löschen');
                echo '</table>';                
            } else {
                echo '<table width="100%" border="0">';
                echo '<tr>';
                echo '<td width="200px">';
                echo 'Name des Kurses: ';
                echo '</td>';
                echo '<td>';
                echo $bookingObject['courseName'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'Kunde/Reisegruppe: ';
                echo '</td>';
                echo '<td>';
                echo $bookingObject['c_name'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'Material: ';
                echo '</td>';
                echo '<td>';
                echo $bookingObject['b_name'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'Prüfung: ';
                echo '</td>';
                echo '<td>';
                echo $bookingObject['e_name'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo form_submit('editBooking', 'Buchung bearbeiten');
                echo '</td>';
                echo '</tr>';
                echo '</table>';                

            }
        }
       
        echo form_close();
        
