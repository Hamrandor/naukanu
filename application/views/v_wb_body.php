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
?>
