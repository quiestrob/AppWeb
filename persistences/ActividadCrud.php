<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Actividad.php';
    include_once 'IActividadCrud.php';

    class ActividadCrud implements IActividadCrud {
        public static function findActivity($id) {
            try {
                $activity = Actividad::find(array('id' => $id));

                if ($activity == null) {
                    throw new Exception('No existe el actividad.');
                }
                
                return $activity;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function saveActivity($activity) {
            try {
                $activity->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function editActivity($activity) {
            try {
                $activity->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function deleteActivity($id) {
            try {
                $activity = Actividad::find(array('id' => $id)) -> delete();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function listActivity() {
            try {
                $activity = Actividad::all();

                if ($activity == null) {
                    throw new Exception('No hay actividades.');
                }
                
                return $activity;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }
    }

?>