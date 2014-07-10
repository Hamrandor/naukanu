        <body>
            
            <div id="framecontentTopLogo" name="logo" align="right">
                <img src="/segelboot.gif">
            </div>
            <div id="framecontentTopHeadline" name="headline" align ="center">
                <h3>Naukanu Advanced Sailing School</h3>
            </div>
            <div id="framcontentLeft" name="navigation">
                <ul id="menu">
                    <li> <a>Kursverwaltung</a> </li>
                    <ul id="submenuCourse">
                        <li>Kurs anlegen</li>
                        <li><a href="?page=Kurstypverwaltung">Kurstyp verwalten</a></li>
                        <li><a href="?page=Kursverwaltung">Kurs verwalten</a></li>
                        <li><a href="?page=Buchung">Kurse buchen</a></li>
                    </ul>
                    <li> <a>Materialverwaltung</a> </li>
                    <ul id="submenuMaterial">
                        <li><a href="?page=Bootsverwaltung">Boote verwalten</a></li>
                        <li><a href="?page=Mastverwaltung">Masten verwalten</a></li>
                        <li><a href="?page=Segelverwaltung">Segel verwalten</a></li>
                        <li><a href="?page=Materialbewertung">Material bewerten</a></li>
                        <li><a href="?page=Aufgaben">Aufgaben</a></li>
                    </ul>
                    
                    <li> <a href="?page=Kundenverwaltung">Kundenverwaltung</a> </li>
                    <ul id="submenuCustomer">
                        <li>Kundendaten bearbeiten</li>
                        <li>Abrechnung f&uuml;r Kunden erstellen</li>
                    </ul>
                    <li> <a href="?page=Mitarbeiterverwaltung">Mitarbeiterverwaltung</a> </li>
                    <ul id="submenuPersonnel">
                        <li>Mitarbeiterdaten bearbeiten</li>
                        <li>Verf&uuml;gungszeitr&auml;ume planen</li>
                        <li>Bewertungsnotizen erstellen</li>
                        <li>Abrechnung f&uuml;r Mitarbeiter erstellen</li>
                    </ul>
                </ul>
            </div>
            <div id="maincontent" name="maincontent">
                <?php
                {   $pagevar = $this->input->get('page');
                    print_r($pagevar);
                    if (isset($pagevar) && $pagevar != null) {
                        switch($pagevar) {
                             case "Mitarbeiterverwaltung": include("\application/views/v_personnelAdministration_main.php"); break;
                             case "Bootsverwaltung": redirect("boatConfig"); break;
                             case "Mastverwaltung": redirect("mastConfig"); break;
                             case "Segelverwaltung": redirect("canvasConfig"); break;
                             case "Materialbewertung": redirect("rateMaterial"); break;
                             case "Aufgaben": redirect("taskAdministrator"); break;
                             case "Kurstypverwaltung": redirect("courseTypeConfig"); break;
                             case "Kursverwaltung": redirect("canvasConfig"); break;
                             case "Buchung": redirect("calendarConfig"); break;
                             case "initialPersonnelData": include("\application/views/v_formular_initial_personnelData.php");break;
                        }
                     }
                }
                ?>
