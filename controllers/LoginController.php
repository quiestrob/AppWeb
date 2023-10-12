<?php

    session_start();

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Acudido.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Acudiente.php';

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

                    header("Location: ../root/pages/validation_inscription.php");
                    exit;
                } else {
                    $_SESSION['usuario.login'] = null;
                    header("Location: ../root/pages/login.php?msj=Contraseña incorrecta");
                    exit;
                }    
            } catch (Exception $error) {
                if (strstr($error->getMessage(), $user)) {
                    try {
                        $ac = Acudiente::find($identification);

                        if ($ac->contraseña == $pass) {
                            $ac = serialize($ac);
                            $_SESSION['usuario.login'] = $ac;
        
                            header("Location: ../root/pages/validation_inscription.php");
                            exit;
                        } else {
                            $_SESSION['usuario.login'] = null;
                            header("Location: ../root/pages/login.php?msj=Contraseña incorrecta");
                            exit;
                        }  
                    } catch (Exception $error) {
                        if (strstr($error->getMessage(), $user)) {
                            $msj = "El usuario no existe.";
                        } else {
                            $msj = "Ocurrio un error.";
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

        }
    }

    LoginController::executeAction();
?>