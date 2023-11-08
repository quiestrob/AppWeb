<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/AcudienteService.php';

    class AcudienteController {
        public static function listAttendant() {
            try {
                $attendant = AcudienteService::listAttendant();

                if ($attendant == null){
                    $_SESSION['acudiente.all'] = null;
                } else {
                  $attendant = serialize($attendant);
                  $_SESSION['acudiente.all'] = $attendant;
                }

            } catch(Exception $error){
                $_SESSION['acudiente.all'] = null;
            }
        }
    }

?>