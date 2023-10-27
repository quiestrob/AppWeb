<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Profesor.php';

    class ProfesorController {  
        public static function listarProfesores(){
            try {
                $profesores = Profesor::all();

                if ($profesores == null){
                    $_SESSION['profesor.all'] = null;
                } else {
                  $profesores = serialize($profesores);
                  $_SESSION['profesor.all'] = $profesores;
                }

            } catch(Exception $error){
                $_SESSION['profesor.all'] = null;
            }
        }
    }

?>