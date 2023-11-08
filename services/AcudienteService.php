<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/persistences/AcudienteCrud.php';

    class AcudienteService {
        public static function listAttendant() {
            try {
                $attendant = AcudienteCrud::listAttendant();

                if ($attendant == null){
                    return null;
                } else {
                    return $attendant;
                }

            } catch(Exception $error){
                return null;
            }
        }
    }

?>