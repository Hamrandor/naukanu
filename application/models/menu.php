<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menu
 *
 * @author rnitschke
 */
class menu {
    
    public function page_loader();
    
                    {
                     if ($_GET["page"])
                     {switch($_GET["page"])
                     {case "Mitarbeiterverwaltung": include("\application/views/v_personnelAdministration_main.php"); break;
                     case "Materialverwaltung": include("\application/views/v_workbook.php"); break;
                     case "initialPersonnelData": include("\application/views/v_formular_initial_personnelData.php");break;
                     }
                     }
                    }
    
    {$
        
    return "page";}
    //put your code here
}
