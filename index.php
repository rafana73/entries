<?php 
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
    <title>Zapisy na xxxxx ver 4.0</title>
</head>

<body class="bg-dark text-white">      
    <div class="container mt-3">
        
        <div class="col" id="header">
            <p class="h4 text-center">ZAPISY NA XXXXXXXXXXX:</p>
            <p class="h2 text-center text-primary"><?php echo $zapisy -> date();?></p>
            <p class="h6 text-center">XXXXXXXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXXX.</p>

            <?php if ($zapisy -> naglowek2czyJest()) { ?>
                <p class="alert alert-danger h6 text-center" role="alert"><?php echo $zapisy -> wiadomosc();?></p>
            <?php } ?>

            <hr class="bg-primary">
        </div>
        
        <div class="row justify-content-around" id="nav">
            
            <div class="col-sm-5 ml-3 mr-3">
                <form method="POST" action="zapisy.php">
                    
                    <p class="h5 pt-4">TEAM I :</p>
                    <div class="input-group">
                        <input type="text" name="dodaj1" class="form-control border-primary" placeholder="nick">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Dodaj</button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <textarea readonly class="form-control mt-1 font-weight-bold border-primary" rows="9"><?php $zapisy -> lista("1"); ?></textarea>
                    </div>

                </form>    
                <form method="POST" action="zapisy.php">
    
                    <div class="input-group">
                        <input type="text" name="usun1" class="form-control border-danger" placeholder="nick">
                        <div class="input-group-append">
                            <button class="btn btn-danger" type="submit">Usuń</button>
                        </div>
                    </div>
                    
                </form>    
            </div>

            <div class="col-sm-5 ml-3 mr-3">
                <form method="POST" action="zapisy.php">
                
                    <p class="h5 pt-4">TEAM II :</p>
                    <div class="input-group">
                        <input type="text" name="dodaj2" class="form-control border-primary" placeholder="nick">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Dodaj</button>
                        </div>
                    </div>

                </form>    
                <form method="POST" action="zapisy.php">
                        
                    <div class="form-group">
                        <textarea readonly class="form-control mt-1 font-weight-bold border-primary" rows="9"><?php $zapisy -> lista("2"); ?></textarea>
                    </div>

                    <div class="input-group">
                        <input type="text" name="usun2" class="form-control border-danger" placeholder="nick">
                        <div class="input-group-append">
                            <button class="btn btn-danger" type="submit">Usuń</button>
                        </div>
                    </div>
                
                </form> 
            </div>

        </div>
            
        <p class="text-center h5 p-4">Suma zapisanych osób <?php echo '<b>'.$zapisy -> zlicz().'</b>';?>.</p>
        <hr class="bg-primary">
        
        <div id="articles">
            
            <p class="h5 p-1">Chat (shoutbox)</p>
            <form method="POST" action="zapisy.php">
                <div class="input-group">
                    <input type="text" name="nick" class="col-3 form-control border-primary" placeholder="Nick" required>
                    <input type="text" name="wpis" class="col-9 form-control border-primary" placeholder="wiadomość..." required>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" id="button-addon">Zapisz</button>
                    </div>
                </div>
                <div class="form-group mt-1">
                    <textarea readonly class="form-control font-weight-bold border-primary" rows="15"><?php $zapisy -> listaCzat(); ?></textarea>
                </div>
            </form>
            <p class="h5 p-1 text-center">Twój adres IP: <?php echo $zapisy -> ip(); ?></p>
            
        </div>
        <hr class="bg-primary">
        
        <div class="col mb-5"id="footer">
            <a href="logowanie.php"><button type="button" class="btn btn-primary btn btn-block">Administracja</button></a>
        </div>
        
    </div>
    
    <script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>