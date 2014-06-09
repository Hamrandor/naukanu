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
            
}
