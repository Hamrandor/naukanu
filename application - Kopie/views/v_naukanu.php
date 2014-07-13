<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<php>
    <html>
        <meta http-equiv="X-UA-Compatible" content="IE=100" >

        </meta>
        <head>

            <title>Advanced Sailing School</title>

            <style type="text/css">

                body{
                    margin: 0;
                    padding: 0;
                    border: 0;
                    overflow: hidden;
                    height: 100%; 
                    max-height: 100%; 
                }

                #framecontentTopLogo{
                    position: fixed;
                    float: left;
                    display: block;
                    margin: 0;
                    padding: 0;
                    top: 0;
                    left: 0;
                    height: 10%;
                    width: 15%;
                    overflow: hidden;
                    background-color: blue;
                }

                #framecontentTopHeadline{
                    position: fixed;
                    display: block;
                    top: 0;
                    left: 15%;
                    height: 10%;
                    width: 85%;
                    overflow: hidden;
                    margin: 0;
                    padding: 0;
                    background-color: lightcoral;
                }

                #framcontentLeft{
                    position: fixed;
                    float: left;
                    display: block;
                    top: 10%;
                    left: 0;
                    height: 85%;
                    width: 15%;
                    background-color: lightcyan;
                }

                #maincontent{
                    position: fixed;
                    display: block;
                    top: 10%;
                    left: 15%;
                    height: 85%;
                    width: 90%;
                    max-width: 90%;
                    background-color: #D0D0D0;
                    overflow-y: scroll;
                }

                #framecontentFooter{
                    position: fixed;
                    display: block;
                    left: 0;
                    top: 95%;
                    left: 0;
                    height: 5%;
                    width: 100%;
                    background-color: #888;
                }

                #menu{
                    list-style-type: square;
                    cursor: default;
                    display: block;

                }

                #submenuCourse{
                    text-align: left;
                }

                a:link{color: #000000}
                a:visited{color: #e13300;}
                a:hover{color: #000000; font-weight: bold}
                a:active{color: #EEE; font-weight: bolder;}

                table{border-style: dashed;}

            </style>
        </head>
        <body>

            <div id="framecontentTopLogo" name="logo">
                <img src="\application/views/segelboot.gif">
            </div>
            <div id="framecontentTopHeadline" name="headline">
                <h3>Advanced Sailing School</h3>
            </div>
            <div id="framcontentLeft" name="navigation">
                <ul id="menu">
                    <li> <a href="?page=Kursverwaltung">Kursverwaltung</a> </li>
                    <ul id="submenuCourse">
                        <li>Kurs anlegen</li>
                    </ul>
                    <li> <a>Materialverwaltung</a> </li>
                    <ul id="submenuMaterial">
                        <li><a href="?page=Bootsverwaltung">Boote verwalten</a></li>
                        <li><a href="?page=Mastverwaltung">Masten verwalten</a></li>
                        <li><a href="?page=Segelverwaltung">Segel verwalten</a></li>
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
                <?php {
                    if (isset($_GET["page"])) {
                        switch ($_GET["page"]) {
                            case "Mitarbeiterverwaltung": include("\application/views/v_personnelAdministration_main.php");
                                break;
                            case "Bootsverwaltung": redirect("boatConfig");
                                break;
                            case "Mastverwaltung": redirect("mastConfig");
                                break;
                            case "Segelverwaltung": redirect("canvasConfig");
                                break;
                            case "initialPersonnelData": include("\application/views/v_formular_initial_personnelData.php");
                                break;
                        }
                    }
                }
                ?>
            </div>
            <div id="framecontentFooter" name="footer">
                <h3>platzhalter footer</h3>
            </div>
        </body>

    </html>
</php>