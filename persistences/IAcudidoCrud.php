<?php

    interface IAcudidoCrud {
        public static function findAttended($identification);
        public static function saveAttended($attended);
        public static function editAttended($attended);
        public static function deleteAttended($identification);
        public static function listAttended();
    }

?>