<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Donacion.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/persistences/DonacionCrud.php';

    class DonacionService {
        public static function saveDonation($donation) {
            try {
                DonacionCrud::saveDonation($donation);
            } catch (Exception $error) {
                return 'Ocurrio un error: ' . $error->getMessage();
            }
        }

        public static function countDonation($identification) {
            try {
                $donation = Donacion::find('all', array(
                    'select' => 'COUNT(*) AS conteo, SUM(Monto) AS total',
                    'conditions' => "Identificacion_usuario = '$identification' || Identificacion_fundador = '$identification'"
                ));

                if ($donation == null) {
                    return null;
                } else {
                    return $donation;
                }
            } catch (Exception $error) {
                return 'Ocurrio un error: ' . $error->getMessage();
            }
        }
    }

?>