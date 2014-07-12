<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tools
 *
 * @author Jens
 */
class tools extends CI_Model{
    //put your code here
    
    public function extractDropdownArray($array, $idField, $displayField){
        $result = array();
        foreach ($array as $obj) {
            $result[$obj[$idField]] = $obj[$displayField];
        }
        echo "extractDropdownArray = ".print_r($result);
        return $result;
    }
    
    function alertMessage ($message){
        echo "<script type='text/javascript' language='javascript'> \n"; 
        echo "<!-- \n"; 
        echo " alert('".$message."'); \n"; 
        echo "//--> \n"; 
        echo "</script> \n";         
        
    }    
    
    public function addNullValue($anArray){
        $result = array(null => "keine Auswahl");
        $keyArray = array_keys($anArray);
        foreach ($keyArray as $k) {
            $result[$k] = $anArray[$k];
        }
        return $result;
    }

            
}
