<?php
        $this->load->helper("form");
        echo '<table width="100%" border="0"><tr><td>';
        echo form_open("canvasConfig");
        echo "Bitte wählen Sie ein Segel aus:<br><br>";
        echo form_dropdown('sCanvasID', $canvasArray, $selectedCanvas);
        echo "<br>";
        echo form_submit('chooseCanvas', 'Segel auswählen');        
        echo form_submit('newCanvas', 'neues Segel anlegen');        
        echo "<br>";
        echo "<br>";
        echo '</td></tr></table>';
        
        if (isset($newCanvasObject)){
            echo '<table width="100%" border="0">';
            echo '<tr>';
            echo '<td width="200px">';
            echo 'Name des neuen Segel: ';
            echo '</td>';
            echo '<td>';
            echo form_input('canvasName', $newCanvasObject['name']);
            echo '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>';
            echo 'Segeltyp:';
            echo '</td>';
            echo '<td>';
            echo form_dropdown('sCanvasTypeID', $canvasTypeSelect, null);
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
            echo 'Mast:';
            echo '</td>';
            echo '<td>';
            echo form_dropdown('sMastID', $mastSelect, null);
            echo '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>';
            echo form_submit('saveNewCanvas', 'Segel speichern');
            echo '</td>';
            echo '</tr>';
            echo '</table>';
        }
        
        if (isset($canvasObject)) {
            if ($editCanvas) {
                echo '<table width="100%" border="0">';
                echo '<tr>';
                echo '<td width="200px">';
                echo 'Name des Segel: ';
                echo '</td>';
                echo '<td>';
                echo form_input('canvasName', $canvasObject['name']);
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'Segeltyp:';
                echo '</td>';
                echo '<td>';
                echo form_dropdown('sCanvasTypeID', $canvasTypeSelect, $selectedCanvasType);
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'Mast:';
                echo '</td>';
                echo '<td>';
                echo form_dropdown('sMastID', $mastSelect, $selectedMast);
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'Zustand:';
                echo '</td>';
                echo '<td>';
                echo $canvasObject['Description'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo form_submit('saveCanvas', 'Segel speichern');
                echo '</td>';
                echo '</tr>';
                echo '</table>';                
            } else {
                echo '<table width="100%" border="0">';
                echo '<tr>';
                echo '<td width="200px">';
                echo 'Name des Segel: ';
                echo '</td>';
                echo '<td>';
                echo $canvasObject['name'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'Segeltyp:';
                echo '</td>';
                echo '<td>';
                echo $canvasObject['typename'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'Mast:';
                echo '</td>';
                echo '<td>';
                echo $canvasObject['mastname'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'Zustand:';
                echo '</td>';
                echo '<td>';
                echo $canvasObject['Description'];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo form_submit('editCanvas', 'Segel bearbeiten');
                echo '</td>';
                echo '</tr>';
                echo '</table>';                
            }
                
        echo form_close();
        }
        
?>
