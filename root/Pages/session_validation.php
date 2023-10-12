<?php

    session_start();
    
    $a = @$_SESSION['usuario.login'];
    $a = @unserialize($a);

    if (!$a) {
        $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']."/proaulav2/root/pages/login.php";
        header("Location: $urlBase");
        exit;
    }

?>