<?php

    interface IGrupoCrud {
        public static function findGroup($id);
        public static function saveGroup($group);
        public static function editGroup($group);
        public static function deleteGroup($id);
        public static function listGroup();
    }

?>