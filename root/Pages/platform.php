<?php
    
    require_once "session_validation.php";
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Acudido.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Acudiente.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/controllers/InscripcionController.php';

    $a = @$_SESSION['usuario.login'];
    $a = @unserialize($a);

    $type = @$_SESSION['usuario.type'];
    
    $estudiantes = @$_SESSION['estudiante.all'];
    $estudiantes = @unserialize($estudiantes);

    $inscripcion = @$_SESSION['inscripcion.all'];
    $inscripcion = @unserialize($inscripcion);

    $profesor = @$_SESSION['profesor.all'];
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
    <title>CogniSphere - <?= $a->nombre ?></title>
    <link rel="stylesheet" href="../assets/css/style_platform.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container-messages">
        <div class="profile-message">
            <div class="image-profile">
                <?php 
                    $foto = base64_encode($a->foto);
                ?>
                    <img src="data:image/jpeg;base64,<?= $foto ?>">    
            </div>
            <div class="content-profile">
                <span><?= $a->nombre ?></span>
                <span>Online</span>
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
                            <i class="fi fi-rr-messages"></i>
                        </div>
                        <div class="profile">
                            <div class="image-profile">
                                <?php 
                                    $foto = base64_encode($a->foto);
                                ?>
                                <img src="data:image/jpeg;base64,<?= $foto ?>">    
                            </div>
                            <div class="content-profile">
                                <span><?= $a->nombre ?></span>
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
                                        <a href="#"><?= $est->identificacion ?></a>
                                    </span>
                                    <span class="group">
                                        <a href="#"><?= $est->aula ?></a>
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
                                                    <a href="#"><?= $proG->identificacion ?></a>
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
                                                    <a href="#"><?= $proGA->identificacion ?></a>
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
                                    <th>ID</th>
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
                                        <td><?= $i->id ?></td>
                                        <td><?= $i->nombre ?></td>
                                        <td><?= $fecha ?></td>
                                        <td><?= $i->discapacidad ?></td>
                                        <td><?= $i->estado ?></td>
                                        <td>
                                            <?php
                                                if ($i->estado == "Aceptada") {
                                            ?>
                                                <div class="button-accept active">
                                                    <i class="fi fi-br-check"></i>
                                                    <span>Aceptar</span>
                                                </div>
                                                <div class="button-decline">
                                                    <i class="fi fi-br-x"></i>
                                                    <span>Rechazar</span>
                                                </div>
                                            <?php
                                                } else if ($i->estado == "Rechazada") {
                                            ?>
                                                <div class="button-accept">
                                                    <i class="fi fi-br-check"></i>
                                                    <span>Aceptar</span>
                                                </div>
                                                <div class="button-decline active">
                                                    <i class="fi fi-br-x"></i>
                                                    <span>Rechazar</span>
                                                </div>
                                            <?php
                                                } else {
                                            ?>
                                                <div class="button-accept" onclick="accept(<?= $i->estado_id ?>, <?= $a->identificacion ?>, <?= $i->id ?>)">
                                                    <i class="fi fi-br-check"></i>
                                                    <span>Aceptar</span>
                                                </div>
                                                <div class="button-decline" onclick="decline(<?= $i->estado_id ?>, <?= $a->identificacion ?>, <?= $i->id ?>)">
                                                    <i class="fi fi-br-x"></i>
                                                    <span>Rechazar</span>
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