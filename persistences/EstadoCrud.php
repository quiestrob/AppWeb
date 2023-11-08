<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Estado.php';
    include_once 'IEstadoCrud.php';

    class EstadoCrud implements IEstadoCrud {
        public static function findStatus($id) {
            try {
                $status = Estado::find(array('id' => $id));

                if ($status == null) {
                    throw new Exception('No existe el estado.');
                }
                
                return $status;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function saveStatus($status) {
            try {
                $status->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function editStatus($status) {
            try {
                $status->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function deleteStatus($id) {
            try {
                $status = Estado::find(array('id' => $id)) -> delete();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function listStatus() {
            try {
                $status = Estado::all();

                if ($status == null) {
                    throw new Exception('No hay estados.');
                }
                
                return $status;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }
    }

?>