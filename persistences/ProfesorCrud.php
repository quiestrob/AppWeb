<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Profesor.php';
    include_once 'IProfesorCrud.php';

    class ProfesorCrud implements IProfesorCrud {
        public static function findProffesor($proffesor) {
            try {
                $proffesor = Profesor::find(array('identificacion' => $identification));

                if ($proffesor == null) {
                    throw new Exception('No existe el profesor.');
                }
                
                return $proffesor;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function saveProffesor($proffesor) {
            try {
                $proffesor->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function editProffesor($proffesor) {
            try {
                $proffesor->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function deleteProffesor($identification) {
            try {
                $proffesor = Profesor::find(array('identificacion' => $identification)) -> delete();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function listProfessor() {
            try {
                $proffesor = Profesor::all();

                if ($proffesor == null) {
                    throw new Exception('No hay profesores.');
                }
                
                return $proffesor;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }
    }

?>