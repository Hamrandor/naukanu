<?php

$this->load->helper(array("form"));

if (!isset($smaterialtype) || $smaterialtype == null) {
    echo form_open("ratematerial/selectmaterialtype");
    echo "Welches Material soll bewertet werden?<br><br>";
    foreach ($materialtype as $type) {
        echo form_radio('smaterialtype', $type) . $type . '<br>';
    }
    echo "<br>";
    echo form_submit('choosematerialtype', 'Materialart auswählen');
    echo form_close();
} else {
    if (!isset($sobject) || $sobject == null) {
        echo form_open("ratematerial/chooseobject");
        if ($smaterialtype == 'mast') {
            echo "Welcher $smaterialtype soll bewertet werden?<br><br>";
        } else {
            echo "Welches $smaterialtype soll bewertet werden?<br><br>";
        }
        echo form_dropdown('sobject', $slist, null);
        echo form_hidden('smaterialtype', $smaterialtype);
        echo "<br>";
        echo form_submit('chooseobject', $smaterialtype . ' auswählen');
        echo form_close();
    } else {
        echo form_open("ratematerial/rateobject");
        echo form_hidden('smaterialtype', $smaterialtype);
        echo form_hidden('sobjectid', $sobjectid);
        if ($smaterialtype == 'mast') {
            echo "Bitte bewerten Sie folgenden $smaterialtype.<br><br>";
        } else {
            echo "Bitte bewerten Sie folgendes $smaterialtype.<br><br>";
        }
        $this->load->library('table');
        $objectname = $sobject['name'];
        $matname = $smaterialtype . '-Name : ';
        echo $matname . $objectname . '<br><br>';
        //$this->table->add_row($matname, $objectname);
        $dropdown = form_dropdown('scondition', $conditionlist, $sobject['conditionid']);
        echo $dropdown . '<br>';
        //$this->table->add_row('zustand', $dropdown);
        echo "<br>";
        echo form_submit('saveobject', $smaterialtype . ' speichern');
        echo form_close();
    }
}
echo "<br>";
?>
