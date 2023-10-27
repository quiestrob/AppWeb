<?php
    
    require_once "session_validation.php";
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Acudido.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Acudiente.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Estado.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Inscripcion.php';

    $a = @$_SESSION['usuario.login'];
    $a = @unserialize($a);

    $type = @$_SESSION['usuario.type'];

    $status = @$_SESSION['usuario.status'];
    $status = @unserialize($status);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Somos arcoiris - Plataforma</title>
    <link rel="stylesheet" href="../Assets/css/style_validation_inscription.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-thin-rounded/css/uicons-thin-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Quicksand:wght@400;500;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="container-status">
            <i class="fi fi-br-cross"></i>
            <div class="status">
                <span>Hola <?= $a->nombre ?>,</span>
                <span>
                    <?php 
                        foreach($status as $s) {
                            echo $s->descripcion;
                        } 
                    ?>
                </span>
                <span class="hidden">
                    <?php 
                        foreach($status as $s) {
                            echo $s->estado;
                        } 
                    ?>
                </span>
                <span class="hidden-type">
                    <?= $type ?>
                </span>
            </div>
        </div>
        <div class="container-header">
            <header id="header">
                <div class="container-nav">
                    <nav>
                        <div class="title"><a href="../Pages/index.html">SOMOS ARCOIRIS</a></div>            
                        <div class="button-inscription"><a href="login.php">PLATAFORMA</a></div>
                    </nav>
                </div>
                <div class="container-validation">
                    <div class="validation">
                        <div class="welcome">
                            <h2>Bienvenid@ a nuestra plataforma, <?= $a->nombre ?>.</h2>
                            <h3>Prepárate para un emocionante viaje de descubrimiento. ¡Aquí, el aprendizaje nunca se detiene!</h3>
                            <div class="buttons">
                                <div class="button-validation">
                                    Estado Inscripción
                                </div>
                                <div class="button-platform">
                                    <a href="#">Plataforma</a>
                                </div>
                            </div>
                            <form action="session_destroy.php" method="POST">
                                <input type="submit" name="action" value="Cerrar">
                            </form>
                        </div>
                    </div>
                </div>
            </header>
        </div>
    </div>
    <script src="../Assets/js/script_validation_inscription.js"></script>
</body>
</html>