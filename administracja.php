<?php
session_start();

if (isset($_SESSION['zalogowany']) ) {

include 'class.php';
$zapisy = new Zapisy($pdo);
?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="favicon.png" type="image/png"/>
    <title>Administracja</title>
</head>

<body class="bg-dark text-white">
    <div class="container mt-3">

        <form action="zapisy.php" method="POST">
        <hr class="bg-primary">
            <div class="form-group">
                <label for="czas">Wybierz datę oraz godzinę następnego spotkania:</label>
                <div class="input-group">
                    <input name="date" type="date" class="form-control" value="<?= substr($zapisy -> date(),0, -6) ?>" id="czas" required>
                    <input name="time" type="time" class="form-control" value="<?= substr($zapisy -> date(),11) ?>" id="czas" required>
                </div>  
            </div>
            <button type="submit" class="btn btn-primary btn btn-block mt-2">Ustaw datę i godzinę</button>
        </form>
        
        <form action="zapisy.php" method="POST">    
        <hr class="bg-primary mt-5">
            <div class="form-group">
                <label for="wiadomosc">Wiadmość dla uczestników:</label>
                <textarea maxlength="220" name="wiadomosc" class="form-control" id="wiadomosc" rows="2"><?= $zapisy -> wiadomosc() ?></textarea>
                <small id="wiadomosc" class="form-text text-muted">Max 220 znaków, pole niewymagane (aby wyczyścić starą wiadomość, wystarczy ustawić pustą.)</small>
            </div>
            <button type="submit" class="btn btn-primary btn btn-block mt-2">Ustaw wiadomość</button>
        </form>        
        
        <form action="zapisy.php" method="POST">    
        <hr class="bg-primary mt-5">
            <label>Wyczyść zawartość wpisów oraz czatu:</label>
            <button onclick="return confirm('Czyścimy ?');" name="czyszc" type="submit" class="btn btn-danger btn btn-block mt-2">Wyczyść stronę.</button>
            <small class="form-text text-muted">Po wyczyszczeniu, nie będzie możliwości przywrócenia wpisów.</small>
        </form>
        <hr class="bg-primary mt-5 mb-4">
        
        <div class="row">
            <div class="col order-last">
                <a href="loginout.php"><button type="button" class="btn btn-primary mt-3 mb-5">Wyloguj</button></a>
            </div>
            <div class="col">
            </div>
            <div class="col order-first">
            </div>
        </div>
        
    </div>

    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

<?php
} else {
    header('Location: logowanie.php');
}
?>