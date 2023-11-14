<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Actividad.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/ActividadService.php';

    class ActividadController {  
        public static function executeAction() {
            $action = $_REQUEST['action'];
            
            switch ($action) {
                case 'Listar':
                    ActividadController::listActivities();
                    break;
                default:
                    header("Location: ../root/pages/error.php");
                    exit;
            }
        }


        public static function listActivities($Identification) {
            try {
                $activities = ActividadService::listActivities($Identification);

                if ($activities == null) {
                    $_SESSION['actividad.all']=null;
                } else {
                    $activities=serialize($activities);
                    $_SESSION['actividad.all']=$activities; 
                }
                } catch(Exception $error){
                echo "Error: " + $error->getMessage();
            }
        }
    }

?>