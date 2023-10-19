<?php

    session_start();

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Acudido.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Acudiente.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Profesor.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Estado.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Inscripcion.php';

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/controllers/AcudidoController.php';

    class LoginController {
        public static function executeAction() {
            $action = $_REQUEST['action'];
            
            switch ($action) {
                case 'Ingresar':
                    LoginController::login();
                    break;
                default:
                    header("Location: ../root/pages/error.php");
                    exit;
            }
        }

        public static function login() {
            $identification = @$_REQUEST['identification'];
            $pass = @$_REQUEST['pass'];

            try {
                $a = Acudido::find($identification);
                
                if ($a->contraseña == $pass) {
                    $a = serialize($a);
                    $_SESSION['usuario.login'] = $a;
                    $_SESSION['usuario.type'] = 'Estudiante';   

                    $statusInscription = Estado::find('all', array(
                        'joins' => array(
                            'INNER JOIN inscripciones ON estados.ID = inscripciones.estado_id',
                            'INNER JOIN acudidos ON inscripciones.identificacion_acudido = acudidos.identificacion'
                        ),
                        'select' => 'Estados.Estado, Estados.Descripcion',
                        'conditions' => "acudidos.identificacion = '$identification'"
                    ));
                    
                    $statusInscription = serialize($statusInscription);
                    $_SESSION['usuario.status'] = $statusInscription; 

                    AcudidoController::listarEstudiantes();

                    header("Location: ../root/pages/validation_inscription.php");
                    exit;
                } else {
                    $_SESSION['usuario.login'] = null;
                    header("Location: ../root/pages/login.php?msj=Contraseña incorrecta.");
                    exit;
                }    
            } catch (Exception $error) {
                if (strstr($error->getMessage(), $identification)) {
                    try {
                        $ac = Acudiente::find($identification);

                        if ($ac->contraseña == $pass) {
                            $ac = serialize($ac);
                            $_SESSION['usuario.login'] = $ac;
                            $_SESSION['usuario.type'] = 'Acudiente';
        
                            header("Location: ../root/pages/validation_inscription.php");
                            exit;
                        } else {
                            $_SESSION['usuario.login'] = null;
                            header("Location: ../root/pages/login.php?msj=Contraseña incorrecta.");
                            exit;
                        }  
                    } catch (Exception $error) {
                        if (strstr($error->getMessage(), $identification)) {
                            try {
                                $p = Profesor::find($identification);
        
                                if ($p->contraseña == $pass) {
                                    $p = serialize($p);
                                    $_SESSION['usuario.login'] = $p;
                                    $_SESSION['usuario.type'] = 'Profesor';
                
                                    header("Location: ../root/pages/validation_inscription.php");
                                    exit;
                                } else {
                                    $_SESSION['usuario.login'] = null;
                                    header("Location: ../root/pages/login.php?msj=Contraseña incorrecta.");
                                    exit;
                                }  
                            } catch (Exception $error) {
                                if (strstr($error->getMessage(), $identification)) {
                                    try {
                                        $f = Fundador::find($identification);
                
                                        if ($f->contraseña == $pass) {
                                            $f = serialize($f);
                                            $_SESSION['usuario.login'] = $f;
                                            $_SESSION['usuario.type'] = 'Administrador';
                        
                                            header("Location: ../root/pages/validation_inscription.php");
                                            exit;
                                        } else {
                                            $_SESSION['usuario.login'] = null;
                                            header("Location: ../root/pages/login.php?msj=Contraseña incorrecta.");
                                            exit;
                                        }  
                                    } catch (Exception $error) {
                                        if (strstr($error->getMessage(), $identification)) {
                                            $msj = "El usuario no existe.";
                                        } else {
                                            $msj = "Ocurrio un error.";
                                        }
        
                                        header("Location: ../root/pages/login.php?msj=$msj");
                                        exit;
                                    }
                                } else {
                                    $msj = $error->getMessage();
                                }

                                header("Location: ../root/pages/login.php?msj=$msj");
                                exit;
                            }
                        } else {
                            $msj = "Ocurrio un error.";
                        }

                        header("Location: ../root/pages/login.php?msj=$msj");
                        exit;
                    }
                } else {
                    $msj = $error->getMessage();
                }

                header("Location: ../root/pages/login.php?msj=$msj");
                exit;
            }
        }
    }

    LoginController::executeAction();
?>