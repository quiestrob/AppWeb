<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/InscripcionService.php';

    class InscripcionController {  
        public static function listInscription() {
            try {
                $inscripcion = InscripcionService::listInscription();

                if ($inscripcion == null){
                    $_SESSION['inscripcion.all'] = null;
                } else {
                    $inscripcion = serialize($inscripcion);
                    $_SESSION['inscripcion.all'] = $inscripcion;
                } 

            } catch(Exception $error){
                $_SESSION['inscripcion.all'] = null;
            }
        }
    }

    InscripcionController::listInscription();

?>