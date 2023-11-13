<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Usuario.php';
    include_once 'IUsuarioCrud.php';

    class UsuarioCrud implements IUsuarioCrud {
        public static function findUserAttendant($identification) {
            try {
                $user = Usuario::find(array('identificacion' => $identification, 'tipo_usuario' => 'Acudiente'));

                if ($user == null) {
                    throw new Exception('No existe el usuario.');
                }
                
                return $user;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function findUserProffesor($identification) {
            try {
                $user = Usuario::find(array('identificacion' => $identification, 'tipo_usuario' => 'Profesor'));

                if ($user == null) {
                    throw new Exception('No existe el usuario.');
                }
                
                return $user;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function saveUser($user) {
            try {
                $user->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function editUser($user) {
            try {
                $user->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function deleteUser($identification) {
            try {
                $user = Usuario::find(array('identificacion' => $identification)) -> delete();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function listTypeUser($type) {
            try {
                $user = Usuario::find('all', array('tipo_usuario' => $type));

                if ($user == null) {
                    return throw new Exception('No hay usuarios.');
                }
                
                return $user;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function listUser() {
            try {
                $user = Usuario::all();

                if ($user == null) {
                    return throw new Exception('No hay usuarios.');
                }
                
                return $user;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }
    }

?>