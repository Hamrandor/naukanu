<?php
        $this->load->helper(array("form"));
        
        if (!isset($sMaterialType) || $sMaterialType == null) {
            echo form_open("rateMaterial/selectMaterialType");
            echo "Welches Material soll bewertet werden?<br><br>";
            foreach ($materialType as $type){
                echo form_radio('sMaterialType', $type).$type.'<br>';
            }
            echo "<br>";
            echo form_submit('chooseMaterialType', 'Materialart auswählen');        
            echo form_close();
        } else {
            if (!isset($sObject) || $sObject == null) {
                echo form_open("rateMaterial/chooseObject");
                if ($sMaterialType == 'Mast') {
                    echo "Welcher $sMaterialType soll bewertet werden?<br><br>";
                } else {
                    echo "Welches $sMaterialType soll bewertet werden?<br><br>";
                }
                echo form_dropdown('sObject', $sList, null);
                echo form_hidden('sMaterialType',$sMaterialType );

                echo "<br>";
                echo form_submit('chooseObject', $sMaterialType.' auswählen');        
                echo form_close();
            } else {
                echo form_open("rateMaterial/rateObject");
                echo form_hidden('sMaterialType',$sMaterialType );
                echo form_hidden('sObjectID',$sObjectID);
                if ($sMaterialType == 'Mast') {
                   echo "Bitte bewerten Sie folgenden $sMaterialType.<br><br>";
                } else {
                   echo "Bitte bewerten Sie folgendes $sMaterialType.<br><br>";
                }
                $this->load->library('table');
                $objectName = $sObject['name'];
                $matName = $sMaterialType.'-Name : ';
                echo $matName.$objectName.'<br><br>';
                //$this->table->add_row($matName, $objectName);
                $dropdown = form_dropdown('sCondition', $conditionList, $sObject['conditionID']);
                echo $dropdown.'<br>';
                //$this->table->add_row('Zustand', $dropdown);
                echo "<br>";
                echo form_submit('saveObject', $sMaterialType.' speichern');        
                echo form_close();
            }
        }
        echo "<br>";
        
?>
