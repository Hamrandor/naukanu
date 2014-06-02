Hirsenbirsen
<?php
        $this->load->helper("form");
        // put your code here
        echo "bla4 <br>";
        print_r($boatArray);
        echo "bla5 <br>";
        echo form_open("naukanu/config");
        echo form_dropdown('sBoatID', $boatArray, '', 'onChange="this.form.submit()"');
        echo form_close();
?>
