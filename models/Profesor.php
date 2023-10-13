<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/lib/config.php';

    class Profesor extends ActiveRecord\Model {
        public static $primary_key = 'Identificacion';
        public static $has_many = array (
            array('Actividades'),
            array('Informes')
            array('Informacion')
        );
    }

?>