<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/lib/config.php';

    class Donacion extends ActiveRecord\Model {
        public static $has_one = array (
            array('Usuario', 'Fundador')
        );
        public static $table_name = 'Donaciones';
    }

?>