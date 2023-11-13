<?php

    interface IUsuarioCrud {
        public static function findUserAttendant($identification);
        public static function findUserProffesor($identification);
        public static function saveUser($user);
        public static function editUser($user);
        public static function deleteUser($identification);
        public static function listTypeUser($type);
        public static function listUser();
    }

?>