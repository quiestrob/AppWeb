<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Inscripcion.php';
    include_once 'IInscripcionCrud.php';

    class InscripcionCrud implements IInscripcionCrud {
        public static function findInscription($id) {
            try {
                $inscription = Inscripcion::find(array('id' => $id));

                if ($inscription == null) {
                    throw new Exception('No existe la inscripcion.');
                }
                
                return $inscription;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function saveInscription($inscription) {
            try {
                $inscription->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function editInscription($inscription) {
            try {
                $inscription->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function deleteInscription($id) {
            try {
                $inscription = Inscripcion::find(array('id' => $id)) -> delete();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function listInscription() {
            try {
                $inscription = Inscripcion::all();

                if ($inscription == null) {
                    throw new Exception('No hay inscripciones.');
                }
                
                return $inscription;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }
    }

?>