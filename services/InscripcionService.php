<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Inscripcion.php';

    class InscripcionService {  
        public static function listInscription() {
            try {
                $inscripcion = Inscripcion::find('all', array(
                    'joins' => array(
                        'INNER JOIN Estados ON Estados.ID = Inscripciones.estado_id',
                        'INNER JOIN Acudidos ON Inscripciones.Identificacion_acudido = Acudidos.Identificacion'
                    ),
                    'select' => 'Inscripciones.*, Acudidos.*, Estados.Estado AS Estado'
                ));

                if ($inscripcion == null){
                    return null;
                } else {
                    return $inscripcion;
                } 

            } catch(Exception $error){
                return null;
            }
        }
    }

?>