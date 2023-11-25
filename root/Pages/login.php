<?php

    session_start();

    $msj = @$_REQUEST['msj'];
    $a = @$_SESSION['usuario.login'];
    $a = @unserialize($a);

    if ($a) {
        header("Location: validation_inscription.php");
        exit;
    } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Somos arcoiris - Login</title>
    <link rel="stylesheet" href="../Assets/css/style_login.css">
    <link rel="icon" href="../assets/media/arcoiris.png">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-thin-rounded/css/uicons-thin-rounded.css'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="container-header">
            <header id="header">
                <div class="container-nav">
                    <nav>
                        <div class="title"><a href="../Pages/index.html">SOMOS ARCOIRIS</a></div>            
                        <div class="button-inscription"><a href="login.php">PLATAFORMA</a></div>
                    </nav>
                </div>
                <div class="container-inscription">
                    <div class="message">
                        <span><?= ($msj == null || isset($msj)) ? $msj : "" ?></span>
                    </div>
                    <div class="form-inscription">
                        <div class="welcome">
                            <h2>Empieza tu aventura con nosotros.</h2>
                            <h3>Únete a nosotros y juntos hagamos una diferencia en las vidas que tocamos.</h3>
                        </div>
                        <div class="form">
                            <form action="../../controllers/LoginController.php" method="POST">
                                <div class="input-data">
                                    <span>Identificacion</span>
                                    <input type="number" id="identification" name="identification" required>
                                </div>
                                <div class="input-data">
                                    <span>Contraseña</span>
                                    <input type="password" id="pass" name="pass" required>
                                </div>     
                                <div class="input-data">
                                    <input type="submit" id="action" name="action" value="Ingresar">
                                </div>
                                <div class="input-data">
                                    <span><a href="">¿Olvidaste tu contraseña?</a></span>
                                </div>  
                                <div class="separator"></div>
                                <div class="input-data">
                                    <span><a href="inscription.php">Inscribete</a></span>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </header>
        </div>
    </div>
    <script src="../Assets/js/script_login.js"></script>
</body>
</html>