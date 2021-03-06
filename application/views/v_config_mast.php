<?php

$this->load->helper("form");
echo '<table width="100%" border="0"><tr><td>';
echo form_open("mastconfig");
echo "Bitte w&auml;hlen Sie einen Mast aus:<br><br>";
echo form_dropdown('smastid', $mastarray, $selectedmast);
echo "<br>";
echo form_submit('choosemast', 'Mast auswählen');
echo form_submit('newmast', 'neuen Mast anlegen');
echo "<br>";
echo "<br>";
echo '</td></tr></table>';

if (isset($newmastobject)) {
    echo '<table width="100%" border="0">';
    echo '<tr>';
    echo '<td width="200px">';
    echo 'Name des neuen Masts: ';
    echo '</td>';
    echo '<td>';
    echo form_input('mastname', $newmastobject['name']);
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>';
    echo 'Masttyp:';
    echo '</td>';
    echo '<td>';
    $js = 'onChange="this.form.submit();"';
    echo form_dropdown('nmasttypeid', $masttypeselect, $newmastobject['masttypeid'], $js);
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
    echo 'Boot:';
    echo '</td>';
    echo '<td>';
    echo form_dropdown('sboatid', $boatselect, null);
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>';
    echo form_submit('savenewmast', 'Mast speichern');
    echo '</td>';
    echo '</tr>';
    echo '</table>';
}

if (isset($mastobject)) {
    if ($editmast) {
        echo form_hidden('emastid', $mastobject['mastid']);
        echo form_hidden('econditionid', $mastobject['conditionid']);
        echo form_hidden('eboattypeid', $mastobject['boattypeid']);
        echo '<table width="100%" border="0">';
        echo '<tr>';
        echo '<td width="200px">';
        echo 'Name des Masts: ';
        echo '</td>';
        echo '<td>';
        echo form_input('mastname', $mastobject['name']);
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo 'Masttyp:';
        echo '</td>';
        echo '<td>';
        echo form_dropdown('smasttypeid', $masttypeselect, $mastobject['masttypeid'], 'disabled');
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo 'Boot:';
        echo '</td>';
        echo '<td>';
        echo form_dropdown('sboatid', $boatselect, $mastobject['boatid']);
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo 'Zustand:';
        echo '</td>';
        echo '<td>';
        echo $mastobject['description'];
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo form_submit('savemast', 'Mast speichern');
        echo '</td>';
        echo '<td>';
        echo form_submit('deletemast', 'Mast löschen');
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
        echo $mastobject['name'];
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo 'Masttyp:';
        echo '</td>';
        echo '<td>';
        echo $mastobject['typename'];
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo 'Boot:';
        echo '</td>';
        echo '<td>';
        echo $mastobject['boatname'];
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo 'Zustand:';
        echo '</td>';
        echo '<td>';
        echo $mastobject['description'];
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo form_submit('editmast', 'Mast bearbeiten');
        echo '</td>';
        echo '</tr>';
        echo '</table>';
    }
}

if (isset($canvasarrayofmast)) {
    $i = 1;
    echo '<br>';
    foreach ($canvasarrayofmast as $canvas) {
        echo '<table width="100%" border="0">';
        echo '<tr>';
        echo '<td>';
        echo $i . '. Segel: <br>';
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
        echo $canvas['description'];
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td width="200px">';
        echo 'Gr&ouml;&szlig;e : ';
        echo '</td>';
        echo '<td>';
        echo $canvas['size'];
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