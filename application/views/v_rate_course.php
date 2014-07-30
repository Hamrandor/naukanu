<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$this->load->helper("form");

echo '<table width="100%" border="0"><tr><td>';
echo form_open("ratecourse");
echo "Welcher Mitarbeiter soll bewertet werden?<br><br>";
echo form_dropdown('semployee', $employeearray, $selectedemployee);
echo "<br>";
echo form_submit('chooseemployee', 'Mitarbeiter auswählen');
echo "<br>";
echo "<br>";
echo '</td></tr></table>';

if (isset($selectedcourse)) {
    echo '<table width="100%" border="0"><tr><td>';
    echo "Welcher Kurs soll bewertet werden?<br><br>";
    echo form_dropdown('scourse', $coursearray, $selectedcourse);
    echo "<br>";
    echo form_submit('choosecourse', 'Kurs auswählen');
    echo "<br>";
    echo "<br>";
    echo '</td></tr></table>';
    }
    
    
echo form_close();