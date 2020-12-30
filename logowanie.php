<?php
session_start();

if (!isset($_SESSION['zalogowany'])) {

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

        <div class="container mt-5 p-4 border border-primary rounded">
            <div class="shadow p-3 mb-3 bg-dark rounded h3 text-center">LOGOWANIE :</div>

            <?php if(isset($_SESSION['zlyLogin']) ) { ?>
                <div class="alert alert-danger" role="alert">
                    Zły login lub hasło!
                </div>
            <?php
                unset($_SESSION['zlyLogin']); 
            } ?>
            
            <form method="POST" action="logowanie.php">
                <div class="form-group">
                    <label for="login">Login</label>
                    <input name="login" type="text" class="form-control" id="login" required>
                </div>
                <div class="form-group">
                    <label for="haslo">Hasło</label>
                    <input name="pass" type="password" class="form-control" id="haslo" required>
                </div>

                <button type="submit" class="btn btn-primary btn btn-block mt-2">Zaloguj</button>
            </form>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col order-last">
                    <a href="index.php"><button type="button" class="btn btn-primary mt-5">Wróć</button></a>
                </div>
                <div class="col">
                </div>
                <div class="col order-first">
                </div>
            </div>
            </div>
        </div>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
    </html>

<?php
    if ( !empty($_POST['login']) && !empty($_POST['pass']) ) {
        $z = $zapisy->logowanie($_POST['login'], $_POST['pass']);
        header("Location: administracja.php");
        exit();
    }

} else {
    header('Location: administracja.php');
    exit();
}
?>
