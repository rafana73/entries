<?php
    session_start();
    unset($_SESSION['zalogowany']);
    unset($_SESSION['zlyLogin']);
    header("Location: index.php");
    exit();