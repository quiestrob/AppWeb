<?php

    interface IDonacionCrud {
        public static function findDonation($id);
        public static function saveDonation($donation);
        public static function editDonation($donation);
        public static function deleteDonation($id);
        public static function listDonation();
    }

?>