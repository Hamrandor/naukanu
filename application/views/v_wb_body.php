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
            echo form_open("naukanu/workbook");
            echo "Name des Bootes : ".$boatObject['name'].'<br>';
            echo "Zustand         : ".$boatObject['Description'].'<br>';
            echo "Bootstyp        : ".$boatObject['typename'].'<br>';
            echo '<br>';
            echo form_button($data);
            echo form_close();
            //print_r($boatObject);
        }
        if (isset($mastarray)) {
            $i = 1;
            foreach ($mastarray as $mast){
                echo $i.'. Mast: <br>';
                echo 'Mastname       : '.$mast['name'].'<br>';
                echo 'Zustand        : '.$mast['Description'].'<br>';
                echo 'Masttyp        : '.$mast['typename'].'<br>';
                echo 'H&ouml;he          : '.$mast['heigth'].'<br>';
                
            }
            
            //print_r($mastarray);
        }
        
        
?>
