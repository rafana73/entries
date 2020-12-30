<?php
session_start();
include 'class.php';
$zapisy = new Zapisy($pdo);

if ( !empty($_POST['dodaj1']) && $_POST['dodaj1']!=" " ) {
    $dodajNick = $_POST['dodaj1'];
    $zapisy -> dodaj($dodajNick, 1);   
    header("Location: index.php");
    exit();
    
} elseif ( !empty($_POST['usun1']) ) {
    $usunNick = $_POST['usun1'];
    $zapisy -> usun($usunNick, 1);
    header("Location: index.php");
    exit();
    
} elseif ( !empty($_POST['dodaj2'])  && $_POST['dodaj2']!=" " ) {
    $dodajNick = $_POST['dodaj2'];
    $zapisy -> dodaj($dodajNick, 2);
    header("Location: index.php");
    exit();
    
} elseif ( !empty($_POST['usun2']) ) {
    $usunNick = $_POST['usun2'];
    $zapisy -> usun($usunNick, 2);
    header("Location: index.php");
    exit();
        
} elseif ( !empty($_POST['nick']) && !empty($_POST['wpis']) && $_POST['nick']!=" " ) {
    $nick = $_POST['nick'];
    $wpis = $_POST['wpis'];
    $zapisy -> chat($nick, $wpis);
    header("Location: index.php");
    exit();

} elseif ( !empty($_POST['date']) && !empty($_POST['time']) ) {
    $zapisy -> naglowek($_POST['date'],$_POST['time']);
    header('Location: administracja.php');
    exit();
} elseif (isset ($_POST['wiadomosc']) ) {
    $zapisy -> naglowek2($_POST['wiadomosc']);
    header('Location: administracja.php');
    exit();
} elseif (isset ($_POST['czyszc']) ) {
    $zapisy -> czysc();
    header('Location: administracja.php');
    exit();

} else {
    header("Location: index.php");
    exit();
}