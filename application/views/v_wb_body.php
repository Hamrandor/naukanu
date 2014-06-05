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
        echo form_close();
        
        if (isset($boatObject)) {
            echo "Name des Bootes : ".$boatObject['name'].'<br>';
            echo "Zustand         : ".$boatObject['Description'].'<br>';
            echo "Bootstyp        : ".$boatObject['typename'].'<br>';
            echo '<br>';
            echo '<br>';
            echo '<br>';
            echo '<br>';
            print_r($boatObject);
        }
?>
