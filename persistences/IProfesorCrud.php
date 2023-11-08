<?php

    interface IProfesorCrud {
        public static function findProffesor($identification);
        public static function saveProffesor($proffesor);
        public static function editProffesor($proffesor);
        public static function deleteProffesor($identification);
        public static function listProffesor();
    }

?>