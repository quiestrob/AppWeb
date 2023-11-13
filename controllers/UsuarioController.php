<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/UsuarioService.php';

    class UsuarioController {
        public static function findUser($identification) {
            try {
                $user = UsuarioService::findUser($identification);

                if ($user == null){
                    $_SESSION['usuario.all'] = null;
                } else {
                    $user = serialize($user);
                    $_SESSION['usuario.all'] = $user;
                }

            } catch(Exception $error){
                $_SESSION['usuario.all'] = null;
            }
        }

        public static function listAttendant() {
            try {
                $user = UsuarioService::listUserAttendant();

                if ($user == null){
                    $_SESSION['usuario_attendant.all'] = null;
                } else {
                    $user = serialize($user);
                    $_SESSION['usuario_attendant.all'] = $user;
                }

            } catch(Exception $error){
                $_SESSION['usuario_attendant.all'] = null;
            }
        }

        public static function listUserProffesor() {
            try {
                $user = UsuarioService::listUserProffesor();

                if ($user == null){
                    $_SESSION['usuario_profesor.all'] = null;
                } else {
                  $user = serialize($user);
                  $_SESSION['usuario_profesor.all'] = $user;
                }

            } catch(Exception $error){
                $_SESSION['usuario_profesor.all'] = null;
            }
        }

        public static function listProffesorGroup($identification) {
            try {
                $user = UsuarioService::listProffesorGroup($identification);

                if ($user == null){
                    $_SESSION['profesor_grupo.all'] = null;
                } else {
                  $user = serialize($user);
                  $_SESSION['profesor_grupo.all'] = $user;
                }

            } catch(Exception $error){
                $_SESSION['profesor_grupo.all'] = null;
            }
        }

        public static function listProffesorGroupAttendant($identification) {
            try {
                $user = UsuarioService::listProffesorGroupAttendant($identification);

                if ($user == null){
                    $_SESSION['profesor_grupoA.all'] = null;
                } else {
                  $user = serialize($user);
                  $_SESSION['profesor_grupoA.all'] = $user;
                }

            } catch(Exception $error){
                $_SESSION['profesor_grupoA.all'] = null;
            }
        }
    }

?>