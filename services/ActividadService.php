<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Actividad.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/persistences/ActividadCrud.php';

    class ActividadService {  
        public static function listActivities($identification) {
           try {
                $activities = Actividad::find('all', array(
                    'joins' => array(
                        'INNER JOIN Grupos ON Grupos.id = Actividades.id_Grupo',
                        'INNER JOIN Acudidos ON Acudidos.id_Grupo = Grupos.id'
                    ),
                    'select' => 'Actividades.*',
                    'conditions' => "Acudidos.Identificacion='$identification'"
                ));

                if ($activities == null){
                    return null;
                } else{
                    return $activities;
                }

           } catch(Exception $error){
                return $error->getMessage();
           }
        }
    }

?>