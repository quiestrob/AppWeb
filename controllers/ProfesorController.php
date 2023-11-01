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

        public static function listarProfesoresGrupo($identificacion){
            try {
                $profesores = Profesor::find('all', array(
                    'joins' => array(
                        'INNER JOIN Profesores_Grupos ON Profesores.Identificacion = Profesores_Grupos.Identificacion_profesor',
                        'INNER JOIN Grupos ON Grupos.ID = Profesores_Grupos.id_grupo',
                        'INNER JOIN Acudidos ON Grupos.ID = Acudidos.id_grupo'
                    ),
                    'select' => 'Profesores.*',
                    'conditions' => "Acudidos.Identificacion = '$identificacion'"
                ));

                if ($profesores == null){
                    $_SESSION['profesor_grupo.all'] = null;
                } else {
                  $profesores = serialize($profesores);
                  $_SESSION['profesor_grupo.all'] = $profesores;
                }

            } catch(Exception $error){
                $_SESSION['profesor_grupo.all'] = null;
            }
        }

        public static function listarProfesoresGrupoA($identificacion){
            try {
                $profesores = Profesor::find('all', array(
                    'joins' => array(
                        'INNER JOIN Profesores_Grupos ON Profesores.Identificacion = Profesores_Grupos.Identificacion_profesor',
                        'INNER JOIN Grupos ON Grupos.ID = Profesores_Grupos.id_grupo',
                        'INNER JOIN Acudidos ON Grupos.ID = Acudidos.id_grupo',
                        'INNER JOIN Acudientes ON Acudidos.Identificacion_acudiente = Acudientes.Identificacion'
                    ),
                    'select' => 'Profesores.*',
                    'conditions' => "Acudientes.Identificacion = '$identificacion'"
                ));

                if ($profesores == null){
                    $_SESSION['profesor_grupoA.all'] = null;
                } else {
                  $profesores = serialize($profesores);
                  $_SESSION['profesor_grupoA.all'] = $profesores;
                }

            } catch(Exception $error){
                $_SESSION['profesor_grupoA.all'] = null;
            }
        }
    }

?>