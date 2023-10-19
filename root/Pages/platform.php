<?php
    
    require_once "session_validation.php";
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Acudido.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Acudiente.php';

    $inscripcion = @$_SESSION['incripcion.all'];
    $inscripcion = @unserialize($inscripcion);

    $a = @$_SESSION['usuario.login'];
    $a = @unserialize($a);

    $type = @$_SESSION['usuario.type'];
    $estudiantes = @$_SESSION['estudiante.all'];
    $estudiantes = @unserialize($estudiantes);
    
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
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
                    <i class="fi fi-rr-note"></i>
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
                    <div class="search">
                        <div class="search-bar">
                            <i class="fi fi-rr-search"></i>
                            <input type="text" placeholder="Buscar...">
                        </div>
                    </div>
                    <div class="profile-options">
                        <div class="options">
                            <i class="fi fi-rr-messages"></i>
                        </div>
                        <div class="profile">
                            <div class="image-profile">
                                    
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
                        <table>
                            <tr>
                                <th>Identificación</th>
                                <th>Nombre</th>
                                <th>Género</th>
                                <th>Discapacidad</th>
                            </tr> 
                            <?php 
                                foreach ($estudiantes as $est){
                            ?>
                            <tr>
                                <td><?=$est->identificacion?></td>
                                <td><?=$est->nombre?></td>
                                <td><?=$est->genero?></td>
                                <td><?=$est->discapacidad?></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </table>
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
                    </section>
                    <section id="section-donations">
                        <div class="section-title">
                            <h2>Donaciones</h2>
                        </div>
                    </section>
                    <section id="section-inscriptions">
                        <div class="section-title">
                        <div class="section-title">
                            <h2>Inscripciones</h2>
                            <fieldset style="width: 70%;">
                            <table>
                                <tr>
                                    <th>ID Inscripcion</th>
                                    <th>Fecha de inscripcion</th>
                                    <th>Estado de la inscripcion</th>
                                </tr>    
                                <?php
                                foreach ($inscripcion as $i => $u) {
                                    ?>
                                    <tr>
                                        <td><?=($i + 1) ?></td>
                                        <td><?= $u->id ?></td>
                                        <td><?= $u ->Fecha ?></td>
                                    </tr>
                                     <?php   
                                }
                                ?>
                                </table>
                            </fieldset>
                        </div>
                     </section> 
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/script_platform.js"></script>
</body>
</html>