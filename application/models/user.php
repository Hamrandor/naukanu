<?php

/**
 * description of user
 *
 * @author ilya beliaev
 */
class user extends CI_Model {

    public function __construct() {
        parent::__construct();
        //datenbankverbindung herstellen
        $this->load->database();
    }

    /**
     * überprüft die benutzerdaten eines benutzers der sich einloggen möchte
     * @param string $username benutzername des kunden
     * @param string $password passwort des kunden
     * @return false/string fail/username
     */
    public function checkusercredentials($username, $password) {

        //salt für den benutzer raussuchen aus der datenbank
        //$salt = $this->getsalt($username);
        //if(!empty($salt)){
        //anhand des herausgesuchten salts und des plaintext passworts einen hash bilden
        //$hash = $this->gethash($password, $salt);
        //datenbankabfrage mittels active record pattern
        $this->db->select("login");
        $this->db->from("user");
        $this->db->where("login", $username);
        $this->db->where("password", $password);
        echo $this->db->sql;

        $query = $this->db->get();

        //prüfen ob mysql-ausgabe mehr als 0 zeilen ausliefert.
        if ($query->num_rows() > 0) {
            $row = $query->row(0);
            $return = $row->login;
        } else {
            $return = false;
        }

        //}else{
        //   $return = false;
        //}
        // username oder false zurück geben, an die aufrufer-klasse in dem falle den controller
        return $return;
    }

    /**
     * holt den salt eines benutzers
     * @param string $username benutzername
     * @return string salt
     */
    private function getsalt($username) {

        //salt mittels einer sql-abfrage aus der datenbank holen
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
     * erzeugt aus password und salt einen sha1-hash
     * @param string $password plaintext passwort
     * @param string $salt 40stelliger salt
     * @return string sha1-hash
     */
    private function gethash($password, $salt) {
        //erzeugen eines hashes anhand des passworts und des salts
        return sha1($password . md5($salt));
    }

}
