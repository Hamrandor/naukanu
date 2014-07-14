

<?php

$this->load->helper("form");
// put your code here
echo form_open("naukanu/configureboat");
//        echo "<br> selboot=";
//        print_r($selectedBoat);        
echo "Bitte w&auml;hlen Sie ein Boot aus:<br><br>";
echo form_dropdown('sboatid', $boatarray, $selectedboat);
echo "<br>";
echo form_submit('chooseboat', 'Boot auswählen');
echo "<br>";
echo "<br>";
if (isset($boatobject)) {
    if ($editboat) {
        echo '<br>';
        echo "Name des Bootes : " . form_input('boatname', $boatobject['name']) . '<br>';
//                echo "Anzahl Sitze    : ".form_input('seatCount', $boatObject['seatCount']).'<br>';
        echo "Zustand         : " . $boatobject['description'] . '<br>';
        echo "Bootstyp        : " . form_dropdown('sboattypeid', $boattypeselect, $selectedboattype) . '<br>';
        echo '<br>';
        echo '<br>';
        echo form_submit('saveboat', 'Boot speichern');
        echo '<br>';
        echo '<br>';
    } else {
        //echo form_open("naukanu/editBoat");
        echo "Name des Bootes : " . $boatobject['name'] . '<br>';
        echo "Zustand         : " . $boatObject['description'] . '<br>';
        echo "Bootstyp        : " . $boatObject['typename'] . '<br>';
        echo '<br>';
        echo form_submit('editboat', 'Boot bearbeiten');
        echo '<br>';
        if ((!isset($editamast) || !$editamast) && (!isset($editmast) || !$editmast)) {
            echo form_submit('editamast', 'Einen Mast bearbeiten') . '<br>';
        } else {
            if (!isset($editmast) || !$editmast) {
                echo 'W&auml;hlen Sie einen Mast aus:  ';
                echo form_dropdown('smast', $totalmastarray, $smaterialtype);
                echo '<br>' . form_submit('editmast', 'Ausgew&auml;hlten Mast bearbeiten');
            } else {
                echo 'Mast bearbeiten: <br>';
                echo form_hidden($smaterialtype);
                echo 'Mastname : ' . form_input('mastname', $smaterialtype['name']) . '<br>';
                echo 'Masttyp  : ' . form_dropdown('smasttypeid', $totalmasttypearray, $smaterialtype['masttypeid']) . '<br>';
                echo 'Boot     : ' . form_dropdown('sboatid', $boatarray, $smaterialtype['boatID']) . '<br>';
                echo "Zustand  : " . $smaterialtype['description'] . '<br>';
                echo '<br>' . form_submit('savemast', 'Mast speichern');
            }
        }

//                If (!$assignMast){
//                    echo form_submit('assignMast', 'Einen Mast diesem Boot zuordnen');
//                } else {
//                    echo form_dropdown('saveMastToBoat', $availableMastArray, $mastToAssign);
//                    echo form_submit('saveMastButton', 'ausgew&auml;hlten Mast diesem Boot zuordnen');
//                    
//                }

        echo '<br>';



        //echo form_close();
        //print_r($boatObject);
    }
}


if (isset($mastarrayofBoat)) {
    $i = 1;
    echo '<br>';
    foreach ($mastarrayofBoat as $mast) {
        echo '<br>';
        echo $i . '. Mast: <br>';
        echo 'Mastname       : ' . $mast['name'] . '<br>';
        echo 'Zustand        : ' . $mast['description'] . '<br>';
        echo 'Masttyp        : ' . $mast['typename'] . '<br>';
        echo 'H&ouml;he          : ' . $mast['heigth'] . '<br>';
        $i++;
    }
    echo form_close();
}
?>
