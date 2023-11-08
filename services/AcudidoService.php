<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Acudido.php';

    class AcudidoService {  
        public static function listStudentStatus() {
            $estado = 'Aceptada';

            try {
                $estudiantes = Acudido::find('all', array(
                    'joins' => array(
                        'INNER JOIN Inscripciones ON Inscripciones.Identificacion_acudido = Acudidos.Identificacion',
                        'INNER JOIN Estados ON Estados.ID = Inscripciones.estado_id',
                        'INNER JOIN Grupos ON Grupos.ID = Acudidos.id_grupo'
                    ),
                    'select' => 'Inscripciones.*, Acudidos.*, Grupos.*, Estados.Estado AS Estado',
                    'conditions' => "Estados.Estado = '$estado'"
                ));

                if ($estudiantes == null) {
                    return null;
                } else {
                  return $estudiantes;
                }

            } catch(Exception $error){
                return null;
            }
        }
    }

?>