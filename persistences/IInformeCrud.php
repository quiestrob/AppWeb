<?php

    interface IInformeCrud {
        public static function findReport($id);
        public static function saveReport($report);
        public static function editReport($report);
        public static function deleteReport($id);
        public static function listReport();
    }

?>