<?php
require_once 'baza.php';
$z = new Baza ($host,$dbname,$user,$pass);
$pdo = $z -> polacz();

class Zapisy {

    protected $pdo;
    public function __construct ($pdo) {
        $this->pdo = $pdo;
    }

    public function dodaj($dodajNick, $team) {
        $dodaj = $this->pdo -> prepare (" INSERT INTO `zapisy` VALUES (NULL, :nick, '$team', :dateTime, :ip) ");
        $dodaj -> bindValue (":nick", trim($dodajNick), PDO::PARAM_STR);
        $dodaj -> bindValue (":dateTime", date('Y-m-d H:i:s'));
        $dodaj -> bindValue (":ip", $_SERVER['SERVER_ADDR']);//HTTP_X_REAL_IP//SERVER_ADDR !!!!!
        $dodaj -> execute();
        return true;
    }

    public function usun($usunNick, $team) {
        $usun = $this->pdo -> prepare (" DELETE FROM `zapisy` WHERE `nick`=:usunNick AND `team`='$team' LIMIT 1 ");
        $usun -> bindValue (":usunNick", trim($usunNick), PDO::PARAM_STR);
        $usun -> execute();
        return true;
    }
    
    public function lista($team) {
        $wypisz = $this->pdo -> query (" SELECT `nick`, `team` FROM `zapisy` WHERE `team`='$team' ");
        foreach ($wypisz as $value) {
            echo $value['nick']."\n";
        }
    }
    
    public function chat($nick, $wpis) {
        $czat = $this->pdo -> prepare (" INSERT INTO `chat` VALUES (NULL, :nick, :text, :dateTime, :ip ) ");
        $czat -> bindValue (":nick", trim($nick), PDO::PARAM_STR);
        $czat -> bindValue (":text", $wpis, PDO::PARAM_STR);
        $czat -> bindValue (":dateTime", date('Y-m-d H:i:s'));
        $czat -> bindValue (":ip", $_SERVER['SERVER_ADDR']);//HTTP_X_REAL_IP//SERVER_ADDR !!!!!
        $czat -> execute();
        return true;
    }
    
    public function listaCzat() {
        $wypisz = $this->pdo -> query (" SELECT `nick`, `text`, `dateTime`, `ip` FROM `chat` ");
        
        foreach ($wypisz as $value) {
            echo date_format(date_create($value['dateTime']),"d-m H:i")." - ".$value['nick'].":  ".$value['text']."\n"; #date_format zmienia na data-miesiąc, pomaga mu w tym date_create
        }
    }
    
    public function zlicz() {
        $zlicz = $this->pdo -> query (" SELECT `nick` FROM `zapisy` ");
        return $zlicz -> rowCount();
    }
    
    public function ip() {
        return $_SERVER['SERVER_ADDR'];//HTTP_X_REAL_IP//SERVER_ADDR !!!!!
    }
    
    public function naglowek($date, $time) {
        if ($this->naglowekCzyJest()) {
            $dodajDate = $this->pdo -> prepare (" UPDATE `naglowek` SET `date`= :date, `time`= :time  where `naglowek_id` = '1' ");
            $dodajDate -> bindValue (":date", $date);
            $dodajDate -> bindValue (":time", $time);
            $dodajDate -> execute();
            return true;
        } else {
            $dodajDate = $this->pdo -> prepare (" INSERT INTO `naglowek` (`date`, `time`, `wiadomosc`) VALUES (:date, :time, null) ");
            $dodajDate -> bindValue (":date", $date);
            $dodajDate -> bindValue (":time", $time);
            $dodajDate -> execute();
            return true;
        }
    }
    
    public function naglowek2($wiadomosc) {
        if ($this->naglowekCzyJest()) {
            $dodajWiadomosc = $this->pdo -> prepare (" UPDATE `naglowek` SET `wiadomosc`= :wiadomosc where `naglowek_id` = '1' ");
            $dodajWiadomosc -> bindValue (":wiadomosc", $wiadomosc);
            $dodajWiadomosc -> execute();
            return true;
        } else {
            $dodajWiadomosc = $this->pdo -> prepare (" INSERT INTO `naglowek` (`date`, `time`, `wiadomosc`) VALUES (null, '00:00', :wiadomosc) ");
            $dodajWiadomosc -> bindValue (":wiadomosc", $wiadomosc);
            $dodajWiadomosc -> execute();
            return true;
        }
    }
    
    public function naglowekCzyJest() {
        $sprNaglowek = $this->pdo -> query (" SELECT `naglowek_id` FROM `naglowek` ");
        foreach ($sprNaglowek as $wynik) {
            if ($wynik['naglowek_id'] == "1")
                return true;
            return false;
        }  
    }
    
    public function naglowek2czyJest() {
        $sprNaglowek2 = $this->pdo -> query (" SELECT `wiadomosc` FROM `naglowek` ");
        foreach ($sprNaglowek2 as $wynik) {
            return $wynik['wiadomosc']; 
        }  
    }

    public function date() {
        $wypiszDate = $this->pdo -> query (" SELECT `date`, `time`  FROM `naglowek` ");
        foreach ($wypiszDate as $value) {
            $timeBezSek = date_create($value['time']);
            return $value['date']." ".date_format($timeBezSek,"H:i");//z return, pokaża zawsze tylko pierwszy wiersz z tablicy
        }
    }        

    public function wiadomosc() {
        $wypiszWiadomosc = $this->pdo -> query (" SELECT `wiadomosc`  FROM `naglowek` ");
        foreach ($wypiszWiadomosc as $value) {
            return $value['wiadomosc'];//z return, pokaża zawsze tylko pierwszy wiersz z tablicy
        }
    }

    public function czysc() {
        $this->pdo -> query (" TRUNCATE TABLE `zapisy` ");
        $this->pdo -> query (" TRUNCATE TABLE `chat` ");
        $this->pdo -> query (" TRUNCATE TABLE `naglowek` ");
        return true;
    }

    public function logowanie($login, $haslo) {
        $stmt = $this->pdo ->prepare("SELECT * FROM `users` WHERE user_name=:login");
        $stmt ->bindValue(':login', $login, PDO::PARAM_STR);  
        $stmt ->execute();
        $wynik = $stmt ->fetchAll(PDO::FETCH_ASSOC);
        if ($wynik == TRUE) {
            if (password_verify($haslo,$wynik[0]['user_pass'])) {                
                return $_SESSION['zalogowany'] = $wynik[0]['user_name'];#zwraca $_SESSION['zalogowany'][0] - login
            } else {
            return $_SESSION['zlyLogin'] = true;
            }
        } else {
            return $_SESSION['zlyLogin'] = true;
        }
    }
}