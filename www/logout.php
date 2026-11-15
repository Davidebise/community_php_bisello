<?php
    session_start();
    session_unset();  //libero variabili
    session_destroy(); //distruggo la sessione
    header("Location: login.php")
?>