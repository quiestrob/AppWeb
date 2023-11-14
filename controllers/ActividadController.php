<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Actividad.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/ActividadService.php';

    class ActividadController {  
        public static function listActivities($identification) {
            try {
                $activities = ActividadService::listActivities($identification);

                if ($activities == null) {
                    $_SESSION['actividad.all'] = null;
                } else {
                    $activities = serialize($activities);
                    $_SESSION['actividad.all'] = $activities; 
                }
            } catch(Exception $error){
                echo "Error: " + $error->getMessage();
            }
        }
    }

?>