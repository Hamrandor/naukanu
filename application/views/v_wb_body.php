Hirsenbirsen
<?php
        $this->load->helper("form");
        // put your code here
        echo "bla4 <br>";
        print_r($boatArray);
        echo "bla5 <br>";
        echo form_open("naukanu/workbook");
        echo "<br> selboot=";
        print_r($selectedBoat);        
        echo "<br>";
        echo form_dropdown('sBoatID', $boatArray, $selectedBoat, 'onChange="this.form.submit()"');
        
        if (isset($boatObject)) {
            if ($editBoat) {
                echo '<br>';
                echo "Name des Bootes : ".form_input('boatName', $boatObject['name']).'<br>';
                echo "Anzahl Sitze    : ".form_input('seatCount', $boatObject['seatCount']).'<br>';
                echo "Zustand         : ".$boatObject['Description'].'<br>';
                echo "Bootstyp        : ".form_dropdown('sBoatTypeID', $boatTypeSelect, $selectedBoatType).'<br>';
                echo '<br>';
                echo '<br>';
                echo form_submit('saveBoat', 'Boot speichern');
                echo '<br>';
                echo '<br>';
                echo 'Einen Mast diesem Boot zuordnen';

                
                
                
            } else {
            //echo form_open("naukanu/editBoat");
                echo "Name des Bootes : ".$boatObject['name'].'<br>';
                echo "Zustand         : ".$boatObject['Description'].'<br>';
                echo "Bootstyp        : ".$boatObject['typename'].'<br>';
                echo '<br>';
                echo form_submit('editBoat', 'Boot bearbeiten');
            //echo form_close();
            //print_r($boatObject);
            }
        }
        if (isset($mastarray)) {
            $i = 1;
            echo '<br>';
            foreach ($mastarray as $mast){
                echo '<br>';
                echo $i.'. Mast: <br>';
                echo 'Mastname       : '.$mast['name'].'<br>';
                echo 'Zustand        : '.$mast['Description'].'<br>';
                echo 'Masttyp        : '.$mast['typename'].'<br>';
                echo 'H&ouml;he          : '.$mast['heigth'].'<br>';
                $i++;
            }
        echo form_close();
        }
        
?>
