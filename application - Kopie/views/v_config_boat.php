<?php
        $this->load->helper("form");
        echo '<table width="100%" border="0"><tr><td>';
        echo form_open("boatConfig");
        echo "Bitte wählen Sie ein Boot aus:<br><br>";
        echo form_dropdown('sBoatID', $boatArray, $selectedBoat);
        echo "<br>";
        echo form_submit('chooseBoat', 'Boot auswählen');        
        echo form_submit('newBoat', 'neues Boot anlegen');        
        echo "<br>";
        echo "<br>";
        echo '</td></tr></table>';
        
        if (isset($newBoatObject)){
            echo '<table width="100%" border="0">';
            echo '<tr>';
            echo '<td width="200px">';
            echo 'Name des neuen Bootes: ';
            echo '</td>';
            echo '<td>';
            echo form_input('boatName', $newBoatObject['name']);
            echo '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>';
            echo 'Bootstyp:';
            echo '</td>';
            echo '<td>';
            echo form_dropdown('sBoatTypeID', $boatTypeSelect, null);
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
            echo form_submit('saveNewBoat', 'Boot speichern');
            echo '</td>';
            echo '</tr>';
            echo '</table>';
        }
        
        if (isset($boatObject)) {
            if ($editBoat) {
                echo '<table width="100%" border="0">';
                echo '<tr>';
                echo '<td width="200px">';
                echo 'Name des Bootes: ';
                echo '</td>';
                echo '<td>';
                echo form_input('boatName', $boatObject['name']);
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'Bootstyp:';
                echo '</td>';
                echo '<td>';
                echo form_dropdown('sBoatTypeID', $boatTypeSelect, $selectedBoatType);
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'Zustand:';
                echo '</td>';
                echo '<td>';
                echo $boatObject['Description'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo form_submit('saveBoat', 'Boot speichern');
                echo '</td>';
                echo '<td>';
                echo form_submit('deleteBoat', 'Boot löschen');
                echo '</td>';               
                echo '</tr>';
                echo '</table>';                
            } else {
                echo '<table width="100%" border="0">';
                echo '<tr>';
                echo '<td width="200px">';
                echo 'Name des Bootes: ';
                echo '</td>';
                echo '<td>';
                echo $boatObject['name'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'Bootstyp:';
                echo '</td>';
                echo '<td>';
                echo $boatObject['typename'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'Zustand:';
                echo '</td>';
                echo '<td>';
                echo $boatObject['Description'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo form_submit('editBoat', 'Boot bearbeiten');
                echo '</td>';
                echo '<td>';
                echo form_submit('checkBoat', 'Boot prüfen');
                echo '</td>';
                echo '</tr>';
                echo '</table>';                
            }
        }
                
        if (isset($mastarrayofBoat)) {
            $i = 1;
            echo '<br>';
            foreach ($mastarrayofBoat as $mast){
                echo '<table width="100%" border="0">';
                echo '<tr>';
                echo '<td>';
                echo $i.'. Mast: <br>';
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td width="200px">';
                echo 'Mastname: ';
                echo '</td>';
                echo '<td>';
                echo $mast['name'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td width="200px">';
                echo 'Masttyp: ';
                echo '</td>';
                echo '<td>';
                echo $mast['typename'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td width="200px">';
                echo 'Zustand: ';
                echo '</td>';
                echo '<td>';
                echo $mast['Description'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td width="200px">';
                echo 'H&ouml;he: ';
                echo '</td>';
                echo '<td>';
                echo $mast['heigth'];
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
