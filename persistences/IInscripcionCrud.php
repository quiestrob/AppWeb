<?php

    interface IInscripcionCrud {
        public static function findInscription($id);
        public static function saveInscription($report);
        public static function editInscription($report);
        public static function deleteInscription($id);
        public static function listInscription();
    }

?>