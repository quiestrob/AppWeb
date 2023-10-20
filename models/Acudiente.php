<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/lib/config.php';

    class Acudiente extends ActiveRecord\Model {
        public static $has_many = array (
            array('Acudido', 'Informe')
        );
        public static $primary_key = 'Identificacion';
    }

?>