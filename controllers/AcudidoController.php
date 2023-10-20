<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Acudido.php';

    class AcudidoController {  
        public static function listarEstudiantes(){
            try {
                $estudiantes = Acudido::all();

                if ($estudiantes == null){
                    $_SESSION['estudiante.all'] = null;
                } else {
                  $estudiantes = serialize($estudiantes);
                  $_SESSION['estudiante.all'] = $estudiantes;
                }

                header("Location: ../root/pages/validation_inscription.php");
            } catch(Exception $error){
                $_SESSION['estudiante.all'] = null;
                header("Location: ../root/pages/validation_inscription.php?msj=Ocurrio un error.");
            }
        }
    }

?>