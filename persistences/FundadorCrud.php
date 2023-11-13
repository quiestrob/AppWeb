<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Fundador.php';
    include_once 'IFundadorCrud.php';

    class FundadorCrud implements IFundadorCrud {
        public static function findFounder($identification) {
            try {
                $founder = Fundador::find(array('identificacion' => $identification));

                if ($founder == null) {
                    throw new Exception('No existe el fundador.');
                }
                
                return $founder;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function saveFounder($founder) {
            try {
                $founder->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function editFounder($founder) {
            try {
                $founder->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function deleteFounder($identification) {
            try {
                $founder = Fundador::find(array('identificacion' => $identification)) -> delete();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function listFounder() {
            try {
                $founder = Fundador::all();

                if ($founder == null) {
                    return throw new Exception('No hay fundadores.');
                }
                
                return $founder;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }
    }

?>