<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Acudiente.php';
    include_once 'IAcudienteCrud.php';

    class AcudienteCrud implements IAcudienteCrud {
        public static function findAttendant($identification) {
            try {
                $attendant = Acudiente::find(array('identificacion' => $identification));

                if ($attendant == null) {
                    throw new Exception('No existe el acudiente.');
                }
                
                return $attendant;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function saveAttendant($attendant) {
            try {
                $attendant->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function editAttendant($attendant) {
            try {
                $attendant->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function deleteAttendant($identification) {
            try {
                $attendant = Acudiente::find(array('identificacion' => $identification)) -> delete();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function listAttendant() {
            try {
                $attendant = Acudiente::all();

                if ($attendant == null) {
                    throw new Exception('No hay acudientes.');
                }
                
                return $attendant;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }
    }

?>