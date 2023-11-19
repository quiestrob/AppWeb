<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Actividad.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/ActividadService.php';

    class ActividadController {  
        public static function listAllActivities() {
            try {
                $activities = ActividadService::listAllActivities();

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

        public static function listActivitiesAttendant($identification) {
            try {
                $activities = ActividadService::listActivitiesAttendant($identification);

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

        public static function listActivitiesProffesor($identification) {
            try {
                $activities = ActividadService::listActivitiesProffesor($identification);

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