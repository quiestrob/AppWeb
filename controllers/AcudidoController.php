<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Acudido.php';

    class AcudidoController {  
        public static function listarEstudiantes(){
            $estado = 'Aceptada';
            try {
                $estudiantes = Acudido::find('all', array(
                    'joins' => array(
                        'INNER JOIN Inscripciones ON Inscripciones.Identificacion_acudido = Acudidos.Identificacion',
                        'INNER JOIN Estados ON Estados.ID = Inscripciones.estado_id'
                    ),
                    'select' => 'Inscripciones.*, Acudidos.*, Estados.Estado AS Estado',
                    'conditions' => "Estados.Estado = '$estado'"
                ));

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