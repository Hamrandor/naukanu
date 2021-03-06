<body>

    <div id="framecontentTopLogo" name="logo" align="center">
        <img src="/segelboot.gif">
    </div>
    <div id="framecontentTopHeadline" name="headline" align ="center">
        <h3>Naukanu Advanced Sailing School</h3>
    </div>
    <div id="framcontentLeft" name="navigation">
        <ul id="menu">
            <li> <a>Kursverwaltung</a> </li>
            <ul id="submenuCourse">
                <li><a href="?page=Kurstypverwaltung">Kurstyp verwalten</a></li>
                <li><a href="?page=Kursverwaltung">Kurs verwalten</a></li>
                <li><a href="?page=Kalender">Kalender</a></li>
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
                <li><a href="?page=Anwesenheit">Verf&uuml;gungszeitr&auml;ume planen</a></li>
                <li>Bewertungsnotizen erstellen</li>
                <li>Abrechnung f&uuml;r Mitarbeiter erstellen</li>
            </ul>
        </ul>
    </div>
    <div id="maincontent" name="maincontent">
        <?php {
            $pagevar = $this->input->get('page');
//            print_r($pagevar);
            if (isset($pagevar) && $pagevar != null) {
                switch ($pagevar) {
                    case "Mitarbeiterverwaltung": redirect("naukanu");
                        break;
                    case "Bootsverwaltung": redirect("boatconfig");
                        break;
                    case "Mastverwaltung": redirect("mastconfig");
                        break;
                    case "Segelverwaltung": redirect("canvasconfig");
                        break;
                    case "Materialbewertung": redirect("ratematerial");
                        break;
                    case "Aufgaben": redirect("taskadministrator");
                        break;
                    case "Kurstypverwaltung": redirect("coursetypeconfig");
                        break;
                    case "Kursverwaltung": redirect("courseconfig");
                        break;
                    case "Buchung": redirect("bookingconfig");
                        break;
                    case "Kalender": redirect("calendarconfig");
                        break;
                    case "Kundenverwaltung": redirect("naukanu");
                        break;
                    case "Anwesenheit": redirect("leaderavailability");
                        break;
                }
            }
        }
        ?>
