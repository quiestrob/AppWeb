<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Grupo.php';
    include_once 'IGrupoCrud.php';

    class GrupoCrud implements IGrupoCrud {
        public static function findGroup($identification) {
            try {
                $group = Grupo::find(array('id' => $id));

                if ($group == null) {
                    throw new Exception('No existe el grupo.');
                }
                
                return $group;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function saveGroup($group) {
            try {
                $group->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function editGroup($group) {
            try {
                $group->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function deleteGroup($id) {
            try {
                $group = Grupo::find(array('id' => $id)) -> delete();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function listGroup() {
            try {
                $group = Grupo::all();

                if ($group == null) {
                    throw new Exception('No hay grupos.');
                }
                
                return $group;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }
    }

?>