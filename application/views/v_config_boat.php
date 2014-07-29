<?php

$this->load->helper("form");
echo '<table width="100%" border="0"><tr><td>';
echo form_open("boatconfig");
echo "Bitte wählen Sie ein Boot aus:<br><br>";
echo form_dropdown('sboatid', $boatarray, $selectedboat);
echo "<br>";
echo form_submit('chooseboat', 'Boot auswählen');
echo form_submit('newboat', 'neues Boot anlegen');
echo "<br>";
echo "<br>";
echo '</td></tr></table>';

if (isset($newboatobject)) {
    echo '<table width="100%" border="0">';
    echo '<tr>';
    echo '<td width="200px">';
    echo 'Name des neuen Bootes: ';
    echo '</td>';
    echo '<td>';
    echo form_input('boatname', $newboatobject['name']);
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>';
    echo 'Bootstyp:';
    echo '</td>';
    echo '<td>';
    echo form_dropdown('sboattypeid', $boattypeselect, null);
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>';
    echo 'Zustand:';
    echo '</td>';
    echo '<td>';
    echo form_dropdown('sconditionid', $conditionselect, null);
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>';
    echo form_submit('savenewboat', 'Boot speichern');
    echo '</td>';
    echo '</tr>';
    echo '</table>';
}

if (isset($boatobject)) {
    if ($editboat) {
        echo '<table width="100%" border="0">';
        echo '<tr>';
        echo '<td width="200px">';
        echo 'Name des Bootes: ';
        echo '</td>';
        echo '<td>';
        echo form_input('boatname', $boatobject['name']);
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo 'Bootstyp:';
        echo '</td>';
        echo '<td>';
        echo form_dropdown('sboattypeid', $boattypeselect, $selectedboattype);
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo 'Zustand:';
        echo '</td>';
        echo '<td>';
        echo $boatobject['description'];
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo form_submit('saveboat', 'Boot speichern');
        echo '</td>';
        echo '<td>';
        echo form_submit('deleteboat', 'Boot löschen');
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
        echo $boatobject['name'];
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo 'Bootstyp:';
        echo '</td>';
        echo '<td>';
        echo $boatobject['typename'];
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo 'Zustand:';
        echo '</td>';
        echo '<td>';
        echo $boatobject['description'];
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo form_submit('editboat', 'Boot bearbeiten');
        echo '</td>';
        echo '<td>';
        echo form_submit('checkboat', 'Boot prüfen');
        echo '</td>';
        echo '</tr>';
        echo '</table>';
    }
}

if (isset($mastarrayofboat)) {
    $i = 1;
    echo '<br>';
    foreach ($mastarrayofboat as $mast) {
        echo '<table width="100%" border="0">';
        echo '<tr>';
        echo '<td>';
        echo $i . '. Mast: <br>';
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
        echo $mast['description'];
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
