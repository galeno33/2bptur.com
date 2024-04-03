<?php

    session_start();
    $batalhão = "BPTUR";
    $indice = "2";
    $autor = "Fabio Galeno";
    $_SESSION['batalhao'] = $batalhão;
    $_SESSION['indice'] = $indice;
    $_SESSION['autor'] = $autor;
    $_SESSION['perfil'] = 'updatePerfil.php';

    //echo $indice;
    
?>