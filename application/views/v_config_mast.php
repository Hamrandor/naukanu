<?php
        $this->load->helper("form");
        echo '<table width="100%" border="0"><tr><td>';
        echo form_open("mastConfig");
        echo "Bitte w&auml;hlen Sie einen Mast aus:<br><br>";
        echo form_dropdown('sMastID', $mastArray, $selectedMast);
        echo "<br>";
        echo form_submit('chooseMast', 'Mast auswählen');        
        echo form_submit('newMast', 'neuen Mast anlegen');        
        echo "<br>";
        echo "<br>";
        echo '</td></tr></table>';
        
        if (isset($newMastObject)){
            echo '<table width="100%" border="0">';
            echo '<tr>';
            echo '<td width="200px">';
            echo 'Name des neuen Masts: ';
            echo '</td>';
            echo '<td>';
            echo form_input('mastName', $newMastObject['name']);
            echo '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>';
            echo 'Bootstyp:';
            echo '</td>';
            echo '<td>';
            echo form_dropdown('sMastTypeID', $mastTypeSelect, null);
            echo '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>';
            echo 'Zustand:';
            echo '</td>';
            echo '<td>';
            echo form_dropdown('sConditionID', $conditionSelect, null);
            echo '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>';
            echo 'Boot:';
            echo '</td>';
            echo '<td>';
            echo form_dropdown('sBoatID', $boatSelect, null);
            echo '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>';
            echo form_submit('saveNewMast', 'Mast speichern');
            echo '</td>';
            echo '</tr>';
            echo '</table>';
        }
        
        if (isset($mastObject)) {
            if ($editMast) {
                echo '<table width="100%" border="0">';
                echo '<tr>';
                echo '<td width="200px">';
                echo 'Name des Masts: ';
                echo '</td>';
                echo '<td>';
                echo form_input('mastName', $mastObject['name']);
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'Masttyp:';
                echo '</td>';
                echo '<td>';
                echo form_dropdown('sMastTypeID', $mastTypeSelect, $selectedMastType);
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'Boot:';
                echo '</td>';
                echo '<td>';
                echo form_dropdown('sBoatID', $boatSelect, $selectedBoat);
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'Zustand:';
                echo '</td>';
                echo '<td>';
                echo $mastObject['Description'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo form_submit('saveMast', 'Mast speichern');
                echo '</td>';
                echo '</tr>';
                echo '</table>';                
            } else {
                echo '<table width="100%" border="0">';
                echo '<tr>';
                echo '<td width="200px">';
                echo 'Name des Masts: ';
                echo '</td>';
                echo '<td>';
                echo $mastObject['name'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'Masttyp:';
                echo '</td>';
                echo '<td>';
                echo $mastObject['typename'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'Boot:';
                echo '</td>';
                echo '<td>';
                echo $mastObject['boatname'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'Zustand:';
                echo '</td>';
                echo '<td>';
                echo $mastObject['Description'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo form_submit('editMast', 'Mast bearbeiten');
                echo '</td>';
                echo '</tr>';
                echo '</table>';                
//                if ((!isset($editASegel) || !$editASegel) && (!isset($editSegel) || !$editSegel)){
//                    echo form_submit('editASegel', 'Einen Segel bearbeiten').'<br>';
//               } else {
//                   if (!isset($editSegel) || !$editSegel){
//                       echo 'W&auml;hlen Sie einen Segel aus:  ';
//                       echo form_dropdown('sSegel', $totalSegelArray, $selectedSegel);
//                       echo '<br>'. form_submit('editSegel', 'Ausgew&auml;hlten Segel bearbeiten');
//                   } else {
//                       echo 'Segel bearbeiten: <br>';
//                       echo form_hidden($selectedSegel);
//                       echo 'Segelname : '.form_input('SegelName', $selectedSegel['name']).'<br>';
//                       echo 'Segeltyp  : '.form_dropdown('sSegelTypeID', $totalSegelTypeArray, $selectedSegel['canvasTypeID']).'<br>';
//                       echo 'Boot     : '.form_dropdown('sMastID', $mastArray, $selectedSegel['mastID']).'<br>';
//                       echo "Zustand  : ".$selectedSegel['Description'].'<br>';
//                       echo '<br>'. form_submit('saveSegel', 'Segel speichern');                       
//                   }
//               }
                
//                If (!$assignSegel){
//                    echo form_submit('assignSegel', 'Einen Segel diesem Boot zuordnen');
//                } else {
//                    echo form_dropdown('saveSegelToMast', $availableSegelArray, $canvasToAssign);
//                    echo form_submit('saveSegelButton', 'ausgew&auml;hlten Segel diesem Boot zuordnen');
//                    
//                }
            }
        }
                
        if (isset($canvasarrayofMast)) {
            $i = 1;
            echo '<br>';
            foreach ($canvasarrayofMast as $canvas){
                echo '<table width="100%" border="0">';
                echo '<tr>';
                echo '<td>';
                echo $i.'. Segel: <br>';
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td width="200px">';
                echo 'Segelname: ';
                echo '</td>';
                echo '<td>';
                echo $canvas['name'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td width="200px">';
                echo 'Segeltyp: ';
                echo '</td>';
                echo '<td>';
                echo $canvas['typename'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td width="200px">';
                echo 'Zustand: ';
                echo '</td>';
                echo '<td>';
                echo $canvas['Description'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td width="200px">';
                echo 'H&ouml;he: ';
                echo '</td>';
                echo '<td>';
                echo $canvas['heigth'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo '&nbsp;';
                echo '</td>';
                echo '</tr>';
                echo '</table>';                
                $i++;
            }
        echo form_close();
        }
        
?>
