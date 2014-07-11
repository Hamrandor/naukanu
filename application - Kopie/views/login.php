<?php
    //Hier wird ein H3 Tag geworfen mit dem Text "Beispiel-Login":
    //<h3>Beispiel-Login</h3>
    echo heading('Login', 3);

    //Ausgabe des Formulars für den Login

    //Attribute für das Formular <form></form>
    //Die URL wird sofern das Attribut "action" nicht angegeben wird als aktuelle Adressleiste geworfen.
    //http://localhost/<pfad>/<controllername>.html
    $attributes = array('class' => 'login', 'id' => 'login');
    //form_open erzeugt sofern die csrf protection aktiviert ist einen token als input type hidden
    //mit einem zufälligen md5 hash dieser wird autom. vom Controller beim auswerten des Formulares überprüft
    echo form_open('login', $attributes)."\n\t\t";
    //Erzeugen eines labels <label for="username">Domain:</label>
    echo form_label('Benutzername:', 'username')."\n\t\t";
    //<br> ausgeben oder eben das was der Doctype verlangt.
    echo br()."\n\t\t";
    //Attribute für den input
    //Set_value setzt den Wert auf den POST
    $username = array(
                    'name'        => 'username',
                    'id'          => 'username',
                    'placeholder' => 'Benutzername',
                    'value'       => set_value('username')
                 );
    echo form_input($username)."\n\t\t";
    //br(2) heißt nichts anderes als gebe 2 x br aus. sprich <br><br>
    echo br(2)."\n\t\t";
    echo form_label('Passwort:', 'password')."\n\t\t";
    echo br()."\n\t\t";

    $password = array(
                    'name'        => 'password',
                    'id'          => 'password',
                    'placeholder' => 'Passwort...',
                    'type'        => 'password',
                    'value'       => set_value('password')
                 );
    echo form_input($password)."\n\t\t";
    echo br(2)."\n\t\t";
    //Erstellen des Submit buttons mit dem namen "submit" und dem Text "Login"
    echo form_submit('submit', 'Login')."\n\t\t";
    //schließen der form </form>
    echo form_close()."\n\t\t";
    //Formular Ende

    echo br()."\n";

    //Fehlermeldungen ausgeben
    //validation_errors() gibt true zurück sofern ein Fehler aufgetreten ist beim auswerten des formulares
    //$error ist hier unsere fehlermeldung die z.B. zurückgeworfen wird sofern der login nicht erfolgreich gewesen ist.
    if(validation_errors() || isset($error)){
        ?>
        <div class="msg error">
            <?php
                //Gibt hier aus welche Felder nicht geserzt wurden als menschenlesbarer Text
                echo validation_errors();

                if(isset($error)){
                    echo "<p>".$error."</p>";
                }
            ?>
        </div>
        <?php
    }
?>
