<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/lib/config.php';

    class Acudido extends ActiveRecord\Model {
        public static $belongs_to = array (
            array('Inscripcion')
        );
        public static $has_many = array (
            array('Informes')
        );
        public static $primary_key = 'Identificacion';
    }

?>