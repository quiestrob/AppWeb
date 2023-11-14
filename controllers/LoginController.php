<?php

    session_start();

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/controllers/AcudidoController.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/controllers/InscripcionController.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/controllers/UsuarioController.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/controllers/ActividadController.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/UsuarioService.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/AcudidoService.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/EstadoService.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/FundadorService.php';

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

            $attended = AcudidoService::findAttended($identification);
            $verify = is_string($attended);
            
            if ($verify == false) {
                if ($attended->contraseña == $pass) {
                    $attended = serialize($attended);
                    $_SESSION['usuario.login'] = $attended;
                    $_SESSION['usuario.type'] = 'Estudiante';   

                    $statusInscription = EstadoService::listStatus($identification);
                    
                    $statusInscription = serialize($statusInscription);
                    $_SESSION['usuario.status'] = $statusInscription; 

                    UsuarioController::listProffesorGroup($identification);
                    ActividadController::listActivities($identification);
                    header("Location: ../root/pages/validation_inscription.php");
                    exit;
                } else {
                    $_SESSION['usuario.login'] = null;
                    header("Location: ../root/pages/login.php?msj=Contraseña incorrecta.");
                    exit;
                } 
            } else {
                $attendant = UsuarioService::findUserAttendant($identification);
                $verify = is_string($attendant);

                if ($verify == false) {
                    if ($attendant->contraseña == $pass) {
                        $attendant = serialize($attendant);
                        $_SESSION['usuario.login'] = $attendant;
                        $_SESSION['usuario.type'] = 'Acudiente';

                        $statusInscription = EstadoService::listStatusAttendant($identification);
                        
                        $statusInscription = serialize($statusInscription);
                        $_SESSION['usuario.status'] = $statusInscription; 

                        UsuarioController::listProffesorGroupAttendant($identification);
    
                        header("Location: ../root/pages/validation_inscription.php");
                        exit;
                    } else {
                        $_SESSION['usuario.login'] = null;
                        header("Location: ../root/pages/login.php?msj=Contraseña incorrecta.");
                        exit;
                    } 
                } else {
                    $proffesor = UsuarioService::findUserProffesor($identification);
                    $verify = is_string($proffesor);

                    if ($verify == false) {
                        if ($proffesor->contraseña == $pass) {
                            $proffesor = serialize($proffesor);
                            $_SESSION['usuario.login'] = $proffesor;
                            $_SESSION['usuario.type'] = 'Profesor';

                            UsuarioController::listAttendant();
                            AcudidoController::listStudentStatus();
        
                            header("Location: ../root/pages/validation_inscription.php");
                            exit;
                        } else {
                            $_SESSION['usuario.login'] = null;
                            header("Location: ../root/pages/login.php?msj=Contraseña incorrecta.");
                            exit;
                        }  
                    } else {
                        $founder = FundadorService::findFounder($identification);
                        $verify = is_string($founder);

                        if ($verify == false) {
                            if ($founder->contraseña == $pass) {
                                $founder = serialize($founder);
                                $_SESSION['usuario.login'] = $founder;
                                $_SESSION['usuario.type'] = 'Administrador';

                                AcudidoController::listStudentStatus();
                                InscripcionController::listInscription();
                                UsuarioController::listUserProffesor();
            
                                header("Location: ../root/pages/validation_inscription.php");
                                exit;
                            } else {
                                $_SESSION['usuario.login'] = null;
                                header("Location: ../root/pages/login.php?msj=Contraseña incorrecta.");
                                exit;
                            }
                        } else {
                            $msj = "El usuario no existe.";
                            header("Location: ../root/pages/login.php?msj=$msj");
                            exit;
                        }
                    }
                }
            }
        }
    }

    LoginController::executeAction();

?>