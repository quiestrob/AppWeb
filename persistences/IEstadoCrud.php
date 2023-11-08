<?php

    interface IEstadoCrud {
        public static function findStatus($id);
        public static function saveStatus($status);
        public static function editStatus($status);
        public static function deleteStatus($id);
        public static function listStatus();
    }

?>