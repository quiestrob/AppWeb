<?php

    interface IFundadorCrud {
        public static function findFounder($identification);
        public static function saveFounder($user);
        public static function editFounder($user);
        public static function deleteFounder($identification);
        public static function listFounder();
    }

?>