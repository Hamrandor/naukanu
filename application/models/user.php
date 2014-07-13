<?php

/**
 * Description of user
 *
 * @author Ilya Beliaev
 */
class User extends CI_Model {

    public function __construct() {
        parent::__construct();
        //Datenbankverbindung herstellen
        $this->load->database();
    }

    /**
     * Überprüft die Benutzerdaten eines Benutzers der sich einloggen möchte
     * @param String $username Benutzername des Kunden
     * @param String $password Passwort des Kunden
     * @return false/String Fail/Username
     */
    public function checkUserCredentials($username, $password) {

        //Salt für den Benutzer raussuchen aus der Datenbank
        //$salt = $this->getSalt($username);
        //if(!empty($salt)){
        //Anhand des herausgesuchten Salts und des Plaintext Passworts einen Hash bilden
        //$hash = $this->gethash($password, $salt);
        //Datenbankabfrage mittels Active Record Pattern
        $this->db->select("login");
        $this->db->from("user");
        $this->db->where("login", $username);
        $this->db->where("password", $password);
        echo $this->db->sql;

        $query = $this->db->get();

        //Prüfen ob MySQL-Ausgabe mehr als 0 Zeilen ausliefert.
        if ($query->num_rows() > 0) {
            $row = $query->row(0);
            $return = $row->login;
        } else {
            $return = false;
        }

        //}else{
        //   $return = false;
        //}
        // Username oder False zurück geben, an die Aufrufer-Klasse in dem Falle den Controller
        return $return;
    }

    /**
     * Holt den Salt eines Benutzers
     * @param String $username Benutzername
     * @return String Salt
     */
    private function getSalt($username) {

        //Salt mittels einer SQL-Abfrage aus der Datenbank holen
        $this->db->select('salt');
        $this->db->from("user");
        $this->db->where("username", $username);

        $query = $this->db->get();

        $row = $query->row(0);

        if ($query->num_rows() > 0) {
            $salt = $row->salt;
        } else {
            $salt = "";
        }

        return $salt;
    }

    /**
     * Erzeugt aus Password und Salt einen Sha1-Hash
     * @param String $password Plaintext Passwort
     * @param String $salt 40stelliger Salt
     * @return String SHA1-Hash
     */
    private function gethash($password, $salt) {
        //Erzeugen eines Hashes anhand des Passworts und des Salts
        return sha1($password . md5($salt));
    }

}
