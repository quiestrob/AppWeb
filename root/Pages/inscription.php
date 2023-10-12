<?php

    $msj = @$_REQUEST['msj'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Somos arcoiris - Inscripción</title>
    <link rel="stylesheet" href="../Assets/css/style_inscription.css">
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
                            <form action="../../controllers/InscriptionController.php" method="POST">
                                <div class="timeline">
                                    <div class="point">
                                        <div class="circle"></div>
                                        <div class="line"></div>
                                        <span>Acudido</span>
                                    </div>
                                    <div class="point">
                                        <div class="circle"></div>
                                        <span>Acudiente</span>
                                    </div>
                                    <div class="point">
                                        <div class="circle"></div>
                                        <div class="line"></div>
                                        <span>Información adicional</span>
                                    </div>
                                </div>
                                <div class="data">
                                    <div class="data__attended">
                                        <div class="input-data">
                                            <span>Identificación</span>
                                            <input type="number" id="idAttended" name="idAttended" required>
                                        </div>
                                        <div class="input-data">
                                            <span>Nombre</span>
                                            <input type="text" id="nameAttended" name="nameAttended" required>
                                        </div>
                                        <div class="input-data">
                                            <span>Género</span>
                                            <div class="container-radio">
                                                <div class="container-radio__radio">
                                                    <input type="radio" name="radio-gender" value="male" checked required>
                                                    <span>Masculino</span>
                                                </div>
                                                <div class="container-radio__radio">
                                                    <input type="radio" name="radio-gender" value="female" required>
                                                    <span>Femenino</span>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="input-data">
                                            <span>Fecha de nacimiento</span>
                                            <input type="date" id="date" name="date" required>
                                        </div>
                                        <div class="input-data">
                                            <span>Discapacidad</span>
                                            <input type="text" id="disability" name="disability" required>
                                        </div>
                                        <div class="input-submit" id="submit__1" onclick="next(inputAttended, dataAttended, point, line, text)">
                                            <i class="fi fi-rr-arrow-small-right"></i>
                                        </div>
                                    </div>
                                    <div class="data__attendant">
                                        <div class="input-data">
                                            <span>Identificación</span>
                                            <input type="number" id="idAttendant" name="idAttendant" required>
                                        </div>
                                        <div class="input-data">
                                            <span>Nombre</span>
                                            <input type="text" id="nameAttendant" name="nameAttendant" required>
                                        </div>
                                        <div class="input-data">
                                            <span>Telefono</span>
                                            <input type="number" id="phone" name="phone" required>
                                        </div>
                                        <div class="input-data">
                                            <span>Correo</span>
                                            <input type="email" id="mail" name="mail" required>
                                        </div>
                                        <div class="input-data">
                                            <span>Direccion</span>
                                            <input type="text" id="address" name="address" required>
                                        </div>
                                        <div class="input-submit" id="submit__2" onclick="next(inputAttendant, dataAttendant, point__2, line__2, text__2), getName()">
                                            <i class="fi fi-rr-arrow-small-right"></i>
                                        </div>
                                    </div>
                                    <div class="data__additional">
                                        <div class="input-data">
                                            <span>Contraseña acudido</span>
                                            <input type="password" id="passAttended" name="passAttended" required>
                                        </div>
                                        <div class="input-data">
                                            <span>Contraseña acudiente</span>
                                            <input type="password" id="passAttendant" name="passAttendant" required>
                                        </div>
                                        <div class="input-data">
                                            <span>Imagen de perfil</span>
                                            <div class="container-profile">
                                                <div class="profile">
                                                    <img src="../Assets/media/niña.jpg" alt="">
                                                    <span id="profileAttended">Nombre</span>
                                                </div>
                                                <div class="profile">
                                                    <img src="../Assets/media/nikol.jpg" alt="">
                                                    <span id="profileAttendant">Nombre</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-data">
                                            <input type="submit" id="action" name="action" value="Inscribir">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
        </div>
    </div>
    <script src="../Assets/js/script_inscription.js"></script>
</body>
</html>