<?php
    
    require_once "session_validation.php";
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Acudido.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Acudiente.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/controllers/InscripcionController.php';

    $user = @$_SESSION['usuario.login'];
    $user = @unserialize($user);

    $type = @$_SESSION['usuario.type'];
    
    $estudiantes = @$_SESSION['estudiante.all'];
    $estudiantes = @unserialize($estudiantes);

    $actividad = @$_SESSION['actividad.all'];
    $actividad = @unserialize($actividad);

    $inscripcion = @$_SESSION['inscripcion.all'];
    $inscripcion = @unserialize($inscripcion);

    $acudiente = @$_SESSION['usuario_attendant.all'];
    $acudiente = @unserialize($acudiente);

    $profesor = @$_SESSION['usuario_profesor.all'];
    $profesor = @unserialize($profesor);

    $profesorGrupo = @$_SESSION['profesor_grupo.all'];
    $profesorGrupo = @unserialize($profesorGrupo);

    $profesorGrupoA = @$_SESSION['profesor_grupoA.all'];
    $profesorGrupoA = @unserialize($profesorGrupoA);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CogniSphere - <?= $user->nombre ?></title>
    <link rel="stylesheet" href="../assets/css/style_platform.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-solid-straight/css/uicons-solid-straight.css'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container-edit-activity">
        <div class="edit-activity">
            <div class="close-edit">
                <i class="fi fi-br-x"></i>
            </div>
            <div class="input-data">
                <span>Titulo</span>
                <input type="number" id="title" name="title" value="" readonly>
            </div>
            <div class="input-data">
                <span>Descripcion</span>
                <input type="text" id="description" name="description" value="" readonly>
            </div>
            <div class="input-data">
                <span>Archivo</span>
                <input type="file" id="archive" name="archive" value="" readonly>
            </div>
            <div class="input-data">
                <input type="submit" name="action" value="Editar">
            </div>
        </div>
    </div>
    <div class="container-edit-profile">
        <?php
            if ($type == 'Estudiante') {
        ?>
                <div class="edit-profile">
                    <div class="close-edit">
                        <i class="fi fi-br-x"></i>
                    </div>
                    <div class="input-data">
                        <span>Identificación</span>
                        <input type="number" id="idAttended" name="idAttended" value="<?= $user->identificacion ?>" readonly>
                    </div>
                    <div class="input-data">
                        <span>Nombre</span>
                        <input type="text" id="nameAttended" name="nameAttended" value="<?= $user->nombre ?>" required>
                    </div>
                    <div class="input-data">
                        <span>Género</span>
                        <?php
                            if ($user->genero == 'Masculino') {
                        ?>
                                <div class="container-radio">
                                    <div class="container-radio__radio">
                                        <input type="radio" name="radio-gender" value="Masculino" checked required>
                                        <span>Masculino</span>
                                    </div>
                                    <div class="container-radio__radio">
                                        <input type="radio" name="radio-gender" value="Femenino" required>
                                        <span>Femenino</span>
                                    </div>
                                </div>
                        <?php
                            } else {
                        ?> 
                                <div class="container-radio">
                                    <div class="container-radio__radio">
                                        <input type="radio" name="radio-gender" value="Masculino" required>
                                        <span>Masculino</span>
                                    </div>
                                    <div class="container-radio__radio">
                                        <input type="radio" name="radio-gender" value="Femenino" checked required>
                                        <span>Femenino</span>
                                    </div>
                                </div>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="input-data">
                        <?php
                            $fecha = date('Y-m-d', strtotime($user->fecha_nacimiento));
                        ?>
                        <span>Fecha de nacimiento</span>
                        <input type="date" id="date" name="date" value="<?= $fecha ?>" readonly>
                    </div>
                        <div class="input-data">
                        <span>Discapacidad</span>
                        <input type="text" id="disability" name="disability" value="<?= $user->discapacidad ?>" readonly>
                    </div>
                    <div class="input-data">
                        <input type="submit" name="action" value="Editar">
                    </div>
                </div>
        <?php
            } else if ($type == 'Profesor' || $type == 'Acudiente') {
        ?>
                <div class="edit-profile">
                    <div class="close-edit">
                        <i class="fi fi-br-x"></i>
                    </div>
                    <div class="input-data">
                        <span>Identificación</span>
                        <input type="number" id="identification" name="idAttended" value="<?= $user->identificacion ?>" readonly>
                    </div>
                    <div class="input-data">
                        <span>Nombre</span>
                        <input type="text" id="name" name="name" value="<?= $user->nombre ?>" required>
                    </div>
                    <div class="input-data">
                        <span>Telefono</span>
                        <input type="number" id="phone" name="phone" value="<?= $user->telefono ?>" required>
                    </div>
                    <div class="input-data">
                        <span>Correo</span>
                        <input type="email" id="email" name="email" value="<?= $user->correo ?>" readonly>
                    </div>
                    <div class="input-data">
                        <span>Contraseña</span>
                        <input type="password" id="pass" name="pass" value="<?= $user->contraseña ?>" required>
                    </div>
                    <div class="input-data">
                        <span>Direccion</span>
                        <input type="text" id="address" name="address" value="<?= $user->direccion ?>" readonly>
                    </div>
                    <div class="input-data">
                        <input type="submit" name="action" value="Editar">
                    </div>
                </div> 
        <?php
            } else {
        ?>
                <div class="edit-profile">
                    <div class="close-edit">
                        <i class="fi fi-br-x"></i>
                    </div>
                    <div class="input-data">
                        <span>Identificación</span>
                        <input type="number" id="identification" name="idAttended" value="<?= $user->identificacion ?>" readonly>
                    </div>
                    <div class="input-data">
                        <span>Nombre</span>
                        <input type="text" id="name" name="name" value="<?= $user->nombre ?>" required>
                    </div>
                    <div class="input-data">
                        <span>Correo</span>
                        <input type="email" id="email" name="email" value="<?= $user->correo ?>" readonly>
                    </div>
                    <div class="input-data">
                        <span>Contraseña</span>
                        <input type="password" id="pass" name="pass" value="<?= $user->contraseña ?>" required>
                    </div>
                    <div class="input-data">
                        <input type="submit" name="action" value="Editar">
                    </div>
                </div> 
        <?php
            }
        ?>
    </div>
    <div class="container-messages">
        <?php
            if ($type === "Acudiente") {
                foreach($profesorGrupoA as $pro) {
        ?>
                    <div class="profile-message">
                        <input type="hidden" id="idTransmitter" value="<?= $user->identificacion ?>">
                        <input type="hidden" id="idReceiver" value="<?= $pro->identificacion ?>">
                        <div class="image-profile">
                            <?php 
                                $foto = base64_encode($pro->foto);
                            ?>
                                <img src="data:image/jpeg;base64,<?= $foto ?>">    
                        </div>
                        <div class="content-profile">
                            <span><?= $pro->nombre ?></span>
                            <span>Online</span>
                        </div>
                    </div>
        <?php
                }
            } else if ($type === "Profesor") {
                foreach ($acudiente as $acu) {
        ?>
                    <div class="profile-message">
                        <input type="hidden" id="idTransmitter" value="<?= $user->identificacion ?>">
                        <input type="hidden" id="idReceiver" value="<?= $acu->identificacion ?>">
                        <div class="image-profile">
                            <?php 
                                $foto = base64_encode($acu->foto);
                            ?>
                                <img src="data:image/jpeg;base64,<?= $foto ?>">    
                        </div>
                        <div class="content-profile">
                            <span><?= $acu->nombre ?></span>
                            <span>Online</span>
                        </div>
                    </div>
        <?php
                }
            }
        ?>
    </div>
    <div class="container-chat">
        <div class="container-chat__title">
            <h2>Mensajes</h2>
        </div>
        <div class="container-chat__background">
            <div class="container-content">
                <table id="content-messages">
                    
                </table>
            </div>
            <div class="container-send">
                <div class="bar-send">
                    <input type="hidden" id="messageTransmitter">
                    <input type="hidden" id="messageReceiver">
                    <input type="text" placeholder="Mensaje..." id="message-content">
                    <i class="fi fi-sr-paper-plane"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="container-navegation">  
            <div class="title">
                <h1>CogniSphere</h1>
            </div>  
            <div class="navegation">
                <div class="nav nav-information">
                    <i class="fi fi-rr-comment-info"></i>
                    <span>Informacion</span>
                </div>
                <div class="nav nav-students">
                    <i class="fi fi-rr-graduation-cap"></i>
                    <span>Estudiantes</span>
                </div>
                <div class="nav nav-activities">
                    <i class="fi fi-rr-note"></i>
                    <span>Actividades</span>
                </div>
                <div class="nav nav-reports">
                    <i class="fi fi-rr-document"></i>
                    <span>Informes</span>
                </div>
                <div class="nav nav-teachers">
                    <i class="fi fi-rr-chalkboard-user"></i>
                    <span>Profesores</span>
                </div>
                <div class="separator"></div>
                <div class="nav nav-donations">
                    <i class="fi fi-rr-donate"></i>
                    <span>Donaciones</span>
                </div>
                <div class="nav nav-inscriptions">
                    <i class="fi fi-rr-user-add"></i>
                    <span>Inscripciones</span>
                </div>
            </div>
            <div class="logout">
                <i class="fi fi-rr-sign-out-alt"></i>
                <span>SALIR</span>
            </div>
        </div>
        <div class="background-content">
            <div class="container-content">
                <div class="container-profile">  
                    <div class="profile-options">  
                        <div class="options">
                            <i class="fi fi-sr-comments"></i>
                        </div>
                        <div class="profile">
                            <div class="image-profile">
                                <?php 
                                    $foto = base64_encode($user->foto);
                                ?>
                                <img src="data:image/jpeg;base64,<?= $foto ?>">    
                            </div>
                            <div class="content-profile">
                                <span><?= $user->nombre ?></span>
                                <span><?= $type ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-sections">                  
                    <section id="section-information">
                        <div class="section-title">
                            <h2>Información</h2>
                        </div>
                        <div class="section-content">
                            <?php
                                if ($type == 'Estudiante') {
                            ?>
                                    <div class="container-information">
                                        <div class="image-profile">
                                            <?php 
                                                $foto = base64_encode($user->foto);
                                            ?>
                                            <img src="data:image/jpeg;base64,<?= $foto ?>">
                                        </div>
                                        <div class="information">
                                            <div class="title-information">
                                                <h2><?= $user->nombre ?></h2>
                                                <span><?= $type ?></span>
                                            </div>
                                            <div class="span-information">
                                                <i class="fi fi-ss-user"></i>
                                                <span><?= $user->identificacion ?></span>
                                            </div>
                                            <div class="span-information">
                                                <i class="fi fi-rr-venus-mars"></i>
                                                <span><?= $user->genero ?></span>
                                            </div>
                                            <div class="span-information">
                                                <i class="fi fi-ss-cake-birthday"></i>
                                                <?php
                                                    $fecha = date('d/m/Y', strtotime($user->fecha_nacimiento));
                                                ?>
                                                <span><?= $fecha ?></span>
                                            </div>
                                            <div class="span-information">
                                                <i class="fi fi-sr-balloons"></i>
                                                <span><?= $user->edad ?></span>
                                            </div>
                                            <div class="span-information">
                                                <i class="fi fi-br-wheelchair"></i>
                                                <span><?= $user->discapacidad ?></span>
                                            </div>
                                            <div class="span-information">
                                                <i class="fi fi-sr-key"></i>
                                                <span><?= str_repeat('*', strlen($user->contraseña)) ?></span>
                                            </div>
                                            <div class="span-information">
                                                <span>Editar</span>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                } else if ($type == 'Administrador') {
                            ?>
                                    <div class="container-information">
                                        <div class="image-profile">
                                            <?php 
                                                $foto = base64_encode($user->foto);
                                            ?>
                                            <img src="data:image/jpeg;base64,<?= $foto ?>">
                                        </div>
                                        <div class="information">
                                            <div class="title-information">
                                                <h2><?= $user->nombre ?></h2>
                                                <span><?= $type ?></span>
                                            </div>
                                            <div class="span-information">
                                                <i class="fi fi-ss-user"></i>
                                                <span><?= $user->identificacion ?></span>
                                            </div>
                                            <div class="span-information">
                                                <i class="fi fi-sr-envelope"></i>
                                                <span><?= $user->correo ?></span>
                                            </div>
                                            <div class="span-information">
                                                <i class="fi fi-sr-key"></i>
                                                <span><?= str_repeat('*', strlen($user->contraseña)) ?></span>
                                            </div>
                                            <div class="span-information">
                                                <span>Editar</span>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                } else {
                            ?>
                                    <div class="container-information">
                                        <div class="image-profile">
                                            <?php 
                                                $foto = base64_encode($user->foto);
                                            ?>
                                            <img src="data:image/jpeg;base64,<?= $foto ?>">
                                        </div>
                                        <div class="information">
                                            <div class="title-information">
                                                <h2><?= $user->nombre ?></h2>
                                                <span><?= $type ?></span>
                                            </div>
                                            <div class="span-information">
                                                <i class="fi fi-ss-user"></i>
                                                <span><?= $user->identificacion ?></span>
                                            </div>
                                            <div class="span-information">
                                                <i class="fi fi-sr-phone-flip"></i>
                                                <span><?= $user->telefono ?></span>
                                            </div>
                                            <div class="span-information">
                                                <i class="fi fi-sr-envelope"></i>
                                                <span><?= $user->correo ?></span>
                                            </div>
                                            <div class="span-information">
                                                <i class="fi fi-sr-key"></i>
                                                <span><?= str_repeat('*', strlen($user->contraseña)) ?></span>
                                            </div>
                                            <div class="span-information">
                                                <i class="fi fi-sr-house-chimney-blank"></i>
                                                <span><?= $user->direccion ?></span>
                                            </div>
                                            <div class="span-information">
                                                <span>Editar</span>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            ?> 
                        </div>
                    </section>
                    <section id="section-students">
                        <div class="section-title">
                            <h2>Estudiantes</h2>
                        </div>
                        <div class="section-content">
                            <?php 
                                foreach ($estudiantes as $est) {
                            ?>
                            <div class="card">
                                <div class="imgBx">
                                    <?php 
                                        $fotoEst = base64_encode($est->foto);
                                    ?>
                                    <img src="data:image/jpeg;base64,<?= $fotoEst ?>"> 
                                </div>
                                <div class="content">
                                    <span class="identification">
                                        <a><?= $est->identificacion ?></a>
                                    </span>
                                    <span class="group">
                                        <a><?= $est->aula ?></a>
                                    </span>
                                    <ul>
                                        <li><i class="fi fi-rr-user"></i> <?= $est->nombre ?></li>
                                        <li><i class="fi fi-rr-venus-mars"></i> <?= $est->genero ?></li>
                                        <li><i class="fi fi-rr-wheelchair"></i> <?= $est->discapacidad ?></li>
                                    </ul>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </section>
                    <section id="section-activities">
                        <div class="section-title">
                            <h2>Actividades</h2>
                        </div>
                        <div class="section-content">
                            <table>
                                <tr>
                                    <th>Titulo</th>
                                    <th>Descripcion</th>
                                    <th>Archivo</th>
                                    <th>Fecha</th>
                                    <?php
                                        if ($type == 'Administrador') {
                                            //
                                        } else if ($type == 'Profesor') {
                                    ?>
                                            <th>Grupo</th>
                                            <th>Accion</th>
                                    <?php
                                        } else {
                                    ?>
                                            <th>Grupo</th>
                                    <?php
                                        } 
                                    ?>
                                </tr>    
                                <?php
                                    if ($type == 'Administrador') {

                                        foreach ($actividad as $a) {

                                            $fecha = date('d/m/Y', strtotime($a->fecha_asignacion));
                                ?>
                                            <tr>
                                                <td><?= $a->titulo ?></td>
                                                <td><?= $a->descripcion ?></td>
                                                <?php
                                                    $base64=base64_encode($a->archivo);
                                                    $ruta='data:application/pdf;base64,'.$base64;
                                                ?>
                                                <td><a href="<?php echo"$ruta"?>"download="<?php echo "$a->titulo"?>.pdf"><?php echo "$a->titulo"?>.pdf</a></td>
                                                <td><?= $fecha ?></td>
                                            </tr>
                                <?php
                                        }
                                    } else if ($type == 'Profesor') {
                                        foreach ($actividad as $a) {

                                            $fecha = date('d/m/Y', strtotime($a->fecha_asignacion));
                                ?>
                                            <tr>
                                                <td><?= $a->titulo ?></td>
                                                <td><?= $a->descripcion ?></td>
                                                <?php
                                                    $base64=base64_encode($a->archivo);
                                                    $ruta='data:application/pdf;base64,'.$base64;
                                                ?>
                                                <td><a href="<?php echo"$ruta"?>"download="<?php echo "$a->titulo"?>.pdf"><?php echo "$a->titulo"?>.pdf</a></td>
                                                <td><?= $fecha ?></td>
                                                <td><?= $a->aula ?></td>
                                                <td>
                                                    <div class="button-edit" onclick="openEditActivity()">
                                                        <i class="fi fi-sr-select"></i>
                                                    </div>
                                                    <div class="button-delete">
                                                        <i class="fi fi-sr-trash"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    } else {
                                        foreach ($actividad as $a) {

                                            $fecha = date('d/m/Y', strtotime($a->fecha_asignacion));
                                ?>
                                            <tr>
                                                <td><?= $a->titulo ?></td>
                                                <td><?= $a->descripcion ?></td>
                                                <?php
                                                    $base64=base64_encode($a->archivo);
                                                    $ruta='data:application/pdf;base64,'.$base64;
                                                ?>
                                                <td><a href="<?php echo"$ruta"?>"download="<?php echo "$a->titulo"?>.pdf"><?php echo "$a->titulo"?>.pdf</a></td>
                                                <td><?= $fecha ?></td>
                                                <td><?= $a->aula ?></td>
                                            </tr>
                                <?php
                                        }
                                    }
                                ?>            
                            </table>
                            <!--<div class="add-activity">
                                <i class="fi fi-br-plus"></i>
                            </div>-->
                        </div>
                    </section>
                    <section id="section-reports">
                        <div class="section-title">
                             <h2>Informes</h2>
                        </div>
                    </section>
                    <section id="section-proffesors">
                        <div class="section-title">
                            <h2>Profesores</h2>
                        </div>
                        <div class="section-content">
                            <?php
                                if ($type === "Estudiante") {
                                    foreach ($profesorGrupo as $proG) {
                            ?>
                                        <div class="card">
                                            <div class="imgBx">
                                                <?php 
                                                    $fotoEst = base64_encode($proG->foto);
                                                ?>
                                                <img src="data:image/jpeg;base64,<?= $fotoEst ?>"> 
                                            </div>
                                            <div class="content">
                                                <span class="identification">
                                                    <a><?= $proG->identificacion ?></a>
                                                </span>
                                                <ul>
                                                    <li><i class="fi fi-rr-user"></i> <?= $proG->nombre ?></li>
                                                    <li><i class="fi fi-rr-phone-call"></i> <?= $proG->telefono ?></li>
                                                    <li><i class="fi fi-rr-envelope"></i> <?= $proG->correo ?></li>
                                                </ul>
                                            </div>
                                        </div>
                            <?php
                                    }
                                } else if ($type === "Acudiente") {
                                    foreach ($profesorGrupoA as $proGA) {
                            ?>
                                        <div class="card">
                                            <div class="imgBx">
                                                <?php 
                                                    $fotoEst = base64_encode($proGA->foto);
                                                ?>
                                                <img src="data:image/jpeg;base64,<?= $fotoEst ?>"> 
                                            </div>
                                            <div class="content">
                                                <span class="identification">
                                                    <a><?= $proGA->identificacion ?></a>
                                                </span>
                                                <ul>
                                                    <li><i class="fi fi-rr-user"></i> <?= $proGA->nombre ?></li>
                                                    <li><i class="fi fi-rr-phone-call"></i> <?= $proGA->telefono ?></li>
                                                    <li><i class="fi fi-rr-envelope"></i> <?= $proGA->correo ?></li>
                                                </ul>
                                            </div>
                                        </div>
                            <?php
                                    }
                                } else if ($type === "Administrador") {
                                    foreach ($profesor as $pro) {
                            ?>
                                        <div class="card">
                                            <div class="imgBx">
                                                <?php 
                                                    $fotoEst = base64_encode($pro->foto);
                                                ?>
                                                <img src="data:image/jpeg;base64,<?= $fotoEst ?>"> 
                                            </div>
                                            <div class="content">
                                                <span class="identification">
                                                    <a href="#"><?= $pro->identificacion ?></a>
                                                </span>
                                                <ul>
                                                    <li><i class="fi fi-rr-user"></i> <?= $pro->nombre ?></li>
                                                    <li><i class="fi fi-rr-phone-call"></i> <?= $pro->telefono ?></li>
                                                    <li><i class="fi fi-rr-envelope"></i> <?= $pro->correo ?></li>
                                                </ul>
                                            </div>
                                        </div>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </section>
                    <section id="section-donations">
                        <div class="section-title">
                            <h2>Donaciones</h2>
                        </div>
                    </section>
                    <section id="section-inscriptions">
                        <div class="section-title">
                            <h2>Inscripciones</h2>
                        </div>
                        <div class="section-content">
                            <table>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nombre</th>
                                    <th>Fecha</th>
                                    <th>Discapacidad</th>
                                    <th>Estado</th>
                                    <th>Accion</th>
                                </tr>    
                                <?php
                                    foreach ($inscripcion as $i) {

                                        $fecha = date('d/m/Y', strtotime($i->fecha_inscripcion));
                                ?>
                                    <tr>
                                        <?php 
                                            $foto = base64_encode($i->foto);
                                        ?>
                                        <td>
                                            <img src="data:image/jpeg;base64,<?= $foto ?>">
                                        </td>
                                        <td><?= $i->nombre ?></td>
                                        <td><?= $fecha ?></td>
                                        <td><?= $i->discapacidad ?></td>
                                        <td><?= $i->estado ?></td>
                                        <td>
                                            <?php
                                                if ($i->estado == "Aceptada" || $i->estado == 'Rechazada') {
                                            ?>
                                                <span>No disponible</span>
                                            <?php
                                                } else {
                                            ?>
                                                <div class="button-accept" onclick="accept(<?= $i->estado_id ?>, <?= $user->identificacion ?>, <?= $i->id ?>)">
                                                    <i class="fi fi-br-check"></i>
                                                </div>
                                                <div class="button-decline" onclick="decline(<?= $i->estado_id ?>, <?= $user->identificacion ?>, <?= $i->id ?>)">
                                                    <i class="fi fi-br-x"></i>
                                                </div>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                <?php   
                                    }
                                ?>
                            </table>
                        </div>
                     </section> 
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/script_platform.js"></script>
</body>
</html>