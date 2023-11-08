<?php

    interface IAcudienteCrud {
        public static function findAttendant($identification);
        public static function saveAttendant($attendant);
        public static function editAttendant($attendant);
        public static function deleteAttendant($identification);
        public static function listAttendant();
    }

?>