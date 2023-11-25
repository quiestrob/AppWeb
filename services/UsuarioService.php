<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Usuario.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/persistences/UsuarioCrud.php';

    class UsuarioService {
        public static function findUserAttendant($identification) {
            try {
                $user = UsuarioCrud::findUserAttendant($identification);

                if ($user == null){
                    return null;
                } else {
                    return $user;
                }

            } catch(Exception $error){
                return $error->getMessage();
            }
        }

        public static function findUserProffesor($identification) {
            try {
                $user = UsuarioCrud::findUserProffesor($identification);

                if ($user == null){
                    return null;
                } else {
                    return $user;
                }

            } catch(Exception $error){
                return $error->getMessage();
            }
        }

        public static function listUserAttendant() {
            try {
                $type = 'Acudiente';
                $user = UsuarioCrud::listTypeuser($type);

                if ($user == null){
                    return null;
                } else {
                    return $user;
                }

            } catch(Exception $error){
                return null;
            }
        }

        public static function listUserProffesor() {
            try {
                $type = 'Profesor';
                $user = UsuarioCrud::listTypeuser($type);

                if ($user == null){
                    return null;
                } else {
                    return $user;
                }

            } catch(Exception $error){
                return null;
            }
        }

        public static function listProffesorGroup($identification) {
            try {
                $user = Usuario::find('all', array(
                    'joins' => array(
                        'INNER JOIN Profesores_Grupos ON Usuarios.Identificacion = Profesores_Grupos.Identificacion_usuario',
                        'INNER JOIN Grupos ON Grupos.ID = Profesores_Grupos.id_grupo',
                        'INNER JOIN Acudidos ON Grupos.ID = Acudidos.id_grupo'
                    ),
                    'select' => 'Usuarios.*',
                    'conditions' => "Acudidos.Identificacion = '$identification' AND Usuarios.Tipo_usuario = 'Profesor'"
                ));

                if ($user == null){
                    return null;
                } else {
                    return $user;
                }

            } catch(Exception $error){
                return null;
            }
        }

        public static function listProffesorGroupAttendant($identification) {
            try {
                $user = Usuario::find('all', array(
                    'joins' => array(
                        'INNER JOIN Profesores_Grupos ON Usuarios.Identificacion = Profesores_Grupos.Identificacion_usuario',
                        'INNER JOIN Grupos ON Grupos.ID = Profesores_Grupos.id_grupo',
                        'INNER JOIN Acudidos ON Grupos.ID = Acudidos.id_grupo',
                    ),
                    'select' => 'Usuarios.*',
                    'conditions' => "Acudidos.Identificacion_usuario = '$identification' AND Usuarios.Tipo_usuario = 'Profesor'"
                ));
    
                if ($user == null){
                    return null;
                } else {
                    return $user;
                }
    
            } catch(Exception $error){
                return null;
            }
        }

        public static function editUser($user) {
            try {
                UsuarioCrud::editUser($user);
            } catch (Exception $error) {
                return $error->getMessage();
            }
        }

        public static function saveUser($user) {
            try {
                UsuarioCrud::saveUser($user);
            } catch (Exception $error) {
                return $error->getMessage();
            }
        }
    }

?>