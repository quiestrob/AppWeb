<?php

    interface IMensajeCrud {
        public static function findMessage($id);
        public static function saveMessage($message);
        public static function editMessage($message);
        public static function deleteMessage($id);
        public static function listMessage();
    }

?>