<?php
    
    print_r ($newid);
    echo form_open('personneldatacontroller/chooseperson');
    echo form_submit('chooseperson','Person auswählen');
    echo form_dropdown('sperson',$persons,null);
    echo form_close();
    echo '<br>';
    
    if (isset($person)){
    if(isset ($showperson)){
    echo form_open('personneldatacontroller/saveperson');
    echo $this->table->add_row('Anrede',$person->salutation);
    echo $this->table->add_row('Name',  form_input('newname', $person->name));
    echo $this->table->add_row('Vorname',$person->firstname);
    echo $this->table->add_row('Geburtstag',$person->dateofbirth);
    echo $this->table->add_row('Geburtstag',$person->dateofbirth);
    echo $this->table->generate();
    }
    echo form_hidden('personid',$person->personid);
    
    echo form_submit('saveperson', 'Speichern');
    echo form_close();
    }
//class initialPersonnelDataView{
//        
//        private $template;
//        
//        
//        
//        public function __construct($tpl){
//            $this->show();
//            $this->load->helper("form");
//        }
//        
//        public function getNewID($NewID){
//        
//        }
//        
//        public function show($NewID){
//            ob_start();
//            echo '<table with=100% borderstyle = "thin" ><tr><td>';
//            echo '<p> next id: </p><br><label>';
//            echo form_dropdown('$salutation');
//            $this->getNewID($NewID);
//        }
//        
//    }
//?>

