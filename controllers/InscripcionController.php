<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Inscripcion.php';

    class InscripcionController {  
        public static function listar() {
            try {
                $inscripcion = Inscripcion::find('all', array(
                    'joins' => array(
                        'INNER JOIN Estados ON Estados.ID = Inscripciones.estado_id',
                        'INNER JOIN Acudidos ON Inscripciones.Identificacion_acudido = Acudidos.Identificacion'
                    ),
                    'select' => 'Inscripciones.*, Acudidos.*, Estados.Estado AS Estado'
                ));

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

    InscripcionController::listar();

?>