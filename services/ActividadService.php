<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Actividad.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/persistences/ActividadCrud.php';

    class ActividadService {  
        public static function listAllActivities() {
            try {
                 $activities = ActividadCrud::listActivity();
 
                 if ($activities == null){
                     return null;
                 } else{
                     return $activities;
                 }
 
            } catch(Exception $error){
                 return $error->getMessage();
            }
        }

        public static function listActivities($identification) {
           try {
                $activities = Actividad::find('all', array(
                    'joins' => array(
                        'INNER JOIN Grupos ON Grupos.id = Actividades.id_Grupo',
                        'INNER JOIN Acudidos ON Acudidos.id_Grupo = Grupos.id'
                    ),
                    'select' => 'Actividades.*, Grupos.Aula AS aula',
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

        public static function listActivitiesAttendant($identification) {
            try {
                $activities = Actividad::find('all', array(
                    'joins' => array(
                        'INNER JOIN Grupos ON Grupos.id = Actividades.id_Grupo',
                        'INNER JOIN Acudidos ON Acudidos.id_Grupo = Grupos.id',
                        'INNER JOIN Usuarios ON Acudidos.identificacion_usuario = Usuarios.Identificacion'
                    ),
                    'select' => 'Actividades.*, Grupos.Aula AS aula',
                    'conditions' => "Usuarios.Identificacion='$identification'"
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

        public static function listActivitiesProffesor($identification) {
            try {
                $activities = Actividad::find('all', array(
                    'joins' => array(
                        'INNER JOIN Grupos ON Grupos.id = Actividades.id_Grupo'
                    ),
                    'select' => 'Actividades.*, Grupos.*',
                    'conditions' => "Actividades.Identificacion_usuario='$identification'"
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