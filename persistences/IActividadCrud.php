<?php

    interface IActividadCrud {
        public static function findActivity($id);
        public static function saveActivity($activity);
        public static function editActivity($activity);
        public static function deleteActivity($id);
        public static function listActivity();
    }

?>