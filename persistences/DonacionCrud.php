<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Donacion.php';
    include_once 'IDonacionCrud.php';

    class DonacionCrud implements IDonacionCrud {
        public static function findDonation($id) {
            try {
                $donation = Donacion::find(array('id' => $id));

                if ($donation == null) {
                    throw new Exception('No existe la donacion.');
                }
                
                return $donation;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function saveDonation($donation) {
            try {
                $donation->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function editDonation($donation) {
            try {
                $donation->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function deleteDonation($id) {
            try {
                $donation = Donacion::find(array('id' => $id)) -> delete();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function listDonation() {
            try {
                $donation = Donacion::all();

                if ($donation == null) {
                    throw new Exception('No hay donaciones.');
                }
                
                return $donation;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }
    }

?>