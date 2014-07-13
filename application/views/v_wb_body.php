

<?php

$this->load->helper("form");
// put your code here
echo form_open("naukanu/configureBoat");
//        echo "<br> selboot=";
//        print_r($selectedBoat);        
echo "Bitte w&auml;hlen Sie ein Boot aus:<br><br>";
echo form_dropdown('sBoatID', $boatArray, $selectedBoat);
echo "<br>";
echo form_submit('chooseBoat', 'Boot auswählen');
echo "<br>";
echo "<br>";
if (isset($boatObject)) {
    if ($editBoat) {
        echo '<br>';
        echo "Name des Bootes : " . form_input('boatName', $boatObject['name']) . '<br>';
//                echo "Anzahl Sitze    : ".form_input('seatCount', $boatObject['seatCount']).'<br>';
        echo "Zustand         : " . $boatObject['Description'] . '<br>';
        echo "Bootstyp        : " . form_dropdown('sBoatTypeID', $boatTypeSelect, $selectedBoatType) . '<br>';
        echo '<br>';
        echo '<br>';
        echo form_submit('saveBoat', 'Boot speichern');
        echo '<br>';
        echo '<br>';
    } else {
        //echo form_open("naukanu/editBoat");
        echo "Name des Bootes : " . $boatObject['name'] . '<br>';
        echo "Zustand         : " . $boatObject['Description'] . '<br>';
        echo "Bootstyp        : " . $boatObject['typename'] . '<br>';
        echo '<br>';
        echo form_submit('editBoat', 'Boot bearbeiten');
        echo '<br>';
        if ((!isset($editAMast) || !$editAMast) && (!isset($editMast) || !$editMast)) {
            echo form_submit('editAMast', 'Einen Mast bearbeiten') . '<br>';
        } else {
            if (!isset($editMast) || !$editMast) {
                echo 'W&auml;hlen Sie einen Mast aus:  ';
                echo form_dropdown('sMast', $totalMastArray, $selectedMast);
                echo '<br>' . form_submit('editMast', 'Ausgew&auml;hlten Mast bearbeiten');
            } else {
                echo 'Mast bearbeiten: <br>';
                echo form_hidden($selectedMast);
                echo 'Mastname : ' . form_input('MastName', $selectedMast['name']) . '<br>';
                echo 'Masttyp  : ' . form_dropdown('sMastTypeID', $totalMastTypeArray, $selectedMast['mastTypeID']) . '<br>';
                echo 'Boot     : ' . form_dropdown('sBoatID', $boatArray, $selectedMast['boatID']) . '<br>';
                echo "Zustand  : " . $selectedMast['Description'] . '<br>';
                echo '<br>' . form_submit('saveMast', 'Mast speichern');
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
        echo 'Zustand        : ' . $mast['Description'] . '<br>';
        echo 'Masttyp        : ' . $mast['typename'] . '<br>';
        echo 'H&ouml;he          : ' . $mast['heigth'] . '<br>';
        $i++;
    }
    echo form_close();
}
?>
