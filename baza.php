<?php
include_once 'db_dane.php';

class Baza {
    private $host;
    private $dbname;
    private $user;
    private $pass;
            
    public function __construct($host,$dbname,$user,$pass) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->pass = $pass;
    }
    
    public function polacz() {
        try {
            return $db = new PDO("mysql: host=$this->host; dbname=$this->dbname; charset=utf8", $this->user, $this->pass, 
                [PDO::ATTR_EMULATE_PREPARES => FALSE, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } catch (PDOException $exc) {
        //    echo $exc->getTraceAsString();
            exit("błąd połącznia z bazą - skontakuj się z administratorem!");
        }
    }
}