<?php

/*
 * to change this license header, choose license headers in project properties.
 * to change this template file, choose tools | templates
 * and open the template in the editor.
 */

/**
 * description of tools
 *
 * @author jens
 */
class tools extends CI_Model {

    //put your code here

    public function extractdropdownarray($array, $idfield, $displayfield) {
        $result = array();
        foreach ($array as $obj) {
            $result[$obj[$idfield]] = $obj[$displayfield];
        }
        return $result;
    }

    function alertmessage($message) {
        echo "<script type='text/javascript' language='javascript'> \n";
        echo "<!-- \n";
        echo " alert('" . $message . "'); \n";
        echo "//--> \n";
        echo "</script> \n";
    }

    public function addnullvalue($anarray) {
        $result = array(null => "keine Auswahl");
        $keyarray = array_keys($anarray);
        foreach ($keyarray as $k) {
            $result[$k] = $anarray[$k];
        }
        return $result;
    }

}
