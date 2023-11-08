<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/AcudidoService.php';

    class AcudidoController {  
        public static function listStudentStatus() {
            try {
                $estudiantes = AcudidoService::listStudentStatus();

                if ($estudiantes == null){
                    $_SESSION['estudiante.all'] = null;
                } else {
                  $estudiantes = serialize($estudiantes);
                  $_SESSION['estudiante.all'] = $estudiantes;
                }

            } catch(Exception $error){
                $_SESSION['estudiante.all'] = null;
            }
        }
    }

?>