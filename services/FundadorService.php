<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/persistences/FundadorCrud.php';

    class FundadorService {  
        public static function findFounder($identification) {
            try {
                $founder = FundadorCrud::findFounder($identification);

                if ($founder == null){
                    return null;
                } else {
                    return $founder;
                }

            } catch(Exception $error){
                return null;
            }
        }

        public static function editFounder($founder) {
            try {
                FundadorCrud::editFounder($founder);
            } catch(Exception $error){
                return null;
            }
        }
    }

?>